<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return view('welcome');});

Route::get('/profile', function() { return view('profile');});

Route::get('/ver/{id}', 'App\Http\Controllers\ProfileController@index');

Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/profile', 'App\Http\Controllers\ProfileController@index');
Route::post('/profile/edit', 'App\Http\Controllers\ProfileController@editProfile');
//Route::get('/student', 'App\Http\Controllers\StudentController@showCourses');


Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/student', [App\Http\Controllers\StudentController::class, 'index'])->name('student');

Route::get('/teacher', [App\Http\Controllers\TeacherController::class, 'index'])->name('teacher');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

Route::post('/admin', [App\Http\Controllers\AdminController::class, 'store'])->name('admin');


