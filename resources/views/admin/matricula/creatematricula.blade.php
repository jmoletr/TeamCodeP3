@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Creación de Cursos</div>

                        <div class="card-body">

                            <form method="POST" action="/admin">
                                @csrf

                                <div class="form-group row">
                                    <label for="alumno" class="col-md-4 col-form-label text-md-right">Alumno</label>

                                    <div class="col-md-6">
                                    <select id="alumno" class="form-control" name="id_student">
                                    @foreach($students as $stu)
                                        
                                            <option value={{$stu->id}}>{{$stu->name}} {{$stu->surname}}</option>
                                        
                                    @endforeach
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="curso" class="col-md-4 col-form-label text-md-right">Curso</label>

                                    <div class="col-md-6">
                                    <select id="curso" class="form-control" name="id_course">
                                    @foreach($courses as $curso)
                                        
                                            <option value={{$curso->id_course}}>{{$curso->description}}</option>
                                        
                                    @endforeach
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="id_class" class="col-md-4 col-form-label text-md-right">Clase</label>

                                    <div class="col-md-6">
                                    <select id="id_class" class="form-control" name="id_class">
                                    @foreach($class as $clas)
                                        
                                            <option value={{$clas->id_class}}>{{$clas->name}}</option>
                                        
                                    @endforeach
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="active" class="col-md-4 col-form-label text-md-right">Estatus - Activo</label>

                                    <div class="col-md-6">
                                        <input id="active" type="radio" class="form-control" name="active" value="1">
                                    </div>
                                </div>

                                <!-- Para percentage -->

                                <div class="form-group row">
                                    <label for="ec" class="col-md-4 col-form-label text-md-right">% de Evaluación Contínua</label>

                                    <div class="col-md-6">
                                        <input id="ec" type="number" class="form-control" name="ec">
                                    </div>
                                    
                                </div>

                                <div class="form-group row">
                                    <label for="porcentexam" class="col-md-4 col-form-label text-md-right">% de examen</label>

                                    <div class="col-md-6">
                                        <input id="porcentexam" type="number" class="form-control" name="porcentexam">
                                    </div>
                                    
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" name="crearGuardar" value="matricula" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                                
                            </form>
                               
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection