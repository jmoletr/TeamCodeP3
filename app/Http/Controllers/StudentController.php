<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Student;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
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

    public function index()
    {
        /* $students = DB::table('students')
             ->select('students.*')
             ->orderby('id','DESC')
             ->get();*/
        $asignaturas = DB::table('users')
            ->select('id', 'courses.name', 'courses.description', 'courses.id_course', 'courses.date_start', 'courses.date_end')
            ->join('enrollment', 'users.id', '=', 'id_student')
            ->join('courses', 'enrollment.id_course', '=', 'courses.id_course')
            ->where('id_student', Auth::User()->id)
            ->get();
        $nota = DB::table('exams')
            ->select('works.mark AS notaworks', 'exams.mark AS notaexamen','percentage.continuous_assessment AS ec', 'percentage.exams AS percentexamen', 'users.id AS id_student','class.id_class AS id_class','courses.id_course AS id_course')
            ->join('users', 'exams.id_student','=','users.id')
            ->join('class', 'exams.id_class','=', 'class.id_class')
            ->join('works', 'works.id_class','=','class.id_class')
            ->join('percentage','percentage.id_class','=','class.id_class')
            ->join('courses','class.id_course','=','courses.id_course')
            ->get();
       session(['asignaturas'=>$asignaturas]);
        //dd($nota);
        //$notacalculada = (float)(($nota['notaworks'] * $nota['ec'] / 100 ) + ($nota['notaexamen'] * $nota['percentexamen'] / 100));
        return view('student', ['asignaturas'=>$asignaturas, 'notas'=>$nota]);
    }

    public function store(Request $request){
        // saber qué estudiante ha pulsado
        if($request->only('listarclass')){
            $idStudent = $request->only('listarclass');
            $clases = DB::table('class')
                ->select('class.name AS nameClass','class.id_class','enrollment.id_student','users.name','users.surname','courses.name as coursesName','users.id AS iduser')
                ->join('enrollment', 'enrollment.id_course', '=', 'class.id_course')
                ->join('courses', 'enrollment.id_course', '=', 'courses.id_course')
                ->join('users', 'users.id', '=', 'enrollment.id_student')
                ->where('enrollment.id_student',$idStudent)
                ->get();
            return view('student.clases', ['clases'=>$clases]);

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
            return view('student.works', ['works'=>$works, 'class'=>$clase, 'courses'=>$courses, 'students'=>$students,'allworks'=>$allworks]);

        }else if($request->only('listarexamenes')){
            $temp = $request->only('listarexamenes');
            $arraytemp = explode("+", $temp['listarexamenes']);
            $idStudent=$arraytemp[0];
            $idClass=$arraytemp[1];
            $class = DB::table('class') -> select('class.*')->where('id_class',$idClass)->get();
            $student = DB::table('users') -> select('users.*')->where('id',$idStudent)->where('rol_id','3 ')->get();
            $exams = DB::table('exams')
                ->select('exams.*','exams.name as workname','users.name AS username','users.surname AS apellido','class.*')
                ->join('users', 'users.id','=','exams.id_student')
                ->join('class', 'class.id_class','=','exams.id_class')
                ->where('exams.id_student', $idStudent)
                ->where('exams.id_class',$idClass)
                ->get();
            return view('student.exams', ['exams'=>$exams,'class'=>$class,]);

        /*}else if($request->only('borrartrabajos')){
            $idWork = $request->only('borrartrabajos');
            DB::table('works')
                ->where('id_work',$idWork)
                ->delete();
        }else if($request->only('editartrabajos')){
            //dd($request->only('editartrabajos'));
            $idThisWork=$request->only('editartrabajos');
            $idstudent = $request->only('idstudent');
            $markwork = $request->only('mark_work');
            //dd($idThisWork['editartrabajos']); //devuelve bien
            $students = DB::table('users')
                ->select('users.*')
                ->where('rol_id','3')
                ->get();
            $allworks = DB::table('works')
                ->select('works.*')
                ->get();
            return view('admin.editwork',['allworks'=>$allworks,'students'=>$students,'idthiswork'=>$idThisWork['editartrabajos'],'idstudent'=>$idstudent['idstudent'],'markwork'=>$markwork['mark_work']]);

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
            return view('admin.editexam',['class'=>$clase,'students'=>$students,'exams'=>$exam,'idexam'=>$idThisExam['editarexamenes'] ,'idstudent'=>$idstudent['idstudent'],'idclass'=>$class['idclass'],'markexam'=>$markexam['mark_exam']]);*/
        /*}else if($request->only('editarporcentaje')){
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

            return view('student.editporcent',['students'=>$students,'clase'=>$clase,'courses'=>$courses, 'percent'=>$percent, 'idstudent'=>$idstudent,'idcourse'=>$idcourse,'idclass'=>$idclass, 'ec'=>$ec,'exam'=>$exam]);*/


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
            return view('student.percentage',['porcent'=>$porcent]);

        }
    }
}
