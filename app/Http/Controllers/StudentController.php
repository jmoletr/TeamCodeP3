<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    public function index(){
        $students = \DB::table('students')
            ->select('students.*')
            ->orderby('id','DESC')
            ->get();
        return view('student', ['students'=>$students]);
    }
}
