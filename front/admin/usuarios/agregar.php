<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/img/sena-logo.png" type="image/png">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Formaser | Agregar Usuario</title>
</head>

<body class="bg-body-secondary">
    <header class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg bg-body shadow px-3 px-md-5">
                <div class="container-fluid">
                    <img class="img-fluid me-4" src="../../assets/img/sena-logo.png" alt="sena_logo">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav gap-1 gap-md-3">
                            <li class="nav-item">
                                <a href="../subir_archivos/pre-inscritos.php" class="nav-link fs-4 fw-semibold d-flex align-items-center">
                                    <i class="bi bi-cloud-arrow-up-fill fs-3 me-2"></i>
                                    Subir Archivos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../pre-inscripciones/" class="nav-link fs-4 fw-semibold d-flex align-items-center">
                                    <i class="bi bi-person-fill-down fs-3 me-2"></i>
                                    Pre-Inscripciones
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../inscripciones/" class="nav-link fs-4 fw-semibold d-flex align-items-center">
                                    <i class="bi bi-person-fill-up fs-3 me-2"></i>
                                    Inscripciones
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../matriculados/" class="nav-link fs-4 fw-semibold d-flex align-items-center">
                                    <i class="bi bi-person-fill-check fs-3 me-2"></i>
                                    Matriculados
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../usuarios/" class="nav-link fs-4 fw-semibold d-flex align-items-center active">
                                    <i class="bi bi-people-fill fs-3 me-2"></i>
                                    Usuarios
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!--* CONTENIDO -->
    <main class="container-fluid h-main">
        <section class="row flex-column py-3 px-0 py-md-4 px-md-4">
            <div class="col">
                <div class="bg-verde rounded-4 d-flex justify-content-center shadow-sm py-3 py-md-4 mb-4">
                    <i class="bi bi-people-fill display-5 text-light"></i>
                </div>
            </div>
            <div class="col">
                <!-- NAV: LISTADO, AGREGAR -->
                <ul class="nav nav-underline d-flex flex-nowrap overflow-x-auto gap-1 px-0">
                    <!--PRE-INSCRITOS-->
                    <li class="nav-item text-nowrap">
                        <a href="./" class="nav-link border-2 fs-5 py-2 px-4 fw-bold text-black-50">
                            Listado
                        </a>
                    </li>
                    <!--INSCRITOS-->
                    <li class="nav-item text-nowrap bg-body rounded-top-3 shadow-sm">
                        <a href="./agregar.php" class="nav-link border-2 fs-5 py-2 px-4 active">
                            Agregar
                        </a>
                    </li>
                </ul>
                <!-- FORMULARIO -->
                <div class="bg-body rounded-4 shadow-sm p-4 p-md-5">
                    <div class="row">
                        <div class="col col-md-7 col-lg-6 col-xl-5 col-xxl-4">
                            <form action="../../../back/modulos/usuarios/usuarios_create.php" method="post">
                                <label for="identificacion" class="text-dark fs-5">Identificación</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="bi bi-person-vcard fs-5"></i>
                                    </span>
                                    <input type="text" name="identificacion" id="identificacion" class="form-control form-control-lg" pattern="^[0-9]*$" required>
                                </div>
                                <div class="row row-cols-1 row-cols-md-2">
                                    <div class="col mb-2">
                                        <label for="nombre" class="text-dark fs-5">Nombres</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" required>
                                    </div>
                                    <div class="col mb-2">
                                        <label for="apellido" class="text-dark fs-5">Apellidos</label>
                                        <input type="text" name="apellido" id="apellido" class="form-control form-control-lg" required>
                                    </div>
                                </div>
                                <label for="correo" class="text-dark fs-5">Correo electrónico</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope-at fs-5"></i>
                                    </span>
                                    <input type="email" name="correo" id="correo" class="form-control form-control-lg" required>
                                </div>
                                <label for="password" class="text-dark fs-5">Contraseña</label>
                                <div class="input-group mb-4">
                                    <span class="input-group-text">
                                        <i class="bi bi-key fs-5"></i>
                                    </span>
                                    <input type="password" name="password" id="password" class="form-control form-control-lg" minlength="8" required>
                                </div>
                                <p class="text-danger fw-semibold fs-5 pb-2 mb-0" id="lblErr"></p>
                                <button type="submit" class="btn btn-lg btn-primary w-100">Agregar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--* FIN CONTENIDO -->
    <footer class="container-fluid">
        <div class="row bg-verde d-flex flex-column flex-md-row justify-content-between py-3 px-4">
            <div class="col-auto">
                <p class="text-white-50 mb-2 mb-md-0">
                    Front-end by
                    <a href="https://github.com/JohnFRivera" target="_blank" class="link-light link-opacity-75 link-opacity-100-hover text-decoration-none">
                        <i class="bi bi-github"></i>
                        John Rivera Ayala
                    </a>&#169 2024
                </p>
            </div>
            <div class="col-auto">
                <p class="text-white-50 mb-0">
                    Back-end by
                    <a href="https://github.com/HectorRestrepo13" target="_blank" class="link-light link-opacity-75 link-opacity-100-hover text-decoration-none">
                        <i class="bi bi-github"></i>
                        Kevinn Andrés Álzate
                    </a>&#169 2024
                </p>
            </div>
        </div>
    </footer>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>