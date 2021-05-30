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
}
