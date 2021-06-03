@extends('layouts.main')
@section('contenido')
<form action="/admin" method="POST">
            @csrf
            <div class="form-group">
                
                <label for="work_student">Estudiante</label>
                <select class="form-control" name="student">
                    @foreach($students as $student)
                        <option value={{$student->id}}>{{$student->name}} {{$student->surname}}</option>
                    @endforeach
                </select>
                <?php //dd(session('id_work'));?>
                <label for="work_name">Trabajo</label>
                <select class="form-control" name="work">
                    @foreach($allworks as $allw)
                        @if($allw->id_work==$work)
                        dd('pso if id');
                            <option selected="selected" value={{$allw->id_work}}> seleccionado</option>
                        @endif
                            <option value={{$allw->id_work}}>{{$allw->name}}</option>
                    @endforeach
                </select>
                <label for="work_mark">Calificación</label>
                <input class="form-control" id="work_mark" type="number" placeholder="Calificación" name="work_mark">
                <hr>
                <input type="submit" class="btn btn-primary" name="modificacion" value="modificacionWork">
            </div>
            </form
@endsection