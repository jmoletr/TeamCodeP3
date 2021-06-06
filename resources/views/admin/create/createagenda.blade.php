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
                                    <label for="start" class="col-md-4 col-form-label text-md-right">Hora de comienzo</label>

                                    <div class="col-md-6">
                                        <input id="start" type="time" class="form-control" name="start" required>
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <label for="end" class="col-md-4 col-form-label text-md-right">Hora de fin</label>

                                    <div class="col-md-6">
                                        <input id="end" type="time" class="form-control" name="end" required>
                                    </div>
                                    
                                </div>
                               

                                <div class="form-group row">
                                    <label for="day" class="col-md-4 col-form-label text-md-right">Día</label>

                                    <div class="col-md-6">
                                        <input id="day" type="date" class="form-control" name="day" required>
                                    </div>
                                    
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" name="crearGuardar" value="agendas" class="btn btn-primary">Guardar</button>
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