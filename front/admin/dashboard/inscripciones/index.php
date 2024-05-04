<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Instituto Formaser | Inscripciones</title>
</head>

<body>
    <!--* NAVBAR -->
    <header class="container-fluid shadow" id="navBar">
        <!--? CONTENIDO NAVBAR -->
    </header>
    <!--* FIN NAVBAR -->
    <!--* CONTENIDO -->
    <main class="container-fluid">
        <div class="row bg-body-secondary">
            <!--? ASIDE -->
            <aside class="col-12 col-md-auto px-0 bg-body shadow-sm" id="asideBoard"></aside>
            <!--? SECCIÓN -->
            <section class="col">
                <div class="row p-0 p-md-4 h-main">
                    <div class="col">
                        <!--LOGO-->
                        <div class="row bg-body py-3 mb-4 rounded-3 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M12.5 9a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7m.354 5.854 1.5-1.5a.5.5 0 0 0-.708-.708l-.646.647V10.5a.5.5 0 0 0-1 0v2.793l-.646-.647a.5.5 0 0 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                            </svg>
                        </div>
                        <div class="row">
                            <!--FUNCIONES-->
                            <div class="col">
                                <div class="row bg-body shadow-sm rounded-3">
                                    <div class="col p-1 p-md-4">
                                        <div class="row">
                                            <p class="fs-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="mb-1 me-1" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                                </svg>
                                                Aquí podrás visualizar las Inscripciones almacenadas en la base de datos.
                                            </p>
                                            <div class="col">
                                            <div class="table-responsive mb-2">
                                                <table class="table table-hover table-striped" id="dataTable">
                                                    <thead id="tblHead">
                                                        <tr>
                                                            <th scope="col">Identificación</th>
                                                            <th scope="col">Nombre</th>
                                                            <th scope="col">Ficha</th>
                                                            <th scope="col">Nombre Programa</th>
                                                            <th scope="col">Estado</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tblBody"></tbody>
                                                </table>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script src="../assets/js/jquery-3.7.1.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/dataTables.js"></script>
    <script src="../assets/js/dataTables.bootstrap5.js"></script>
    <script src="../assets/js/dataTables.responsive.js"></script>
    <script src="../assets/js/responsive.dataTables.js"></script>
    <script src="../assets/js/dataTables.buttons.js"></script>
    <script src="../assets/js/buttons.dataTables.js"></script>
    <script src="../assets/js/jszip.min.js"></script>
    <script src="../assets/js/pdfmake.min.js"></script>
    <script src="../assets/js/vfs_fonts.js"></script>
    <script src="../assets/js/buttons.html5.min.js"></script>
    <script src="../assets/js/buttons.print.min.js"></script>
    <script type="module" src="main.js"></script>
</body>

</html>