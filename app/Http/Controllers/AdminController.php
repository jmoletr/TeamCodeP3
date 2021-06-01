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
            ->get();
        session(['asignaturas'=>$asignaturas]);
        return view('admin', ['asignaturas'=>$asignaturas]);
    }

    public function store(Request $request){
        // saber qué estudiante ha pulsado
        $asignaturas = session('asignaturas');
        $idStudent = $request->only('listarclass');
        $clases = DB::table('class')
            ->select('class.name AS nameClass','enrollment.id_student','users.name','users.surname','courses.description')
            ->join('enrollment', 'enrollment.id_course', '=', 'class.id_course')
            ->join('courses', 'enrollment.id_course', '=', 'courses.id_course')
            ->join('users', 'users.id', '=', 'enrollment.id_student')
            ->where('enrollment.id_student',$idStudent)
            ->get();
       
        return view('admin.clases', ['clases'=>$clases]);
    }
       
}
