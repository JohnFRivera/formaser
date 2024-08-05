<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/img/sena-logo.png" type="image/png">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <title>Formaser | Iniciar sesión</title>
</head>

<body class="container-fluid">
    <!--* CONTENIDO -->
    <main class="row bg-img-formaser justify-content-center align-content-center">
        <div class="col-auto">
            <!--* INICIO DE SESIÓN -->
            <form action="./back/controller/login/login.php" method="post" class="bg-body rounded-4 p-5 shadow-sm">
                <h1 class="fw-bold text-center mb-4">INICIAR<i class="fst-normal text-verde">SESIÓN</i></h1>
                <p class="text-danger fw-semibold fs-5 mb-3" id="lblErr"></p>
                <!--? CORREO ELECTRÓNICO -->
                <div class="input-group mb-3">
                    <div class="input-group-text border-dark-subtle">
                        <i class="bi bi-envelope-at-fill fs-5"></i>
                    </div>
                    <div class="form-control border-dark-subtle p-0">
                        <div class="form-floating">
                            <input type="email" name="correo" class="form-control border-0 rounded-start-0" placeholder="Correo electrónico" required>
                            <label for="floatingInput">Correo electrónico</label>
                        </div>
                    </div>
                </div>
                <!--? CONTRASEÑA -->
                <div class="input-group mb-4">
                    <div class="input-group-text border-dark-subtle">
                        <i class="bi bi-key-fill fs-5"></i>
                    </div>
                    <div class="form-control border-dark-subtle p-0 border-end-0">
                        <div class="form-floating">
                            <input type="password" name="password" id="password" class="form-control border-0 rounded-start-0 rounded-end-0" placeholder="Contraseña" minlength="8" required>
                            <label for="password">Contraseña</label>
                        </div>
                    </div>
                    <div class="input-group-text bg-body border-dark-subtle border-start-0">
                        <button type="button" id="showPass" class="btn p-0 border-0">
                            <i class="bi bi-eye fs-4"></i>
                        </button>
                    </div>
                </div>
                <!--? BOTÓN INGRESAR -->
                <div class="mt-2 mt-sm-0 d-flex justify-content-end">
                    <button type="submit" class="btn btn-lg btn-verde px-4">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        Entrar
                    </button>
                </div>
            </form>
        </div>
    </main>
    <!--* FIN CONTENIDO -->
    <footer class="row bg-verde d-flex flex-column flex-md-row justify-content-between py-3 px-4">
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
    </footer>
</body>

</html>