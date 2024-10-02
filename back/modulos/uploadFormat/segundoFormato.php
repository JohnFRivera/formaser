<?php
session_start();
set_time_limit(5000);
require '../../libreria/vendor/autoload.php';
require_once '../MYSQL.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception as ReaderException;

$mysql = new MYSQL;


if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
    
    // Obtén el nombre temporal del archivo subido
    $archivo_excel = $_FILES['archivo']['tmp_name'];
    // Obtén la extensión del archivo
    $extension = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
    print_r($archivo_excel);
    // Verifica que el archivo existe en la ruta temporal
    if (file_exists($archivo_excel)) {
        try {
            // Verifica si el archivo es un tipo de Excel (extensiones .xlsx o .xls)
            if (!in_array($extension, ['xlsx', 'xls'])) {
                $_SESSION['error'] = "Tipo de archivo incorrecto. Por favor, sube un archivo de Excel.";
                header('Location: http://localhost/formaser/front/admin/subir_archivos/inscritos.php');
                exit();
            }

            $typeFile = IOFactory::identify($archivo_excel);
            $reader = IOFactory::createReader($typeFile);
            $spreadsheet = $reader->load($archivo_excel);

            // Procesar el archivo
            $hojaExcel = $spreadsheet->getActiveSheet();
            $highestRow = $hojaExcel->getHighestDataRow();

            for ($i = 2; $i <= $highestRow; $i++) {
                $codFicha = $hojaExcel->getCell("A$i")->getValue();
                $progFormacion = $hojaExcel->getCell("B$i")->getValue();
                $id = $hojaExcel->getCell("C$i")->getValue();
                $nombre = $hojaExcel->getCell("D$i")->getValue();
                $estado = $hojaExcel->getCell("E$i")->getValue();

                $inscritoExistente = verificarExistencia($mysql, 'inscripcion', "identidad = $id");

                if ($inscritoExistente) {
                    $mysql->efectuarConsulta("UPDATE inscripcion SET identidad = '$id', nombre = '$nombre', ficha = $codFicha, programa = '$progFormacion', estado = '$estado' WHERE identidad = $id");
                    $mysql->efectuarConsulta("DELETE FROM pre_inscrito WHERE identidad = $id");
                } else {
                    // Consulta para verificar si existe un registro en la tabla `pre_inscrito` con la misma identificación 
                    $consulta = $mysql->efectuarConsulta("SELECT * FROM pre_inscrito WHERE identidad = $id");
                    if (mysqli_num_rows($consulta) > 0) {
                        // Si existe coincidencia, eliminar el registro de `pre_inscrito`
                        $mysql->efectuarConsulta("DELETE FROM pre_inscrito WHERE identidad = $id");
                        // Ahora, insertar el registro en la tabla `inscripcion`
                        $mysql->efectuarConsulta("INSERT INTO inscripcion (identidad, nombre, ficha, programa, estado) VALUES ($id, '$nombre', $codFicha, '$progFormacion', '$estado')");
                        $_SESSION['success'] = "El registro ha sido movido de `pre_inscrito` a `inscripcion`";
                    } else {
                        $_SESSION['error'] = "ERROR: el archivo no ha sido pasado primero por pre_inscripcion.";
                        header('Location: http://localhost/formaser/front/admin/subir_archivos/inscritos.php');
                        exit();
                    }
                }
            }

            $_SESSION['success'] = "El archivo fue cargado y procesado exitosamente.";
        } catch (ReaderException $e) {
            $_SESSION['error'] = 'Error al cargar el archivo: ' . $e->getMessage();
            header('Location: http://localhost/formaser/front/admin/subir_archivos/inscritos.php'); 
            exit();
            
        } catch (Exception $e) {
            $_SESSION['error'] = "Ocurrió un error: se necesita el formato inscritos.";
            header('Location: http://localhost/formaser/front/admin/subir_archivos/inscritos.php');
            exit(); 
        }
    } else {
        $_SESSION['error'] = "El archivo no se ha subido correctamente.";
        header('Location: http://localhost/formaser/front/admin/subir_archivos/inscritos.php'); 
        exit();
    }
} else {
    $_SESSION['error'] = "No se ha subido ningún archivo o hubo un error en la subida.";
    header('Location: http://localhost/formaser/front/admin/subir_archivos/inscritos.php'); 
    exit();
}

// Redirigir a la página de inscripciones
header('Location: http://localhost/formaser/front/admin/inscripciones/'); 
exit();

function verificarExistencia($mysql, $tabla, $condiciones) {
    $consulta = $mysql->efectuarConsulta("SELECT COUNT(*) AS count FROM $tabla WHERE $condiciones");
    $row = mysqli_fetch_assoc($consulta);
    return $row['count'] > 0;
}
