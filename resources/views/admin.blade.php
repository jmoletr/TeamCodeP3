@extends('layouts.main')
@section('contenido')
<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panel Administración</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-user fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <div class="row">
        @if(Session::get('Listo'))
            <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
                <h5>Mensaje: </h5>
                <span>{{  $value = session('Listo') }}</span>
                @php session(['Listo'=>null]) @endphp
            </div>
        @endif
        <table class="table col-12 table-responsive">
            <thead>
                <tr>
                    <td>Estudiante</td>
                    <td>Curso</td>
                    <td>Ver detalles</td>
                </tr>
            </thead>
            <tbody>
            <?php  //dd($asignaturas) ?>
            @foreach($asignaturas as $asignatura)
                <tr>
                    <td>{{$asignatura->name}} {{$asignatura->surname}}</td>
                    <td>{{$asignatura->description}}</td>
                    <td>
                        <form action="/admin" method="POST">
                        @csrf
                            <button class="btn btn-round" type="submit" name="listarclass" value={{$asignatura->id}}> <i class="fa fa-eye"></i>Ver detalles</button>
                            <!-- ¿Dato calculado? <button class="btn btn-round" type="submit" name="modificarEC" value={{$asignatura->id}}><i class="fas fa-poll-h"></i>Modificar EC</button> -->
                            <button class="btn btn-round" type="submit" name="modificarporcentaje" value={{$asignatura->id}}><i class="fas fa-percent"></i> de EC</button>
                            
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="container">
            <div class="row">
                <div class="jumbotron" id="altas">
                    <h1 class="display-4">Zona de Altas</h1>
                    <p class="lead">Gestiona la creación de diferentes las diferentes entidades</p>
                    <hr class="my-4">
                    
                        <form action="/admin" method="POST">
                        @csrf
                            <button type="submit" name="crear" value="crear_cursos" class="btn btn-primary">Cursos</button>
                            <button type="submit" name="crear" value="crear_clases" class="btn btn-primary">Clases</button>
                            <button type="submit" name="crear" value="crear_agendas" class="btn btn-primary">Agendas</button>
                            <button type="submit" name="crear" value="crear_examenes" class="btn btn-primary">Exámenes</button>
                            <button type="submit" name="crear" value="crear_trabajos" class="btn btn-primary">Trabajos de Ev.Cont</button>
                        </form>
                    
                </div>
                <hr>
                <div class="jumbotron">
                    
                    <h1 class="display-4">Zona de Matrícula</h1>
                    <p class="lead">Realiza la matrícula de un estudiante</p>
                    <hr class="my-4">
                    <form action="/admin" method="POST">
                        @csrf
                            <button type="submit" name="crear" value="matricula" class="btn btn-primary">Matricular</button>
                        </form>
                    
                    
                </div>
                <div class="jumbotron bg-danger text-white">
                    
                    <h1 class="display-4">Zona ¡DANGER!</h1>
                    <p class="lead">ZONA DE BORRADO PERMANENTE</p>
                    <hr class="my-4">
                    <form action="/admin" method="POST">
                        @csrf
                            <button type="submit" class="btn btn-warning text-primary" name="borrar" value="usuarios" class="btn btn-primary">Borrar Usuarios</button>
                            <button type="submit" class="btn btn-warning text-primary" name="borrar" value="cursos" class="btn btn-primary">Borrar Cursos</button>
                            <button type="submit" class="btn btn-warning text-primary" name="borrar" value="clases" class="btn btn-primary">Borrar Clases</button>
                            
                    </form>
                    
                    
                </div>
            </div>
        </div>
        

    </div>
@endsection

