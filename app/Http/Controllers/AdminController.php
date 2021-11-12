<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Work;
use App\Models\Course;
use App\Models\Classes;
use App\Models\Exam;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Schedule;
use App\Models\percentage;

class AdminController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        $students = DB::table('students')
            ->select('students.*')
            ->orderby('id','DESC')
            ->get();
        $asignaturas = DB::table('users')
            ->select('id','users.name','users.surname','courses.description','courses.id_course')
            ->join('enrollment', 'users.id', '=', 'id_student')
            ->join('courses', 'enrollment.id_course', '=', 'courses.id_course')
            ->where('users.rol_id','3')
            ->get();
        
        session(['asignaturas'=>$asignaturas]);
         //dd($nota);
        //$notacalculada = (float)(($nota['notaworks'] * $nota['ec'] / 100 ) + ($nota['notaexamen'] * $nota['percentexamen'] / 100));
        return view('admin', ['asignaturas'=>$asignaturas]);
    }

    public function store(Request $request){
        // saber qué estudiante ha pulsado
        if($request->only('listarclass')){
            $idStudent = $request->only('listarclass');
            $clases = DB::table('class')
                ->select('class.name AS nameClass','class.id_class','enrollment.id_student','users.name','users.surname','courses.description','users.id AS iduser')
                ->join('enrollment', 'enrollment.id_course', '=', 'class.id_course')
                ->join('courses', 'enrollment.id_course', '=', 'courses.id_course')
                ->join('users', 'users.id', '=', 'enrollment.id_student')
                ->where('enrollment.id_student',$idStudent)
                ->get();
            $nota = DB::table('exams')
                ->select('works.mark AS notaworks', 'exams.mark AS notaexamen','percentage.continuous_assessment AS ec', 'percentage.exams AS percentexamen', 'users.id AS id_student','class.id_class AS id_class','courses.id_course AS id_course')
                ->join('users', 'exams.id_student','=','users.id')
                ->join('class', 'exams.id_class','=', 'class.id_class')
                ->join('works', 'works.id_class','=','class.id_class')
                ->join('percentage','percentage.id_class','=','class.id_class')
                ->join('courses','class.id_course','=','courses.id_course')
                ->get();

                
            return view('admin.clases', ['clases'=>$clases, 'notas'=>$nota]);
        }else if($request->only('listartrabajos')){
            $temp = $request->only('listartrabajos');
            $arraytemp = explode("+", $temp['listartrabajos']);
            $idStudent=$arraytemp[0];
            $idClass=$arraytemp[1]; 
            $works = DB::table('works')
                ->select('works.*','class.name AS nameClass','class.id_class','users.name','users.surname','users.id AS iduser','works.name AS workname')
                ->join('class','class.id_class','=','works.id_class')
                ->join('users','users.id','=','works.id_student')
                ->join('courses','class.id_course','=','courses.id_course')
                ->where('works.id_student',$idStudent)
                ->where('works.id_class', $idClass)
                ->get();

                $clase = DB::table('class')
                            ->select('class.*')
                            ->get();
                $courses = DB::table('courses')
                            ->select('courses.*')
                            ->get();
                $students = DB::table('users')
                            ->select('users.*')
                            ->where('rol_id','3')
                            ->get();
                $allworks = DB::table('works')
                            ->select('works.*')
                            ->get();
            
            return view('admin.works', ['works'=>$works, 'class'=>$clase, 'courses'=>$courses, 'students'=>$students,'allworks'=>$allworks]);
        }else if($request->only('listarexamenes')){
            $temp = $request->only('listarexamenes');
            $arraytemp = explode("+", $temp['listarexamenes']);
            $idStudent=$arraytemp[0];
            $idClass=$arraytemp[1];
            $class = DB::table('class') -> select('class.*')->where('id_class',$idClass)->get();
            $student = DB::table('users') -> select('users.*')->where('id',$idStudent)->where('rol_id','3 ')->get();
            $exams = DB::table('exams')
                    ->select('exams.*','exams.name as workname','users.name AS username','users.surname AS apellido','class.name AS nameclass')
                    ->join('users', 'users.id','=','exams.id_student')
                    ->join('class', 'class.id_class','=','exams.id_class')
                    ->where('exams.id_student', $idStudent)
                    ->where('exams.id_class',$idClass)
                    ->get();
            //dd($exams);

            return view('admin.exams', ['exams'=>$exams,'class'=>$class,]);



        }else if($request->only('borrartrabajos')){
            $idWork = $request->only('borrartrabajos')['borrartrabajos'];
            DB::table('works')
                ->where('id_work',$idWork)
                ->delete();
            session(['Listo'=>'El trabajo ha sido borrado']);
            return back();
        }else if($request->only('editartrabajos')){
            //dd($request->only('editartrabajos'));
            $idThisWork=$request->only('editartrabajos');
            $idstudent = $request->input('idstudent');
            $markwork = $request->input('mark_work');
            //dd($idThisWork['editartrabajos']); //devuelve bien
            $students = DB::table('users')
                            ->select('users.*')
                            ->where('rol_id','3')
                            ->get();
            $allworks = DB::table('works')
                            ->select('works.*')
                            ->get();
            return view('admin.editwork',['allworks'=>$allworks,'students'=>$students,'idthiswork'=>$idThisWork['editartrabajos'],'idstudent'=>$idstudent,'markwork'=>$markwork]);
        
        }else if($request->only('modificacion')){
            //dd($request->only('modificacion')); 
            
            if($request->only('modificacion')['modificacion']=='modificacionWork'){
                //consulta de update
               //dd($request->all());
                DB::table('works')
                        ->where('id_work', $request->work )
                        ->update(['id_student' => $request->student, 'mark' => $request->work_mark ]);
                session(['Listo'=>'Datos actualizados Correctamente']);
                return back();
            }
            if($request->only('modificacion')['modificacion']=='modificacionExam'){
                //consulta de update
               //dd($request->all());
                DB::table('exams')
                        ->where('id_exam', $request->work )
                        ->update(['id_student' => $request->student, 'mark' => $request->nota ]);
                session(['Listo'=>'Datos actualizados Correctamente']);
                return back();
            }
            if($request->only('modificacion')['modificacion']=='modificacionPorcent'){
                //dd($request);
                $id_percentage = $request->input('id_percentage');
                //dd($request->all());
                DB::table('percentage')
                        ->where('id_percentage', $request->id_percentage )
                        ->update(['continuous_assessment' => $request->ec_percent, 
                                    'exams' => $request->exam_percent,
                                ]);
                session(['Listo'=>'Datos actualizados Correctamente']);
                return back();
            
            }

            
            
        
        }else if($request->only('editarexamenes')){
            $idThisExam=$request->only('editarexamenes');
            $idstudent = $request->only('idstudent');
            $markexam = $request->only('mark_exam');
            $class = $request->only('idclass');
            
            $students = DB::table('users')
                ->select('users.*')
                ->where('rol_id','3')
                ->get();
            $exam = DB::table('exams')->select('exams.*')->where('id_exam',$idThisExam)->get();
            $clase = DB::table('class')
                ->select('class.*')
                ->get();
            return view('admin.editexam',['class'=>$clase,'students'=>$students,'exams'=>$exam,'idexam'=>$idThisExam['editarexamenes'] ,'idstudent'=>$idstudent['idstudent'],'idclass'=>$class['idclass'],'markexam'=>$markexam['mark_exam']]);
        }else if($request->only('editarporcentaje')){
            $id_percentage = $request->only('editarporcentaje');
            $idstudent = $request->input('idstudent');
            $idcourse = $request->input('idcourse');
            $idclass = $request->input('idclass');
            $ec = $request->input('ec');
            $exam = $request->input('exam');
            $students = DB::table('users')
                ->select('users.*')
                ->where('rol_id','3')
                ->get();
            $clase = DB::table('class')
                ->select('class.*')
                ->get();
            $courses = DB::table('courses')
                ->select('courses.*')
                ->get();
            $percent = DB::table('percentage')
                ->select('percentage.*')
                ->get();

            return view('admin.editporcent',['students'=>$students,'clase'=>$clase,'courses'=>$courses, 'percent'=>$percent, 'idstudent'=>$idstudent,'idcourse'=>$idcourse,'idclass'=>$idclass, 'ec'=>$ec,'exam'=>$exam, 'id_percentage'=>$id_percentage]); 

        
        }else if($request->only('modificarporcentaje')){
            $asignaturaid = $request->only('modificarporcentaje');
            $porcent = DB::table('percentage')
                ->select('percentage.*', 'users.name AS nameStudent','users.surname AS apellido','class.name AS clase','courses.name AS curso', 'users.id AS studentId','class.id_class AS classid','courses.id_course AS courseid')
                ->join('courses','percentage.id_course','=','courses.id_course')
                ->join('class','percentage.id_class','=','class.id_class')
                ->join('enrollment','percentage.id_course','=','enrollment.id_course')
                ->join('users', 'users.id','=','enrollment.id_student')
                ->where('users.id',$asignaturaid)
                ->get();
                return view('admin.percentage',['porcent'=>$porcent]);

        }

        //ZONA CREACION DE ENTIDADES

        if($request->only('crear')){
            if($request->only('crear')['crear']=='crear_cursos'){
                return view('admin.create.createcursos');               
            }
            if($request->only('crear')['crear']=='crear_clases'){
                $courses = DB::table('courses')
                    ->select('courses.*')
                    ->get();
                $teachers = DB::table('users')
                ->select('users.*')
                ->where('rol_id','2')
                ->get();
                $agendas = DB::table('schedule')
                ->select('schedule.*')
                ->get();
                
                
                return view('admin.create.createclases',['teachers'=>$teachers,'courses'=>$courses,'agendas'=>$agendas]);
            }
            if($request->only('crear')['crear']=='crear_agendas'){
                $clases = DB::table('class')
                ->select('class.*')
                ->get();
                return view('admin.create.createagenda',['class'=>$clases]);
            }
            if($request->only('crear')['crear']=='crear_examenes'){
                $clases = DB::table('class')
                    ->select('class.*')
                    ->get();
                $students = DB::table('users')
                    ->select('users.*')
                    ->where('rol_id','3')
                    ->get();

                return view('admin.create.createexamenes',['class'=>$clases,'students'=>$students]);
            }
            if($request->only('crear')['crear']=='crear_trabajos'){

                $clases = DB::table('class')
                    ->select('class.*')
                    ->get();
                $students = DB::table('users')
                    ->select('users.*')
                    ->where('rol_id','3')
                    ->get();
                return view('admin.create.createtrabajos',['class'=>$clases,'students'=>$students]);
            }

            if($request->only('crear')['crear']=='matricula'){

                $students = DB::table('users')
                    ->select('users.*')
                    ->where('rol_id','3')
                    ->get();
                $courses = DB::table('courses')
                    ->select('courses.*')
                    ->get();
                $clases = DB::table('class')
                    ->select('class.*')
                    ->get();
                return view('admin.matricula.creatematricula',['students'=>$students,'courses'=>$courses, 'class'=>$clases]);
            }
        }
        if ($request->only('crearGuardar')){

            if ($request->only('crearGuardar')['crearGuardar']=='cursos'){
                
                if (!$request->active){
                    $request->active = 0;
                }
                $curso = new Course();
                    $curso->name = $request->name;
                    $curso->description = $request->description;
                    $curso->date_start = $request->start;
                    $curso->date_end = $request->end;
                    $curso->active = $request->active;
                $curso->save();
                session(['Listo'=>'Los datos se han creado correctamente']);
                return back();

                

            }
            if ($request->only('crearGuardar')['crearGuardar']=='clases'){

                $clase = new Classes ();
                    $clase -> id_teacher = $request -> id_teacher;
                    $clase -> id_course = $request -> id_course;
                    $clase -> id_schedule = $request -> id_schedule;
                    $clase -> name = $request -> nameclass;
                    $clase -> color = 'porDefecto';
                $clase -> save();    
                session(['Listo'=>'Los datos se han creado correctamente']);
                return back();
                    
            }
            if ($request->only('crearGuardar')['crearGuardar']=='agendas'){
                //dd($request->all());
                $agenda = new Schedule ();
                    $agenda -> id_class = $request -> id_class;
                    $agenda -> time_start = $request -> start;
                    $agenda -> time_end = $request -> end;
                    $agenda -> day = $request -> day;
                $agenda -> save();    
                session(['Listo'=>'Los datos se han creado correctamente']);
                return back();

            }
            if ($request->only('crearGuardar')['crearGuardar']=='examenes'){
                
                $examenes = new Exam();
                    $examenes -> id_class = $request -> id_class;
                    $examenes -> id_student = $request -> id_student;
                    $examenes -> name = $request -> nuevoexamen;
                    $examenes -> mark = $request -> markexam;
                $examenes -> save();    
                session(['Listo'=>'Los datos se han creado correctamente']);
                return back();
            }
            if ($request->only('crearGuardar')['crearGuardar']=='trabajos'){
                $trabajos = new Work();
                    $trabajos -> id_class = $request -> id_class;
                    $trabajos -> id_student = $request -> id_student;
                    $trabajos -> name = $request -> nuevotrabajo;
                    $trabajos -> mark = $request -> markwork;
                $trabajos -> save();    
                session(['Listo'=>'Los datos se han creado correctamente']);
                return back();
    
            }

            if ($request->only('crearGuardar')['crearGuardar']=='matricula'){
                if (!$request->status){
                    $request->status = 0;
                }
                $percentage = new percentage();
                    $percentage -> id_class = $request -> id_class;
                    $percentage -> id_course = $request -> id_course;
                    $percentage -> continuous_assessment = $request -> ec;
                    $percentage -> exams = $request -> porcentexam;
                $percentage -> save();
                $matricula = new Enrollment();
                    $matricula -> id_student = $request -> id_student;
                    $matricula -> id_course = $request -> id_course;
                    $matricula -> status = $request -> status;
                $matricula -> save();
                session(['Listo'=>'Los datos se han creado correctamente']);
                return back();
    
            }
        
        }

        //zona borrado

        if ($request->only('borrar')){
            if ($request->only('borrar')['borrar']=='usuarios'){
                $usuarios = DB::table('users')
                    ->select('users.*')
                    ->get();
                return view('admin.delete.usuarios',['usuarios'=>$usuarios]);
            }
            if ($request->only('borrar')['borrar']=='cursos'){
               
                $cursos = DB::table('courses')
                    ->select('courses.*')
                    ->get();
                return view('admin.delete.cursos',['courses'=>$cursos]);
            }
            if ($request->only('borrar')['borrar']=='clases'){
               
                $clases = DB::table('class')
                    ->select('class.*')
                    ->get();
                return view('admin.delete.clases',['class'=>$clases]);
                
            }
            if ($request->only('borrar')['borrar']=='borrarcurso'){
                 //Se borraran todas las clases, etc
                $id_course = $request->only('id_course')['id_course'];
                
                $course = DB::table('courses')
                    ->select('courses.*')
                    ->where('courses.id_course',$id_course)
                    ->get();
                $clase = DB::table('class')
                    ->select('class.*')
                    ->where('class.id_course',$id_course)
                    ->get();
                if ($clase->isEmpty()){
                    DB::table('courses')
                    ->where('courses.id_course', $course[0]->id_course)
                    ->delete();
                }else{
                DB::table('works')
                    ->where('works.id_class', $clase[0]->id_class)
                    ->delete();
                DB::table('exams')
                    ->where('exams.id_class', $clase[0]->id_class)
                    ->delete();
                DB::table('class')
                    ->where('class.id_class', $clase[0]->id_class)
                    ->delete();
                DB::table('courses')
                    ->where('courses.id_course', $course[0]->id_course)
                    ->delete();
                }
                session(['Listo'=>'Datos borrados Correctamente']);
                return back();
            }
            if ($request->only('borrar')['borrar']=='borrarclase'){
                 //Se borrarán tambien todos los trabajos y examenes relacionados con la clase o asignatura
                $id_clase = $request->only('id_clase')['id_clase'];
                $clase = DB::table('class')
                    ->select('class.*')
                    ->where('class.id_class',$id_clase)
                    ->get();
                DB::table('works')
                    ->where('works.id_class', $clase[0]->id_class)
                    ->delete();
                DB::table('exams')
                    ->where('exams.id_class', $clase[0]->id_class)
                    ->delete();
                DB::table('class')
                    ->where('class.id_class', $clase[0]->id_class)
                    ->delete();
                

                session(['Listo'=>'Datos borrados Correctamente']);
                return back();
            }
            if ($request->only('borrar')['borrar']=='borrarusuario'){
                $id_user = $request->only('id_user')['id_user'];
                DB::table('users')
                    ->where('id',$id_user)
                    ->delete();
                session(['Listo'=>'Datos borrados Correctamente']);
                return back();
            }
        
        }




               
    }
       
}
