<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

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

    public function index(){
        $students = \DB::table('students')
            ->select('students.*')
            ->orderby('id','DESC')
            ->get();
        return view('student', ['students'=>$students]);
    }


   /* public function showCourses(){
        $courses = \DB::table('students', 'courses', 'enrollment')
            ->select('c.name')
            ->from('courses c','enrollment e')
            ->where('e.id_course', '=', 'c.id_course')
            ->and('e.id_student', '=', '1')
            ->get();
        return view('student', ['courses'=>$courses]);
    }*/
}
