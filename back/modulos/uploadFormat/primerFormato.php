<?php
session_start();
set_time_limit(5000);
require '../../libreria/vendor/autoload.php';
require_once '../MYSQL.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception as ReaderException;

$mysql = new MYSQL;

if ($_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
    $_SESSION['error'] = "Error al subir el archivo. Inténtalo de nuevo.";
    header('Location: http://localhost/formaser/front/admin/subir_archivos/pre-inscritos.php');
    exit();
}

$archivo_excel = $_FILES['archivo']['tmp_name'];

try {
    $typeFile = IOFactory::identify($archivo_excel);
    // Verifica si el archivo es un tipo de Excel
    if (!in_array($typeFile, ['Xlsx', 'Xls'])) {
        throw new Exception("Tipo de archivo incorrecto.");
    }

    $reader = IOFactory::createReader($typeFile);
    $spreadsheet = $reader->load($archivo_excel);
} catch (ReaderException $e) {
    $_SESSION['error'] = "No se puede identificar un lector para este archivo. Asegúrate de que sea un archivo de Excel.";
    header('Location: http://localhost/formaser/front/admin/subir_archivos/pre-inscritos.php');
    exit();
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage(); // Captura el mensaje de tipo de archivo incorrecto
    header('Location: http://localhost/formaser/front/admin/subir_archivos/pre-inscritos.php');
    exit();
}

$hojaExcel = $spreadsheet->getActiveSheet();
$highestRow = $hojaExcel->getHighestDataRow(); // Número de la última fila con datos

$validFormat = true; // Variable para controlar el formato del archivo

for ($i = 2; $i <= $highestRow; $i++) {
    $tipoId = "CC";
    $id = $hojaExcel->getCell("B$i")->getValue();
    $codFicha = $hojaExcel->getCell("C$i")->getValue();
    $poblacion = $hojaExcel->getCell("D$i")->getValue();
    $empresa = $hojaExcel->getCell("F$i")->getValue();

    // Validar si las celdas requeridas están vacías
    if (empty(trim($id)) || empty(trim($codFicha)) || empty(trim($poblacion))) {
        $validFormat = false; // Cambia a false si alguna celda está vacía
        break; // Salir del bucle si se encuentra un formato incorrecto
    }

    // Comprobación de población vacía
    if (empty(trim($poblacion))) {
        $poblacion = 'sin registrar';
    }

    // Comprobación de empresa vacía
    if (empty(trim($empresa))) {
        $empresa = 'sin registrar';
    }

    // Verificar existencia del registro en la base de datos
    $registroExistente = verificarExistencia($mysql, 'pre_inscrito', "identidad = $id");

    if (!$registroExistente) {
        $mysql->efectuarConsulta("INSERT INTO pre_inscrito (tipo, identidad, poblacion, ficha, empresa) VALUES ('$tipoId', $id, '$poblacion', '$codFicha', '$empresa')");
    } else {
        $mysql->efectuarConsulta("UPDATE pre_inscrito SET poblacion = '$poblacion', empresa = '$empresa' WHERE identidad = $id");
    }
}

// Si el formato es incorrecto, mostrar mensaje de error
if (!$validFormat) {
    $_SESSION['error'] = "Se necesita el formato pre_inscrito.";
    header('Location: http://localhost/formaser/front/admin/subir_archivos/pre-inscritos.php');
    exit();
}

// Redirigir después de procesar todo el archivo
header('Location: http://localhost/formaser/front/admin/pre-inscripciones/');
exit();

function verificarExistencia($mysql, $tabla, $condiciones) {
    $consulta = $mysql->efectuarConsulta("SELECT COUNT(*) AS count FROM $tabla WHERE $condiciones");
    $row = mysqli_fetch_assoc($consulta);
    return $row['count'] > 0;
}
