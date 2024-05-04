<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Instituto Formaser - Registrarse</title>
</head>

<body>
    <!--* NAVBAR -->
    <header class="container-fluid shadow" id="navBar">
        <!--? CONTENIDO NAVBAR -->
    </header>
    <!--* FIN NAVBAR -->
    <!--* CONTENIDO -->
    <main class="container-fluid">
        <div class="row justify-content-end bg-img-formaser">
            <div class="col col-sm-7 col-md-6 col-lg-5 col-xl-5 col-xxl-4 align-content-center py-5">
                <!--* INICIO DE SESIÓN -->
                <div class="bg-white border rounded-3 p-4 me-5">
                    <h2 class="fw-bold">REGISTRAR<span class="text-verde">SE</span></h2>
                    <hr>
                
            <!--* MENSAJE DE ERROR *-->
                         <div id="mensajeError" >
                            
                        </div>
                 <!--* FIN MENSAJE DE ERROR *-->
                        <div class="row row-cols-1 row-cols-md-2 mb-2">
                            <div class="col">
                                <label for="txtNombre" class="text-black-50 fs-5 fw-semibold ms-1">Nombres</label>

                                <input type="text" class="form-control bg-body-tertiary border-secondary-subtle mb-2 mb-md-0" name="Nombre" id="txtNombre" maxlength="255" required>
                            </div>
                            <div class="col">
                                <label for="txtApellidos" class="text-black-50 fs-5 fw-semibold ms-1">Apellidos</label>
                                <input type="text" class="form-control bg-body-tertiary border-secondary-subtle" name="Apellido" id="txtApellidos" maxlength="255" required>
                            </div>
                        </div>
                        <label for="txtIdentificacion" class="text-black-50 fs-5 fw-semibold ms-1">Identificación</label>
                        <div class="input-group mb-2">
                            <div class="input-group-text border-secondary-subtle">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5" />
                                    <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96q.04-.245.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 1 1 12z" />
                                </svg>
                            </div>
                            <input type="number" class="form-control bg-body-tertiary border-secondary-subtle" name="Identificacion" id="txtIdentificacion" min="0" required>
                        </div>
                        <label for="txtCorreo" class="text-black-50 fs-5 fw-semibold ms-1">Correo</label>
                        <div class="input-group mb-2">
                            <div class="input-group-text border-secondary-subtle">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z" />
                                    <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648m-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z" />
                                </svg>
                            </div>
                            <input type="email" class="form-control bg-body-tertiary border-secondary-subtle" name="Correo" id="txtCorreo" maxlength="255" required>
                        </div>
                        <label for="txtPassword" class="text-black-50 fs-5 fw-semibold ms-1">Contraseña</label>
                        <div class="input-group mb-2">
                            <div class="input-group-text border-secondary-subtle">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5" />
                                    <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                </svg>
                            </div>
                            <input type="password" class="form-control bg-body-tertiary border-secondary-subtle" name="password" id="txtPassword" minlength="8" required>
                        </div>
                        <input type="password" class="form-control bg-body-tertiary border-secondary-subtle" placeholder="Confirmar contraseña" id="txtConfirmPass" required>
                        <p class="text-danger mb-0 ms-2" id="lblConfirmErr"></p>
                        <input type="button" class="btn btn-verde w-100 mt-4 mb-3" id="btnRegistro" value="Enviar">
                   
                </div>
            </div>
        </div>
    </main>
    <!--* FIN CONTENIDO -->
    <!--* FOOTER -->
    <footer class="container-fluid" id="footerSection">
        <!--? CONTENIDO FOOTER -->
    </footer>
    <!--* FIN FOOTER -->
    <script src="./assets/js/registro.js"></script>
    <script type="module" src="./assets/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>