@extends('layouts.main')
@section('contenido')

<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panel de Trabajos</h1>
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
                    <td>Alumno</td>
                    <td>Nombre de Clase (Asignatura)</td>
                    <td>Nombre de trabajo</td>
                    <td>Calificación</td>
                    <td>&nbsp;</td>
                </tr>
            </thead>
            <tbody>
            <?php //dd($exams) ?>
            @foreach($exams as $exam)
            <tr>
                <td>{{$exam->name}}</td>
                <td>{{$exam->nameclass}}</td>
                <td>{{$exam->workname}}</td>
                <td>{{$exam->mark}}</td>
                <td>
                        <form action="/teacher" method="POST">
                        @csrf
                            <input type="hidden" id="idtrabajo" name="idtrabajo">
                            <button class="btn btn-round btn-primary" type="submit" name="editartrabajos" value={{$exam->id_exam}} > <i class="fas fa-edit"></i>Editar</button>
                            <button class="btn btn-round btn-danger" type="submit" name="borrartrabajos" value={{$  exam->id_exam}}> <i class="fas fa-trash"></i>Eliminar</button>
                        </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
