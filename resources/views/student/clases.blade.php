@extends('layouts.main')
@section('contenido')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Consulta tus Asignaturas</h1>
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
                <td><strong>Asignatura</strong></td>
                <td><strong>Nota</strong></td>
                <td><strong>Curso</strong></td>
                <td>&nbsp;</td>
            </tr>
            </thead>
            <tbody>
            <?php //dd($clases) ?>
            @foreach($clases as $clase)
                <tr>
                    <td>{{$clase->nameClass}}</td>
                    <td>
                    @foreach($notas as $nota)
                            @if ($clase->id_class == $nota->id_class)
                                @php
                                    $notacalculada = (float)(($nota->notaworks * $nota->ec / 100 ) + ($nota->notaexamen * $nota->percentexamen / 100)); 
                                    $notacalculada = $notacalculada>=0 ? $notacalculada : $notacalculada = '-';
                                    $flag = true;
                                @endphp
                                {{$notacalculada}}
                                @break;      
                            @endif
                    @endforeach
                    @php
                    if (!$flag){
                        echo ('<td></td>');
                    }
                    @endphp
                    </td>
                    <td>{{$clase->coursesName}}</td>
                    <td>
                        <form action="/student" method="POST">
                            @csrf
                            <button class="btn btn-round" type="submit" name="listartrabajos" value={{$clase->iduser}}+{{$clase->id_class}}> <i class="fas fa-file-word"></i>Trabajos</button>
                            <button class="btn btn-round" type="submit" name="listarexamenes" value={{$clase->iduser}}+{{$clase->id_class}}> <i class="fas fa-diagnoses"></i>Exámenes</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
