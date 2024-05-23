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
                                            <a class="nav-link fs-4 text-black-50" href="./index.php">Listado</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fs-4 active" href="./agregar.php">
                                                <i class="bi bi-person-plus-fill"></i>
                                                Agregar
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-md-6 col-lg-4">
                                    <form>
                                        <label class="text-dark fs-5" for="identificacion">Identificación</label>
                                        <input class="form-control mb-3" type="text" name="identificacion" id="identificacion" pattern="^[0-9]*$" required>
                                        <div class="row row-cols-1 row-cols-md-2">
                                            <div class="col mb-3">
                                                <label class="text-dark fs-5" for="nombre">Nombres</label>
                                                <input class="form-control" type="text" name="nombre" id="nombre" required>
                                            </div>
                                            <div class="col mb-3">
                                                <label class="text-dark fs-5" for="apellido">Apellidos</label>
                                                <input class="form-control" type="text" name="apellido" id="apellido" required>
                                            </div>
                                        </div>
                                        <label class="text-dark fs-5" for="correo">Correo Electronico</label>
                                        <input class="form-control mb-3" type="email" name="correo" id="correo" required>
                                        <label class="text-dark fs-5" for="password">Contraseña</label>
                                        <input class="form-control mb-3" type="password" name="password" id="password" minlength="8" required>
                                        <p class="text-danger fs-5 mb-0 pb-2" id="lblErr"></p>
                                        <button class="btn btn-primary" type="button" id="btnAgregar">Agregar</button>
                                    </form>
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
    <script type="module" src="main.agregar.js"></script>
</body>

</html>