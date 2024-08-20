<?php

session_start();
set_time_limit(5000);
$date = date("Y/m/d");
require '../../libreria/vendor/autoload.php';
require_once '../MYSQL.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$mysql = new MYSQL;

if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
    // Obtén el nombre temporal del archivo subido
    $archivo_excel = $_FILES['archivo']['tmp_name'];

    // Verifica que el archivo existe en la ruta temporal
    if (file_exists($archivo_excel)) {
        try {
            echo "El archivo fue cargado y procesado exitosamente.";
        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            echo 'Error al cargar el archivo: ' . $e->getMessage();
        }
    } else {
        echo "El archivo no se ha subido correctamente.";
    }
} else {
    echo "No se ha subido ningún archivo o hubo un error en la subida.";
}


$typeFile = IOFactory::identify($archivo_excel) ;
$reader = IOFactory::createReader($typeFile);
$spreadsheet = $reader->load($archivo_excel);



$hojaExcel =$spreadsheet->getActiveSheet();
$highestRow = $hojaExcel->getHighestDataRow();

for ($i=2; $i < $highestRow; $i++) { 
   $codFicha = $hojaExcel->getCell("A$i")->getValue();
   $progFormacion = $hojaExcel->getCell("B$i")->getValue();
   $id = $hojaExcel->getCell("C$i")->getValue();
   $nombre = $hojaExcel->getCell("D$i")->getValue();
   $estado = $hojaExcel->getCell("E$i")->getValue();
   
    
    $inscritoExistente = verificarExistencia($mysql,'inscripcion',"identidad = $id");
    
    if ($inscritoExistente) {
        
        $mysql->efectuarConsulta("UPDATE inscripcion SET identidad = '$id', nombre = '$nombre', ficha = $codFicha, programa = '$progFormacion', estado = '$estado' WHERE identidad = $id");
        $mysql->efectuarConsulta("DELETE FROM pre_inscrito WHERE identidad = $id");

    }else{
        // Consulta para verificar si existe un registro en la tabla `pre_inscrito` con la misma identificación 
        $consulta = $mysql->efectuarConsulta("SELECT * FROM pre_inscrito WHERE identidad = $id");
        if (mysqli_num_rows($consulta) > 0) {
            
            // Si existe coincidencia, eliminar el registro de `pre_inscrito`
            $mysql->efectuarConsulta("DELETE FROM pre_inscrito WHERE identidad = $id");
            // Ahora, insertar el registro en la tabla `inscripcion`
            $mysql->efectuarConsulta("INSERT INTO inscripcion (identidad, nombre, ficha, programa, estado) VALUES ($id,'$nombre', $codFicha, '$progFormacion', '$estado')");
            echo "El registro ha sido movido de `pre_inscrito` a `inscripcion`";
        }else {
           $reult = 'ERROR: el archivo no a sido pasado primero por pre_inscripcion';
        }

    }
   
}
header('Location: http://localhost/formaser/front/admin/inscripciones/');
exit();



function verificarExistencia($mysql, $tabla, $condiciones) {
    $consulta = $mysql->efectuarConsulta("SELECT COUNT(*) AS count FROM $tabla WHERE $condiciones");
    $row = mysqli_fetch_assoc($consulta);
    return $row['count'] > 0;
}
