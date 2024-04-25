<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./libreria/bootstrap5/css/bootstrap.min.css">
    <link rel="stylesheet" href="./libreria/bootstrap5/css/style.css">

    <!-- aca va ir las librerias de CSS de DataTable-->



    <!--------------------------->

</head>

<body>

    <div class="container-md">
        <div class="row">
            <div class="col">
                <h1>Mandar Excel</h1>
            </div>
        </div>

        <div class="row">
            <div class="col primer">
                <h1>Primer Formato</h1>
            </div>
            <div id="mensajeError" class="mensajeError">

            </div>
        </div>
        <form action="modulos/leerExcel.php" class="credit-card-div" method="post" enctype="multipart/form-data">

            <div class="row ">
                <div class="col-md-12 pad-adjust">

                    <div class="input-group mb-3">
                        <input type="file" class="form-control" name="archivotExcel" id="primerArchivo">
                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                    </div>
                </div>
            </div>

            <div class="row ">

                <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
                    <input id="primerFormato" type="button" class="btn btn-warning btn-block" value="ENVIAR" />
                </div>
            </div>
        </form>
        <!----------------------------------------------------------------------------------->
        <hr>
        <!-- aca voy a poner las tablas -->
        <div class="row">
            <div class="col-6">
                <div style="margin-bottom: 50px;" id="tituloTabla1" class="tituloTabla1"></div>

                <div id="mensajeError1" class="mensajeError1"></div>
                <div style="margin-bottom: 80px;" class="datosTabla">
                    <!-- esta es la tabla de los que se agregaron con exito -->
                    <table class="table table-striped table-hover tablaDatos">

                        <thead id="titulosTheadTabla1"></thead>
                        <tbody id="contenidoTabla1"></tbody>
                    </table>
                </div>

            </div>
            <div class="col-6">
                <div style="margin-bottom: 50px;" id="tituloTabla2" class="tituloTabla2"></div>
                <div id="mensajeError2" class="mensajeError2"></div>
                <div style="margin-bottom: 80px;" class="datosTabla">
                    <!-- esta es la tabla de los que no se agregaron con exito -->

                    <table class="table table-striped table-hover tablaDatos">

                        <thead id="titulosTheadTabla2"></thead>
                        <tbody id="contenidoTabla2"></tbody>
                    </table>


                </div>


            </div>
        </div>
        <!--segundo formato-->

        <div class="row">
            <div class="col primer">
                <h1>Segundo Formato</h1>
            </div>
            <!-- aca va ir el mensaje de error -->
            <div id="mensajeErrorSegundoFormato" class="mensajeErrorSegundoFormato">

            </div>
        </div>

        <div class="row ">
            <div class="col-md-12 pad-adjust">

                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="archivotExcel" id="segundoFormato">
                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                </div>
            </div>
        </div>

        <div class="row ">

            <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
                <input id="btnEnviarSegundoFormato" type="button" class="btn btn-warning btn-block" value="ENVIAR" />
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-6">
                <!-- titulo de las tabla donde se va mostrar los que se Actulizaron con exito -->
                <div style="display: flex;justify-content: center;" class="tituloTablaExitoFormato2">
                </div>
                <!-- aca voy a poner la tabla donde se actualizo el estado del aprendiz con exito -->
                <table class="table table-striped table-hover">

                    <thead id="titulosExitoTablaFormato2"></thead>
                    <tbody id="contenidoExitoTablaFormato2"></tbody>
                </table>
                <!---------------------------------------->


            </div>
            <div class="col-6">

                <!-- titulo de las tabla donde se va mostrar los que no se Actualizo con exito -->
                <div style="display: flex;justify-content: center;" class="tituloTablaDenegadoFormato2">

                </div>
                <!-- aca voy a poner la tabla donde se actualizo el estado del aprendiz con exito -->
                <table style="width: 50px; overflow-x: auto;" class="table table-striped table-hover">

                    <thead id="titulosDenegadoTablaFormato2"></thead>
                    <tbody id="contenidoDenegadoTablaFormato2"></tbody>
                </table>
                <!------------>


            </div>
        </div>
        <!------------------------------->
        <!--Tercer formato-->

        <div class="row">
            <div class="col primer">
                <h1>Tercer Formato</h1>
            </div>
            <!-- aca va ir el mensaje de error -->
            <div id="mensajeErrorTercerFormato" class="mensajeErrorTercerFormato">

            </div>
        </div>

        <div class="row ">
            <div class="col-md-12 pad-adjust">

                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="archivotExcel" id="TercerFormato">
                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                </div>
            </div>
        </div>

        <div class="row ">

            <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
                <input id="btnEnviarTercerFormato" type="button" class="btn btn-warning btn-block" value="ENVIAR" />
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-6">
                <!-- titulo de las tabla donde se va mostrar los que se Actulizaron con exito -->
                <div style="display: flex;justify-content: center;" class="tituloTablaExitoFormato3">
                </div>
                <!-- aca voy a poner la tabla donde se actualizo el estado del aprendiz con exito -->
                <table class="table table-striped table-hover">

                    <thead id="titulosExitoTablaFormato3"></thead>
                    <tbody id="contenidoExitoTablaFormato3"></tbody>
                </table>
                <!---------------------------------------->


            </div>
            <div class="col-6">

                <!-- titulo de las tabla donde se va mostrar los que no se Actualizo con exito -->
                <div style="display: flex;justify-content: center;" class="tituloTablaDenegadoFormato3">

                </div>
                <!-- aca voy a poner la tabla donde se actualizo el estado del aprendiz con exito -->
                <table style="width: 50px; overflow-x: auto;" class="table table-striped table-hover">

                    <thead id="titulosDenegadoTablaFormato3"></thead>
                    <tbody id="contenidoDenegadoTablaFormato3"></tbody>
                </table>
                <!------------>


            </div>
        </div>







    </div>






    <script src="./modulos/main.js"></script>
    <script src="./libreria/bootstrap5/js/bootstrap.min.js"></script>



    <!-- aca va ir todas las librerias de dataTable-->







    <!------------------------------------------------->
</body>

</html>