@extends('layouts.main')
@section('contenido')
<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Porcentajes de Evaluación</h1>
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
                    <td>Nombre de la Clase</td>
                    <td>Nombre del curso</td>
                    <td>% de Ev. Contínua</td>
                    <td>% del examen final</td>
                    <td>&nbsp;</td>
                </tr>
            </thead>
            <tbody>
            <?php  //dd($porcent); ?>
            @foreach($porcent as $por)
            <tr>
                <td>{{$por->nameStudent}} {{$por->apellido}}</td>
                <td>{{$por->clase}}</td>
                <td>{{$por->curso}}</td>
                <td>{{$por->continuous_assessment}}</td>
                <td>{{$por->exams}}</td>
                <td>
                        <form action="#" method="POST">
                        @csrf
                            <input type="hidden" name="idclass" value={{$por->classid}}>
                            <input type="hidden" name="idcourse" value={{$por->courseid}}>
                            <input type="hidden" name="idstudent" value={{$por->studentId}}>
                            <input type="hidden" name="ec" value={{$por->continuous_assessment}}>
                            <input type="hidden" name="exam" value={{$por->exams}}>
                            <button class="btn btn-round btn-primary" type="submit" name="editarporcentaje" value={{$por->id_percentage}}> <i class="fas fa-edit"></i>Editar</button>
                        </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    
@endsection