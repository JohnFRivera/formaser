<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="container-fluid bg-body-secondary">
    <header class="row" id="header"></header>
    <!--* CONTENIDO -->
    <main class="row">
        <section class="col">
            <div class="row flex-column p-0 p-md-5">
                <div class="col">
                    <div class="bg-verde py-4 mb-4 rounded-3 shadow-sm d-flex justify-content-center">
                        <i class="bi bi-person-fill-check display-5 text-light"></i>
                    </div>
                </div>
                <div class="col">
                    <div class="bg-body rounded-3 p-5">
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