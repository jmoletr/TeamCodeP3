@extends('layouts.main')
@section('contenido')
<?php //dd($idthiswork); ?>
<form action="/admin" method="POST">
            @csrf
            <div class="form-group">
            
                <label for="work_student">Estudiante</label>
                <select class="form-control" name="student">
                    @foreach($students as $student)
                        @if($student->id==(int)$idstudent)
                            <option selected="selected" value={{$student->id}}>{{$student->name}} {{$student->surname}}</option>
                        @endif
                        <option value={{$student->id}}>{{$student->name}} {{$student->surname}}</option>
                    @endforeach
                    
                </select>
                <label for="work_student">Clase</label>
                <select class="form-control" name="student">
                    @foreach($clase as $clas)
                        @if($clas->id_class==(int)$idclass)
                            <option selected="selected" value={{$clas->id_class}}>{{$clas->name}}</option>
                        @endif
                        <option value={{$clas->id_class}}>{{$clas->name}}</option>
                    @endforeach
                    
                </select>
                <?php //dd($allworks);?>
                <label for="work_name">Trabajo</label>
                
                <select class="form-control" name="work">
                
                    @foreach($courses as $course)
                        @if($course->id_course==(int)$idcourse)
                            <option selected="selected" value={{$course->id_course}}>{{$course->name}}</option>
                        @endif
                            <option  value={{$course->id_course}}>{{$course->name}}</option>
                    @endforeach
                </select>
                
                <label for="work_mark">% Evaluacion Contínua</label>
                <input required class="form-control" id="work_mark" type="number" placeholder="Ev.Cont." name="work_mark" value="{{$ec}}">
                <label for="work_mark">% Examen Final</label>
                <input required class="form-control" id="work_mark" type="number" placeholder="Examen" name="work_mark" value=" {{$exam}}">
                <hr>
                <input type="submit" class="btn btn-primary" name="modificacion" value="modificacionPorcent">
            </div>
            </form
@endsection