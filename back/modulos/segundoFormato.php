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
function importarDatos($archivoExcel) {
    global $arregloActualizados; // Accede al arreglo global

    $documento = IOFactory::load($archivoExcel); // Carga el archivo Excel
    $hojaExcel = $documento->getActiveSheet(); // Selecciona la hoja activa
    $filasDeHojaExcel = $hojaExcel->getHighestDataRow(); // Obtiene el número de filas

    // Verifica el formato del archivo
    if ($hojaExcel->getCell('A3') != "" && $hojaExcel->getCell('A4') != "" && $hojaExcel->getCell('A6') != "" && $hojaExcel->getCell('B6') != "" && $hojaExcel->getCell('C6') != "" && $hojaExcel->getCell('B3') != "" && $hojaExcel->getCell('B4') != "") {
        $codigoFicha = $hojaExcel->getCell('B3');
        $programaFormacion = $hojaExcel->getCell('B4');
        $formatoValido = false;

        // Verifica el formato de preinscritos
        for ($fila = 7; $fila <= $filasDeHojaExcel; $fila++) {
            $estado = trim($hojaExcel->getCell('C' . $fila));
            if ($estado == "Preinscrito") {
                $formatoValido = true;
                break;
            }
        }

        if ($formatoValido) {
            // Procesa cada fila
            for ($fila = 7; $fila <= $filasDeHojaExcel; $fila++) {
                $cedula = trim($hojaExcel->getCell('A' . $fila));
                $nombre = trim($hojaExcel->getCell('B' . $fila));
                $estado = trim($hojaExcel->getCell('C' . $fila));

                if ($cedula != "" && $codigoFicha != "" && $nombre != "" && $estado != "") {
                    $cedulaEnLimpio = explode('-', $cedula)[1];
                    $verificacion = verificandoCursoAnoVigente($cedulaEnLimpio, $programaFormacion, $estado, $codigoFicha, $nombre);

                    if ($verificacion['status']) {
                        $arregloActualizados['updateExito'][] = $verificacion;
                    } else {
                        $arregloActualizados['updateDenegado'][] = $verificacion;
                    }
                }
            }
        } else {
            // Error en el formato
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

// Función para actualizar los datos
function actualizarDatos($numeroFicha, $cedulaPaciente, $nombrePrograma, $nombreAprendiz) {
    $arregloDatos = array();
    $mysql = new MYSQL();
    
    // Verifica si el aprendiz existe
    $consultaSiExiste = $mysql->efectuarConsulta("SELECT * FROM inscripcionaprendiz1 WHERE cedula = ? AND numeroFicha = ?", [$cedulaPaciente, $numeroFicha]);

    if (mysqli_num_rows($consultaSiExiste) > 0) {
        // Verifica si ya está preinscrito
        $consulta = $mysql->efectuarConsulta("SELECT * FROM inscripcionaprendiz1 WHERE cedula = ? AND numeroFicha = ? AND estado = 'Preinscrito'", [$cedulaPaciente, $numeroFicha]);

        if (mysqli_num_rows($consulta) == 0) {
            // Actualiza el aprendiz
            $mysql->efectuarConsulta("UPDATE inscripcionaprendiz1 SET nombreCompleto = ?, nombrePrograma = ?, estado = 'Preinscrito' WHERE cedula = ? AND numeroFicha = ?", [$nombreAprendiz, $nombrePrograma, $cedulaPaciente, $numeroFicha]);
            $numFilasAfectadas = $mysql->filasAfectadas();
            $mysql->desconectar();

            if ($numFilasAfectadas > 0) {
                $aprendiz_actualizadoExito = array(
                    'cedula' => $cedulaPaciente,
                    'nombre' => $nombreAprendiz,
                    'codigoFicha' => $numeroFicha,
                    'estado' => 'Preinscrito',
                    'nombrePrograma' => $nombrePrograma,
                    'descripcion' => 'Actualizado con éxito',
                    'status' => true,
                    'descripcionCursos' => null,
                    'cursoRepetido' => null
                );
                $arregloDatos['updateExito'][] = $aprendiz_actualizadoExito;
                return $aprendiz_actualizadoExito;
            }
        } else {
            $aprendiz_denegado = array(
                'cedula' => $cedulaPaciente,
                'nombre' => $nombreAprendiz,
                'codigoFicha' => $numeroFicha,
                'estado' => 'Preinscrito',
                'nombrePrograma' => $nombrePrograma,
                'descripcion' => 'Este aprendiz ya está preinscrito',
                'status' => false,
                'descripcionCursos' => null,
                'cursoRepetido' => null
            );
            $arregloDatos['updateDenegado'][] = $aprendiz_denegado;
            return $aprendiz_denegado;
        }
    } else {
        $aprendiz_denegado = array(
            'cedula' => $cedulaPaciente,
            'nombre' => $nombreAprendiz,
            'codigoFicha' => $numeroFicha,
            'estado' => 'Null',
            'nombrePrograma' => $nombrePrograma,
            'descripcion' => 'Este aprendiz no ha pasado por el primer formato',
            'status' => false,
            'descripcionCursos' => null,
            'cursoRepetido' => null
        );
        $arregloDatos['updateDenegado'][] = $aprendiz_denegado;
        return $aprendiz_denegado;
    }
}

// Función para verificar si el aprendiz está en otro curso en el año vigente
function verificandoCursoAnoVigente($cedulaAprendiz, $nombreCurso, $estadoCurso, $fichaAprendi, $nombreAprendiz) {
    $sql = new MYSQL();
    $programa = trim($nombreCurso);
    $ano_actual = date('Y');

    // Verifica si ya está matriculado en el mismo curso
    $consultaVerificacion = $sql->efectuarConsulta("SELECT * FROM inscripcionaprendiz1 WHERE cedula = ? AND nombrePrograma = ? AND estado = 'Matriculado'", [$cedulaAprendiz, $programa]);
    if (mysqli_num_rows($consultaVerificacion) > 0) {
        actualizarDatosAprendiz($nombreCurso, $cedulaAprendiz, $fichaAprendi);

        $descripcionCursos = array();
        while ($fila = mysqli_fetch_array($consultaVerificacion)) {
            $descripcionCursos[] = array(
                'fichaPrograma' => $fila['numeroFicha'],
                'nombrePrograma' => $fila['nombrePrograma'],
                'fecha' => $fila['fechaMatricula']
            );
        }

        return array(
            'cedula' => $cedulaAprendiz,
            'nombre' => $nombreAprendiz,
            'codigoFicha' => $fichaAprendi,
            'estado' => null,
            'nombrePrograma' => $nombreCurso,
            'descripcion' => 'El aprendiz ya está matriculado en el curso',
            'status' => false,
            'descripcionCursos' => $descripcionCursos,
            'cursoRepetido' => 'true'
        );
    } else {
        return actualizarDatos($fichaAprendi, $cedulaAprendiz, $nombreCurso, $nombreAprendiz);
    }
}

// Función para actualizar los datos del aprendiz
function actualizarDatosAprendiz($nombreCurso, $cedulaAprendiz, $fichaAprendi) {
    $sql = new MYSQL();
    $consultaActualizar = $sql->efectuarConsulta("UPDATE inscripcionaprendiz1 SET estado = 'Matriculado' WHERE cedula = ? AND nombrePrograma = ? AND numeroFicha = ?", [$cedulaAprendiz, $nombreCurso, $fichaAprendi]);
}

?>
