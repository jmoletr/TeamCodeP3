@extends('layouts.main')
@section('contenido')
<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panel Estudiante</h1>
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
                    <td>Estudiante</td>
                    <td>Curso</td>
                    <td>&nbsp;</td>
                </tr>
            </thead>
            <tbody>
            <!-- <?php // dd($asignaturas) ?> -->
            @foreach($asignaturas as $asignatura)
                <tr>
                    <td>Alumno: {{$asignatura->name}} {{$asignatura->surname}}</td>
                    <td>Curso: {{$asignatura->description}}</td>
                    <td>
                        <button class="btn btn-round"> <i class="fa fa-eye"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
