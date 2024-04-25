<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Instituto Formaser | Usuarios</title>
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
            <aside class="col-12 col-md-auto px-0 shadow" id="asideBoard">
                <!--? CONTENIDO ASIDE -->
            </aside>
            <!--? SECCIÓN -->
            <section class="col h-main">
                <div class="row p-3 p-md-4">
                    <h2>
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="mb-2" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
                        </svg>
                        Usuarios
                    </h2>
                    <hr>
                    <!--* CONTENIDO -->
                    <div class="row">
                    <div class="col">
                            <div class="table-responsive pb-5">
                                <table id="dataTable" class="table table-hover table-striped" style="width:100%">
                                    <thead class="fs-5">
                                        <tr>
                                            <th>Identificación</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Correo</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tblUsuarios">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--* FIN CONTENIDO -->
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
    <script src="../assets/js/configTables.js"></script>
    <script src="./assets/js/main.js"></script>
</body>

</html>