<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="container-fluid bg-body-secondary">
    <header class="row" id="header"></header>
    <!--* CONTENIDO -->
    <main class="container-fluid">
        <div class="row">
            <!--? ASIDE -->
            <aside class="col-12 col-md-auto px-0 bg-body-tertiary shadow" id="asideBoard"></aside>
            <!--? SECCIÓN -->
            <section class="col">
                <div class="row flex-column p-0 p-md-5">
                    <div class="col">
                        <div class="bg-verde py-4 mb-4 rounded-3 shadow-sm d-flex justify-content-center">
                            <i class="bi bi-people-fill display-5 text-light"></i>
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg-body rounded-3 p-5">
                            <div class="row mb-4 border-bottom">
                                <div class="col">
                                    <ul class="nav nav-underline gap-5">
                                        <li class="nav-item">
                                            <a class="nav-link fs-4 active" href="./index.php">Listado</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fs-4 text-black-50" href="./agregar.php">
                                                <i class="bi bi-person-plus-fill"></i>
                                                Agregar
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table id="dataTable" class="table table-hover table-striped w-100">
                                            <thead class="fs-5"></thead>
                                            <tbody></tbody>
                                        </table>
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
    <footer class="row cursor-default" id="footer"></footer>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"></div>

    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/pdfmake.min.js"></script>
    <script src="../assets/js/vfs_fonts.js"></script>
    <script src="../assets/js/datatables.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="module" src="main.js"></script>
</body>

</html>