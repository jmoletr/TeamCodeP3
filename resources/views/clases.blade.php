@extends('layouts.main')
@section('contenido')
<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panel de Asignaturas</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-user fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <div class="row">
        @if($message = Session::get('Listo'))
            <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
                <h5>Mensaje: </h5>
                <span>{{ $message }}</span>
            </div>
        @endif
        <table class="table col-12 table-responsive">
            <thead>
                <tr>
                    <td>Asignatura</td>
                    <td>Curso</td>
                    <td>Alumno</td>
                    <td>&nbsp;</td>
                </tr>
            </thead>
            <tbody>
            <?php  //dd($clases) ?>
            @foreach($clases as $clase)
            <tr>
                <td>{{$clase->name}}</td>
                <td>{{$clase->name}}</td>
                <td>{{$clase->name}} {{$clase->surname}}</td>
                <td>
                <!-- botonMostrar -->
                &nbsp;
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection