<?php
$usuarios = [
    [
        "identificacion" => "12345678",
        "nombre" => "Jaimito",
        "apellido" => "Alimaña",
        "correo" => "jaimito12@gmail.com"
    ],
    [
        "identificacion" => "100232223",
        "nombre" => "Pepito",
        "apellido" => "Martinez",
        "correo" => "pepe23@gmail.com"
    ]
]
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/img/sena-logo.png" type="image/png">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/datatables.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Formaser | Usuarios</title>
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
                                <a href="../usuarios/" class="nav-link fs-4 fw-semibold d-flex align-items-center active">
                                    <i class="bi bi-people-fill fs-3 me-2"></i>
                                    Usuarios
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
                    <li class="nav-item text-nowrap bg-body rounded-top-3 shadow-sm">
                        <a href="./" class="nav-link border-2 fs-5 py-2 px-4 active">
                            Listado
                        </a>
                    </li>
                    <!--INSCRITOS-->
                    <li class="nav-item text-nowrap">
                        <a href="./agregar.php" class="nav-link border-2 fs-5 py-2 px-4 fw-bold text-black-50">
                            Agregar
                        </a>
                    </li>
                </ul>
                <!-- TABLA -->
                <div class="bg-body rounded-bottom-4 rounded-end-4 shadow-sm p-4 p-md-5">
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-hover w-100 fs-5 mb-0">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Identificación</th>
                                            <th>Correo electrónico</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($usuarios as $usuario) {
                                        ?>
                                            <tr>
                                                <td><?php echo $usuario["nombre"] ?></td>
                                                <td><?php echo $usuario["apellido"] ?></td>
                                                <td>
                                                    <div class="badge text-bg-success shadow-sm">
                                                        <?php echo $usuario["identificacion"] ?>
                                                    </div>
                                                </td>
                                                <td><?php echo $usuario["correo"] ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-danger"><i class="bi bi-trash-fill small"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
    <script src="../assets/js/pdfmake.min.js"></script>
    <script src="../assets/js/vfs_fonts.js"></script>
    <script src="../assets/js/datatables.min.js"></script>
    <script>
        let table = new DataTable('#dataTable', {
            language: {
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ usuarios",
                "infoEmpty": "Mostrando 0 a 0 de 0 usuarios",
                "infoFiltered": "(filtrado de _MAX_ usuarios totales)",
                "lengthMenu": "Mostrar _MENU_ usuarios",
                "loadingRecords": "Cargando...",
                "search": "Buscar:",
                "zeroRecords": "No se encontraron registros coincidentes",
            }
        });
    </script>
</body>

</html>