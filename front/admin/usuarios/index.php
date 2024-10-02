<?php
require_once "../../../back/controller/login/verificarAcceso.php";
require_once '../../../back/modulos/usuarios/usuarios.php'; 

$usuario = new Usuario();
$usuarios = $usuario->obtenerTodos();
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
                        <form action="/formaser/back/controller/login/logout.php" class="d-flex ms-auto">
                            <button type="submit" class="btn btn-lg btn-danger rounded-pill fw-semibold">Cerrar sesión</>
                        </form>
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
                                            <th class="text-start">Identificación</th>
                                            <th class="text-start">Nombre</th>
                                            <th class="text-start">Apellido</th>
                                            <th>Correo electrónico</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($usuarios as $usuario) {
                                        ?>
                                            <tr id="row-<?php echo $usuario["identidad"] ?>">
                                                <td class="text-start"><?php echo $usuario["identidad"] ?></td>
                                                <td class="text-start"><?php echo $usuario["nombre"] ?></td>
                                                <td class="text-start"><?php echo $usuario["apellido"] ?></td>
                                                <td class="text-start"><?php echo $usuario["correo"] ?></td>
                                                <td>
                                                    <div class="btn-group shadow-sm">
                                                        <button type="button" onclick="putOnClick(<?php echo $usuario['identidad'] ?>)" class="btn btn-sm btn-outline-info"><i class="bi bi-pencil-square small"></i></button>
                                                        <button type="button" onclick="deleteOnClick(<?php echo $usuario['identidad'] ?>)" class="btn btn-sm btn-danger"><i class="bi bi-trash-fill small"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="modal fade" id="putModal" tabindex="-1" aria-labelledby="putModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="../../../back/modulos/usuarios/usuarios_edit.php" method="post" class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-4 text-primary" id="putModalLabel">Modificar Usuario</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
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
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="bi bi-key fs-5"></i>
                                                    </span>
                                                    <input type="password" name="password" id="password" class="form-control form-control-lg" minlength="8" >
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Modificar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="../../../back/modulos/usuarios/usuarios_delet.php" method="post" id="frmDelete" class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-4 text-danger" id="deleteModalLabel">¡Advertencia!</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="fs-5 mb-0">¿Seguro que deseas eliminar al usuario <b id="lblNombre"></b>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
        const getCols = (id) => {
            var arrayResult = [];
            var cols = document.getElementById(`row-${id}`).children;
            for (let i = 0; i < (cols.length - 1); i++) {
                arrayResult.push(cols.item(i).innerText);
            };
            return arrayResult;
        };
        const putModal = new bootstrap.Modal('#putModal');
        const deleteModal = new bootstrap.Modal('#deleteModal');
        const putOnClick = (id) => {
            var arrayCols = getCols(id);
            document.getElementById("identificacion").value = arrayCols[0];
            document.getElementById("nombre").value = arrayCols[1];
            document.getElementById("apellido").value = arrayCols[2];
            document.getElementById("correo").value = arrayCols[3];
            putModal.show();
        };
        const deleteOnClick = (id) => {
            var arrayCols = getCols(id);
            document.getElementById("frmDelete").action += `?identificacion=${arrayCols[0]}`;
            document.getElementById("lblNombre").innerText = `${arrayCols[1]} ${arrayCols[2]}`;
            deleteModal.show();
        };
    </script>
</body>

</html>