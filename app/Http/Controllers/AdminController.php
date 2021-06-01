<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            //->select('users.*', 'contacts.phone', 'orders.price')
            ->get();
        session(['asignaturas'=>$asignaturas]);
        return view('admin', ['asignaturas'=>$asignaturas]);
    }

    public function store(Request $request){
        // saber qué estudiante ha pulsado
        $asignaturas = session('asignaturas');
        //dd($asignaturas);
        //dd($request->all());
        $idStudent = $request->only('listarclass');
        //dd($idStudent);
        // hallar las class de ese estudiante
        // $clases = DB::table('class')
        //     ->select('id_class','class.name')
        //     ->join('enrollment', 'enrollment.id_course', '=', 'courses.id_student')
        //     ->where('enrollment.id_student',$idStudent)
        //     ->get();
        $clases = DB::table('class')
            ->select('class.*','enrollment.id_student','users.name','users.surname','courses.description')
            ->join('enrollment', 'enrollment.id_course', '=', 'class.id_course')
            ->join('courses', 'enrollment.id_course', '=', 'courses.id_course')
            ->join('users', 'users.id', '=', 'enrollment.id_student')
            ->where('enrollment.id_student',$idStudent)
            ->get();
        // $clases = DB::table('class')
        //     ->select('class.name')
        //     ->join('users', 'users.id','=',$idStudent)
        //     ->join('enrollment', 'enrollment.id_course', '=', 'class.id_course')
        //     ->get();

        return view('clases', ['clases'=>$clases]);
    }
       
}
