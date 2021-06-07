@extends('layouts.main')
@section('contenido')
<?php //dd($idthiswork); ?>
<form action="/admin" method="POST">
            @csrf
            <div class="form-group">
            
            <label for="work_name">Curso</label>
                
                <select class="form-control" name="id_course">
                
                    @foreach($courses as $course)
                            <option  value={{$course->id_course}}>{{$course->name}}</option>
                    @endforeach
                </select>
                
                
                <input type="submit" class="btn btn-primary" name="borrar" value="borrarcurso">
            </div>
</form>

<p style="text-danger">Se borrará el <mark>curso</mark> escogido junto a sus <mark>trabajos y exámenes y también todas sus clases</mark> asociadas</p>
@endsection