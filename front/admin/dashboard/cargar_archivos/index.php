<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Instituto Formaser - Cargar Archivos</title>
</head>

<body>
    <!--* NAVBAR -->
    <header class="container-fluid shadow" id="navBar">
        <!--? CONTENIDO NAVBAR -->
    </header>
    <!--* FIN NAVBAR -->
    <!--* CONTENIDO -->
    <main class="container-fluid">
        <div class="row">
            <!--? ASIDE -->
            <aside class="col-12 col-sm-3 col-lg-2 px-0 shadow" id="asideBoard">
                <!--? CONTENIDO ASIDE -->
            </aside>
            <!--? SECCIÓN -->
            <section class="col h-main">
                <div class="row p-3 p-md-4">
                    <h2>
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="mb-2" viewBox="0 0 16 16">
                            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707z" />
                        </svg>
                        CARGAR ARCHIVOS
                    </h2>
                    <hr>
                    <!--* OPCIONES -->
                    <ul class="nav nav-underline mb-3">
                        <li class="nav-item">
                            <a class="nav-link px-3 pb-1 active" href="./">Agregar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-black-50 px-3 pb-1" href="./listado.php">Listado</a>
                        </li>
                    </ul>
                    <!--* SUBIR ARCHIVO -->
                    <div class="col">
                        <div class="row mt-4">
                            <!--? PRE-INSCRITO -->
                            <div class="col-12 col-sm-8 col-md-7 col-lg-6 col-xl-4 mb-4 pb-4 border-bottom">
                                <form action="" method="post">
                                    <h3 class="bg-azul-3 text-white rounded-3 p-2 d-flex align-items-center justify-content-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.354-5.854 1.5 1.5a.5.5 0 0 1-.708.708L13 11.707V14.5a.5.5 0 0 1-1 0v-2.793l-.646.647a.5.5 0 0 1-.708-.708l1.5-1.5a.5.5 0 0 1 .708 0M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                            <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                                        </svg>
                                        Pre-inscrito
                                    </h3>
                                    <div id="fileInfo-archivo-preinscrito"></div>
                                    <label for="archivo-preinscrito" class="btn btn-outline-azul archivo-preinscrito fs-5 mb-3 w-100">
                                        <input type="file" class="visually-hidden" name="archivo-preinscrito" id="archivo-preinscrito" accept="application/pdf" required>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="mb-1 me-1" viewBox="0 0 16 16">
                                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                            <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                                        </svg>
                                        Seleccionar Archivo
                                    </label>
                                    <input type="submit" class="btn btn-verde w-100" value="Subir">
                                </form>
                            </div>
                            <!--? INSCRITO -->
                            <div class="col-12 col-sm-8 col-md-7 col-lg-6 col-xl-4 mb-4 pb-4 border-bottom">
                                <form action="" method="post">
                                    <h3 class="bg-azul-2 text-white rounded-3 p-2 d-flex align-items-center justify-content-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                                            <path d="M12.5 9a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7m.354 5.854 1.5-1.5a.5.5 0 0 0-.708-.708l-.646.647V10.5a.5.5 0 0 0-1 0v2.793l-.646-.647a.5.5 0 0 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                            <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                                        </svg>
                                        Inscrito
                                    </h3>
                                    <div id="fileInfo-archivo-inscrito"></div>
                                    <label for="archivo-inscrito" class="btn btn-outline-azul archivo-inscrito fs-5 mb-3 w-100">
                                        <input type="file" class="visually-hidden" name="archivo-inscrito" id="archivo-inscrito" accept="application/pdf" required>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="mb-1 me-1" viewBox="0 0 16 16">
                                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                            <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                                        </svg>
                                        Seleccionar Archivo
                                    </label>
                                    <input type="submit" class="btn btn-verde w-100" value="Subir">
                                </form>
                            </div>
                            <!--? MATRICULADO -->
                            <div class="col-12 col-sm-8 col-md-7 col-lg-6 col-xl-4 mb-4 pb-4 border-bottom">
                                <form action="" method="post">
                                    <h3 class="bg-azul text-white rounded-3 p-2 d-flex align-items-center justify-content-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                            <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                                        </svg>
                                        Matriculado
                                    </h3>
                                    <div id="fileInfo-archivo-matriculado"></div>
                                    <label for="archivo-matriculado" class="btn btn-outline-azul archivo-matriculado fs-5 mb-3 w-100">
                                        <input type="file" class="visually-hidden" name="archivo-matriculado" id="archivo-matriculado" accept="application/pdf" required>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="mb-1 me-1" viewBox="0 0 16 16">
                                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                            <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                                        </svg>
                                        Seleccionar Archivo
                                    </label>
                                    <input type="submit" class="btn btn-verde w-100" value="Subir">
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--* FIN SUBIR ARCHIVO -->
                </div>
            </section>
        </div>
    </main>
    <!--* FIN CONTENIDO -->
    <!--* FOOTER -->
    <footer class="container-fluid cursor-default" id="footerSection">
        <!--? CONTENIDO FOOTER -->
    </footer>
    <!--* FIN FOOTER -->

    <script type="module" src="../assets/js/globals.dashboard.js"></script>
    <script src="./assets/js/main.js"></script>
</body>

</html>