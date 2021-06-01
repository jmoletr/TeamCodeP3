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
            ->select('id','users.name','users.surname','courses.description')
            ->join('enrollment', 'users.id', '=', 'id_student')
            ->join('courses', 'enrollment.id_course', '=', 'courses.id_course')
            ->where('users.rol_id','3')
            //->select('users.*', 'contacts.phone', 'orders.price')
            ->get();
        return view('admin', ['asignaturas'=>$asignaturas]);
    }
}
