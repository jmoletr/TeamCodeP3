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
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Nombre de la clase</label>

                                    <div class="col-md-6">
                                        <input id="nameclass" type="text" class="form-control" name="nameclass" required>
                                    </div>
                                    
                                </div>

                                <div class="form-group row">
                                    <label for="id_teacher" class="col-md-4 col-form-label text-md-right">Descripción</label>

                                    <div class="col-md-6">
                                    <select id="id_teacher" class="form-control" name="id_teacher">
                                    @foreach($teachers as $prof)
                                        
                                            <option value={{$prof->id}}>{{$prof->name}} {{$prof->surname}}</option>
                                        
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
                                    <label for="date_start" class="col-md-4 col-form-label text-md-right">Fecha Comienzo</label>
                                    <div class="col-md-6">
                                    <select id="id_teacher" class="form-control" name="id_teacher">
                                    @foreach($agendas as $agenda)
                                        
                                            <option value={{$agenda->id_schedule}}>Día: {{$agenda->day}}, Comienzo: {{$agenda->time_start}}, fin: {{$agenda->time_end}}</option>
                                        
                                    @endforeach
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
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