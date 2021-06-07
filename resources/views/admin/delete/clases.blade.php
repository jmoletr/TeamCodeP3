@extends('layouts.main')
@section('contenido')
<?php //dd($idthiswork); ?>
<form action="/admin" method="POST">
            @csrf
            <div class="form-group">
            
            <label for="work_clase">Clase</label>
                <select class="form-control" name="id_clase">
                    @foreach($class as $clase)
                        <option name="clase" value={{$clase->id_class}}>{{$clase->name}}</option>
                    @endforeach
                </select>
                
                <input type="submit" class="btn btn-primary" name="borrar" value="borrarClase">
            </div>
</form>

<p style="text-danger">Se borrará la <mark>clase</mark> (asignatura) escogida junto a sus <mark>trabajos y exámenes</mark> asociados</p>

@endsection