<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TeamCode</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Custom fonts for this template-->
    <link href="{{asset ('/dash/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset ('/dash/css/sb-admin-2.min.css')}}" rel="stylesheet">
    @yield('css')
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include('layouts.sidebarStudent')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
        @include('layouts.header')
        <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Estas inscrito en los siguientes Cursos:</h1>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-user fa-sm text-white-50"></i> Generate Report</a>
                </div>
                <div class="row">
                    @if(Session::get('Listo'))
                        <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
                            <h5>Mensaje: </h5>
                            <span>{{  $value = session('Listo') }}</span>
                        </div>
                    @endif
                    <table class="table col-12 table-responsive">
                        <thead>
                        <tr>
                            <td><strong>Curso</strong></td>
                            <td><strong>Descripción</strong></td>
                            <td><strong>Fecha Inicio</strong></td>
                            <td><strong>Fecha Final</strong></td>
                            <td>&nbsp;</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php //dd($asignaturas); ?>
                        @foreach($asignaturas as $asignatura)
                            <tr>
                                <td>{{$asignatura->name}}</td>
                                <td>{{$asignatura->description}}</td>
                                <td>{{$asignatura->date_start}}</td>
                                <td>{{$asignatura->date_end}}</td>
                                <td>
                                    <form action="/student" method="POST">
                                        @csrf
                                        @foreach ($id_class as $id)
                                            @if ($id->id_course == $asignatura->id_course)
                                            <input type="hidden" name="id_class" value={{$id->id_class}}>
                                            @break
                                            @endif
                                        @endforeach
                                        <button class="btn btn-round" type="submit" name="listarclass" value={{$asignatura->id}}> <i class="fa fa-eye"></i>Ver asignaturas</button>
                                    <!-- ¿Dato calculado? <button class="btn btn-round" type="submit" name="modificarEC" value={{$asignatura->id}}><i class="fas fa-poll-h"></i>Modificar EC</button> -->
                                        <button class="btn btn-round" type="submit" name="modificarporcentaje" value={{$asignatura->id}}><i class="fas fa-percent"></i> de EC</button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            <!-- /.container-fluid -->
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; TeamCode 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Dou you want close this session?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-primary" type="submit">Logout</button>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{asset ('/dash/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset ('/dash/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset ('/dash/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset ('/dash/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset ('/dash/vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset ('/dash/js/demo/chart-area-demo.js')}}"></script>
<script src="{{asset ('/dash/js/demo/chart-pie-demo.js')}}"></script>
@yield('scripts')

</body>

</html>


