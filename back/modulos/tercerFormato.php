<?php

require "../libreria/vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\IOFactory;
require 'MYSQL.php';

// Arreglo para almacenar los datos
$arregloActualizados = array();

// Verifica si se subió el archivo
if ($_FILES['archivotExcel']['size'] > 0) {
    $archivoExcel_temporal = $_FILES['archivotExcel']['tmp_name'];
    $tipo_archivo = $_FILES['archivotExcel']['type'];

    // Valida el tipo de archivo Excel
    if ($tipo_archivo == "application/vnd.ms-excel" || $tipo_archivo == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
        importarDatos($archivoExcel_temporal);
    } else {
        // Error de tipo de archivo
        $arregloError = array(
            'status' => "404",
            'descripcion' => "Sólo se pueden subir archivos de tipo Excel. Tipo de archivo subido: " . $tipo_archivo,
        );
        $arregloActualizados['error'][] = $arregloError;
        echo json_encode($arregloActualizados);
    }
}

// Función para importar datos
function importarDatos($archivoExcel)
{
    global $arregloActualizados; // Accede al arreglo global

    $documento = IOFactory::load($archivoExcel); // Carga el archivo Excel
    $hojaExcel = $documento->getActiveSheet(); // Selecciona la hoja activa
    $filasDeHojaExcel = $hojaExcel->getHighestDataRow(); // Obtiene el número de filas

    // Verifica si el formato del archivo es válido
    if ($hojaExcel->getCell('A3') && $hojaExcel->getCell('A4') && $hojaExcel->getCell('A6') && $hojaExcel->getCell('B6') && $hojaExcel->getCell('C6') && $hojaExcel->getCell('B3') && $hojaExcel->getCell('B4')) {
        $codigoFicha = trim($hojaExcel->getCell('B3'));
        $programaFormacion = trim($hojaExcel->getCell('B4'));

        // Verifica si hay al menos una fila con estado "Matriculado"
        $formatoValido = false;
        for ($fila = 7; $fila <= $filasDeHojaExcel; $fila++) {
            $estado = trim($hojaExcel->getCell('C' . $fila));
            if ($estado == "Matriculado") {
                $formatoValido = true;
                break;
            }
        }

        if ($formatoValido) {
            // Recorre las filas y procesa los datos
            for ($fila = 7; $fila <= $filasDeHojaExcel; $fila++) {
                $cedula = trim($hojaExcel->getCell('A' . $fila));
                $nombre = trim($hojaExcel->getCell('B' . $fila));
                $estado = trim($hojaExcel->getCell('C' . $fila));

                if ($cedula && $codigoFicha && $nombre && $estado) {
                    $cedulaEnLimpio = explode('-', $cedula)[1];
                    $data = actulizarDatos($codigoFicha, $cedulaEnLimpio, $programaFormacion, $nombre);

                    if ($data['status']) {
                        $arregloActualizados['updateExito'][] = $data;
                    } else {
                        $arregloActualizados['updateDenegado'][] = $data;
                    }
                }
            }
        } else {
            // Error de formato
            $arregloError = array(
                'status' => "404",
                'descripcion' => "TIPO DE FORMATO EQUIVOCADO",
            );
            $arregloActualizados['error'][] = $arregloError;
        }
    } else {
        // Error en el formato del archivo
        $arregloError = array(
            'status' => "404",
            'descripcion' => "Formato de archivo no válido.",
        );
        $arregloActualizados['error'][] = $arregloError;
    }

    // Devuelve los resultados en formato JSON
    echo json_encode($arregloActualizados);
}

// Función para actualizar los datos del aprendiz
function actulizarDatos($numeroFicha, $cedulaPaciente, $nombrePrograma, $nombreAprendiz)
{
    $arregloDatos = array();
    $mysql = new MYSQL();

    // Verifica si el aprendiz existe
    $consultaSiExiste = $mysql->efectuarConsulta("SELECT * FROM inscripcionaprendiz1 WHERE cedula = ? AND numeroFicha = ?", [$cedulaPaciente, $numeroFicha]);

    if (mysqli_num_rows($consultaSiExiste) > 0) {
        // Verifica si ya está matriculado
        $consulta = $mysql->efectuarConsulta("SELECT * FROM inscripcionaprendiz1 WHERE cedula = ? AND numeroFicha = ? AND estado = 'Matriculado'", [$cedulaPaciente, $numeroFicha]);

        if (mysqli_num_rows($consulta) == 0) {
            $fecha_actual = date("Y-m-d"); // Captura la fecha actual

            // Actualiza el aprendiz
            $mysql->efectuarConsulta("UPDATE inscripcionaprendiz1 SET nombreCompleto = ?, nombrePrograma = ?, estado = 'Matriculado', fechaMatricula = ? WHERE cedula = ? AND numeroFicha = ? AND estado = 'Preinscrito'", [$nombreAprendiz, $nombrePrograma, $fecha_actual, $cedulaPaciente, $numeroFicha]);
            $numFilasAfectadas = $mysql->filasAfectadas();
            $mysql->desconectar();

            if ($numFilasAfectadas > 0) {
                // Aprendiz actualizado con éxito
                $aprendiz_actualizadoExito = array(
                    'cedula' => $cedulaPaciente,
                    'nombre' => $nombreAprendiz,
                    'codigoFicha' => $numeroFicha,
                    'estado' => 'Matriculado',
                    'nombrePrograma' => $nombrePrograma,
                    'descripcion' => 'Actualizado con éxito',
                    'status' => true
                );
                $arregloDatos['updateExito'][] = $aprendiz_actualizadoExito;
                return $aprendiz_actualizadoExito;
            } else {
                // Aprendiz no se pudo actualizar
                $aprendiz_denegado = array(
                    'cedula' => $cedulaPaciente,
                    'nombre' => $nombreAprendiz,
                    'codigoFicha' => $numeroFicha,
                    'estado' => 'Preinscrito',
                    'nombrePrograma' => $nombrePrograma,
                    'descripcion' => 'Este aprendiz no está preinscrito',
                    'status' => false
                );
                $arregloDatos['updateDenegado'][] = $aprendiz_denegado;
                return $aprendiz_denegado;
            }
        } else {
            // Aprendiz ya está matriculado
            $aprendiz_denegado = array(
                'cedula' => $cedulaPaciente,
                'nombre' => $nombreAprendiz,
                'codigoFicha' => $numeroFicha,
                'estado' => 'Preinscrito',
                'nombrePrograma' => $nombrePrograma,
                'descripcion' => 'Este aprendiz ya está matriculado',
                'status' => false
            );
            $arregloDatos['updateDenegado'][] = $aprendiz_denegado;
            return $aprendiz_denegado;
        }
    } else {
        // Aprendiz no existe en la base de datos
        $aprendiz_denegado = array(
            'cedula' => $cedulaPaciente,
            'nombre' => $nombreAprendiz,
            'codigoFicha' => $numeroFicha,
            'estado' => 'Denegado',
            'nombrePrograma' => $nombrePrograma,
            'descripcion' => 'Este aprendiz no ha pasado por el primer formato',
            'status' => false
        );
        $arregloDatos['updateDenegado'][] = $aprendiz_denegado;
        return $aprendiz_denegado;
    }
}

?>
