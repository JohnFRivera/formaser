<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <!--* CONTENIDO -->
    <main class="container-fluid">
        <div class="row justify-content-center bg-img-formaser">
            <div class="col col-sm-6 col-md-5 col-lg-4 col-xl-4 col-xxl-3 align-content-center">
                <!--* INICIO DE SESIÓN -->
                <div class="bg-body-tertiary border rounded-3 p-5 shadow">
                    <h2 class="fw-bold">INICIAR <span class="text-verde">SESIÓN</span></h2>
                    <hr>
                    <p class="text-danger fw-semibold fs-5 mb-0 pb-2" id="lblErr"></p>
                    <form>
                        <!--? CORREO ELECTRÓNICO -->
                        <div class="input-group mb-3">
                            <div class="input-group-text border-dark-subtle">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z" />
                                    <path
                                        d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648m-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z" />
                                </svg>
                            </div>
                            <div class="form-control border-dark-subtle p-0">
                                <div class="form-floating">
                                    <input type="email" class="form-control border-0 rounded-start-0" name="correo"
                                        id="correo" placeholder="Correo electrónico" required>
                                    <label for="floatingInput">Correo electrónico</label>
                                </div>
                            </div>
                        </div>
                        <!--? CONTRASEÑA -->
                        <div class="input-group mb-4">
                            <div class="input-group-text border-dark-subtle">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5" />
                                    <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                </svg>
                            </div>
                            <div class="form-control border-dark-subtle p-0 border-end-0">
                                <div class="form-floating">
                                    <input type="password" class="form-control border-0 rounded-start-0 rounded-end-0"
                                        name="password" id="password" placeholder="Contraseña" minlength="8" required>
                                    <label for="password">Contraseña</label>
                                </div>
                            </div>
                            <div class="input-group-text border-dark-subtle border-start-0">
                                <button type="button" class="btn p-0 border-0" id="showPass">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!--? BOTÓN INGRESAR -->
                    <div class="mt-2 mt-sm-0 d-flex justify-content-end">
                        <button class="btn btn-lg btn-verde px-4" type="button" id="btnEntrar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor"
                                class="mb-1" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                                <path fill-rule="evenodd"
                                    d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                            </svg>
                            Entrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--* FIN CONTENIDO -->
    <footer class="container-fluid"></footer>

    <script type="module" src="main.js"></script>
</body>

</html>