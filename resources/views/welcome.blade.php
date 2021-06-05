<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>TeamCode</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
    <body>

            <!-- Responsive navbar-->
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container px-lg-5">
                        <a class="navbar-brand" href="#!">TeamCode Academy</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <!--li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                                <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li-->


                                    @if (Route::has('login'))

                                            @auth
                                            <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link">Volver a Panel</a></li>


                                            @else

                                            <li class="nav-item"> <a href="{{ route('login') }}" class="nav-link">Login</a></li>

                                                @if (Route::has('register'))
                                                <li class="nav-item"><a class="nav-link"href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a></li>
                                                @endif
                                            @endauth
                                        </div>
                                @endif
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- Header-->
                <header class="py-5">
                    <div class="container px-lg-5">
                        <div class="p-4 p-lg-5 bg-light rounded-3 text-center">

                                <h1 class="display-5 fw-bold">¡Bienvenidos a la TeamCode Academy!</h1>

                                <br>
                                <img src="assets/informaticos-1100x733.jpg" alt="foto academia" />
                                <div style="margin-top: 30px;" ></div>
                                <p class="fs-3">Descubre nuestra formació profesional online.</p>
                                <p class="fs-4">Regístrate y accede a tu área de usuario.</p>
                                <a class="btn btn-primary btn-lg" href="#!">Ver vídeo Tutorial</a>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Page Content-->
                <section class="pt-4">
                    <div class="container px-lg-5">
                        <!-- Page Features-->
                        <div class="row gx-lg-5">
                            <div class="col-lg-6 col-xxl-4 mb-5">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-calendar-check-fill"></i></div>
                                        <h2 class="fs-4 fw-bold">Área de Alumnos</h2>
                                        <p class="mb-0">Podréis seleccionar los cursos en los que estáis inscritos. Visualizar vuestras asignaturas y clases y vuestras notas de evaluación continua, exámenes y notas finales.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xxl-4 mb-5">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-bookmark-star"></i></div>
                                        <h2 class="fs-4 fw-bold">Área de Profesores</h2>
                                        <p class="mb-0">Acceso a vuestras clases y a los expedientes de los alumnos matriculados en ellas. Podréis modificar trabajos y exámenes, horas y días de entrega y las notas de los trabajos, de la EC y final.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xxl-4 mb-5">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-gear"></i></div>
                                        <h2 class="fs-4 fw-bold">Área de Administrador</h2>
                                        <p class="mb-0">Acceso y modificación de los expedientes de los alumnos con las asignaturas que cursa cada uno y las notas de los trabajos y exámenes. También a todas las asignaturas, sus agendas y porcentajes de notas</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xxl-4 mb-5">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-person-lines-fill"></i></div>
                                        <h2 class="fs-4 fw-bold">Registro</h2>
                                        <p class="mb-0">Para acceder a vuestras respectivas áreas, debéis registraros con los datos personales requeridos.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xxl-4 mb-5">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-person-check-fill"></i></div>
                                        <h2 class="fs-4 fw-bold">Login</h2>
                                        <p class="mb-0">Una vez logados, podreis acceder a vuestra área de referencia y consultar los contenídos específicos.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xxl-4 mb-5">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-person-square"></i></div>
                                        <h2 class="fs-4 fw-bold">Perfil</h2>
                                        <p class="mb-0">Podréis consultar vuestros datos de perfil y modificarlos si fuera necesario.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


            <!-- Footer-->
                <footer class="py-5 bg-dark">
                    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; TeamCode 2021</p></div>
                </footer>
                <!-- Bootstrap core JS-->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
                <!-- Core theme JS-->
                <script src="js/scripts.js"></script>
    </body>
</html>
