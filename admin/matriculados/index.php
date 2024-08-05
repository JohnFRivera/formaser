<?php
$matriculados = [
    [
        "identificacion" => "12345678",
        "aprendiz" => "John Rivera",
        "ficha" => "2671333",
        "programa" => "Analisis y Desarrollo",
        "estado" => 0,
    ],
    [
        "identificacion" => "2133213",
        "aprendiz" => "Kevin Alzate",
        "ficha" => "2671333",
        "programa" => "Gestion Contable",
        "estado" => 1,
    ],
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
    <title>Formaser | Matriculados</title>
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
                                <a href="../usuarios/" class="nav-link fs-4 fw-semibold d-flex align-items-center">
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
                                <a href="../matriculados/" class="nav-link fs-4 fw-semibold d-flex align-items-center active">
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
                    <i class="bi bi-person-fill-check display-5 text-light"></i>
                </div>
            </div>
            <div class="col">
                <div class="bg-body rounded-4 shadow-sm p-4 p-md-5">
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-hover w-100 fs-5 mb-0">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>Estado</th>
                                            <th>Identificación</th>
                                            <th>Aprendiz</th>
                                            <th>Ficha</th>
                                            <th>Programa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($matriculados as $matriculado) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php
                                                    if ($matriculado["estado"] == 1) {
                                                        echo "<div class='badge text-bg-info text-white shadow-sm'>Activo</div>";
                                                    } else {
                                                        echo "<div class='badge text-bg-danger shadow-sm'>Inactivo</div>";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="badge text-bg-success shadow-sm">
                                                        <?php echo $matriculado["identificacion"] ?>
                                                    </div>
                                                </td>
                                                <td><?php echo $matriculado["aprendiz"] ?></td>
                                                <td>
                                                    <div class="badge text-bg-primary shadow-sm">
                                                        <?php echo $matriculado["ficha"] ?>
                                                    </div>
                                                </td>
                                                <td><?php echo $matriculado["programa"] ?></td>
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ matriculados",
                "infoEmpty": "Mostrando 0 a 0 de 0 matriculados",
                "infoFiltered": "(filtrado de _MAX_ matriculados totales)",
                "lengthMenu": "Mostrar _MENU_ matriculados",
                "loadingRecords": "Cargando...",
                "search": "Buscar:",
                "zeroRecords": "No se encontraron registros coincidentes",
            }
        });
    </script>
</body>

</html>