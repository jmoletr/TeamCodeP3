@extends('layouts.main')
@section('contenido')
<?php //dd($idthiswork); ?>
<form action="/admin" method="POST">
            @csrf
            <div class="form-group">
            
                <label for="work_student">Usuario a borrar </label>
                <select class="form-control" name="usuariodelete">
                    @foreach($usuarios as $usuario)
                    @php
                        if ($usuario->rol_id==1){$usuariorol = 'Admin';}
                        if ($usuario->rol_id==2){$usuariorol = 'Estudiante';}
                        if ($usuario->rol_id==3){$usuariorol = 'Profesor';}
                    @endphp
                        <option value={{$usuario->id}}>{{$usuario->name}} {{$usuario->surname}} | Rol: {{$usuariorol}}</option>
                    @endforeach
                    
                </select>
                
                <input type="submit" class="btn btn-primary" name="borrar" value="borrarusuario">
            </div>
            </form
@endsection