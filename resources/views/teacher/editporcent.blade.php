@extends('layouts.main')
@section('contenido')
<?php //dd($idthiswork); ?>
<form action="/teacher" method="POST">
            @csrf
            <div class="form-group">
            
                <label for="work_student">Estudiante</label>
                <select class="form-control" name="id_student">
                    @foreach($students as $student)
                        @if($student->id==(int)$idstudent)
                            <option selected="selected" value={{$student->id}}>{{$student->name}} {{$student->surname}}</option>
                        @endif
                        <option value={{$student->id}}>{{$student->name}} {{$student->surname}}</option>
                    @endforeach
                    
                </select>
                <label for="id_class">Clase</label>
                <select id="id_class" class="form-control" name="id_class">
                    @foreach($clase as $clas)
                        @if($clas->id_class==(int)$idclass)
                            <option selected="selected" value={{$clas->id_class}}>{{$clas->name}}</option>
                        @endif
                        <option value={{$clas->id_class}}>{{$clas->name}}</option>
                    @endforeach
                    
                </select>
                <label for="work_name">Trabajo</label>
                
                <select class="form-control" name="id_course">
                
                    @foreach($courses as $course)
                        @if($course->id_course==(int)$idcourse)
                            <option selected="selected" value={{$course->id_course}}>{{$course->name}}</option>
                        @endif
                            <option  value={{$course->id_course}}>{{$course->name}}</option>
                    @endforeach
                </select>
                <?php //dd($id_percentage); ?>
                
                <input type="hidden" name="id_percentage" value={{$id_percentage['editarporcentaje']}}>
                <label for="work_mark">% Evaluacion Contínua</label>
                <input required class="form-control" id="work_mark" type="number" placeholder="Ev.Cont." name="ec_percent" value={{$ec}}>
                <label for="work_mark">% Examen Final</label>
                <input required class="form-control" id="work_mark" type="number" placeholder="Examen" name="exam_percent" value={{$exam}}>
                <hr>
                <input type="submit" class="btn btn-primary" name="modificacion" value="modificacionPorcent">
            </div>
            </form
@endsection