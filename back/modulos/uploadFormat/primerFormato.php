<?php

session_start();
set_time_limit(5000);
$date = date("Y/m/d");
require '../../libreria/vendor/autoload.php';
require_once '../MYSQL.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$mysql = new MYSQL;

$archivo_excel = $_FILES['archivo']['tmp_name'];

$typeFile = IOFactory::identify($archivo_excel);
$reader = IOFactory::createReader($typeFile);
$spreadsheet = $reader->load($archivo_excel);

$hojaExcel = $spreadsheet->getActiveSheet();
$highestRow = $hojaExcel->getHighestDataRow(); // Número de la última fila con datos

for ($i = 2; $i <= $highestRow; $i++) { 
    $tipoId = "CC";
    $id = $hojaExcel->getCell("B$i")->getValue();
    $poblacion = $hojaExcel->getCell("D$i")->getValue();
    if (empty(trim($poblacion))) {
        $poblacion = 'sin registrar';
    }
    $codFicha = $hojaExcel->getCell("C$i")->getValue();
    $empresa = $hojaExcel->getCell("F$i")->getValue();

    // Comprobación de población vacía
    if (empty(trim($empresa))) {
        $empresa = 'sin registrar';
    }
    
    

    

    // Verificar existencia del registro en la base de datos
    $registroExistente = verificarExistencia($mysql, 'pre_inscrito', "identidad = $id");

    if (!$registroExistente) {
        $mysql->efectuarConsulta("INSERT INTO pre_inscrito (tipo, identidad, poblacion, ficha, empresa) VALUES ('$tipoId', $id, '$poblacion', $codFicha, '$empresa')");
    } else {
        $mysql->efectuarConsulta("UPDATE pre_inscrito SET poblacion = '$poblacion', empresa = '$empresa' WHERE identidad = $id");
    }
}

// Redirigir después de procesar todo el archivo
header('Location: http://localhost/formaser/front/admin/pre-inscripciones/');
exit();

function verificarExistencia($mysql, $tabla, $condiciones) {
    $consulta = $mysql->efectuarConsulta("SELECT COUNT(*) AS count FROM $tabla WHERE $condiciones");
    $row = mysqli_fetch_assoc($consulta);
    return $row['count'] > 0;
}
