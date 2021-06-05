@extends('layouts.main')
@section('contenido')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Consulta los detalles de tus examenes</h1>
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
                <td><strong>Nombre de Clase (Asignatura)</strong></td>
                <td><strong>Nombre del Examen</strong></td>
                <td><strong>Calificación</strong></td>
                <td>&nbsp;</td>
            </tr>
            </thead>
            <tbody>
            <?php //dd($exams) ?>
            @foreach($exams as $exam)
                <tr>
                    <td>{{$exam->name}}</td>
                    <td>{{$exam->workname}}</td>
                    <td>{{$exam->mark}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
