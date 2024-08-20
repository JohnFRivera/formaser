<?php

session_start();
set_time_limit(5000);
$date = date("Y/m/d");
require '../../libreria/vendor/autoload.php';
require_once '../MYSQL.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$mysql = new MYSQL;

$archivo_excel = null; // Inicializar la variable para evitar errores

if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
    $archivo_excel = $_FILES['archivo']['tmp_name'];

    if (file_exists($archivo_excel)) {
        try {
            $typeFile = IOFactory::identify($archivo_excel);
            $reader = IOFactory::createReader($typeFile);
            $spreadsheet = $reader->load($archivo_excel);

            $hojaExcel = $spreadsheet->getActiveSheet();
            $highestRow = $hojaExcel->getHighestDataRow();

            for ($i = 1; $i <= $highestRow; $i++) {
                $codFicha = $hojaExcel->getCell("A$i")->getValue();
                $progFormacion = $hojaExcel->getCell("B$i")->getValue();
                $id = $hojaExcel->getCell("C$i")->getValue();
                $nombre = $hojaExcel->getCell("D$i")->getValue();
                $estado = $hojaExcel->getCell("E$i")->getValue();

                $matriculaExistente = verificarExistencia($mysql, 'matriculado', "identidad = '$id'");

                if ($matriculaExistente) {
                    $mysql->efectuarConsulta("UPDATE matriculado SET identidad = '$id', nombre = '$nombre', ficha = '$codFicha', programa = '$progFormacion', estado = '$estado' WHERE identidad = '$id'");
                    $mysql->efectuarConsulta("DELETE FROM inscripcion WHERE identidad = '$id'");
                } else {
                    $consulta = $mysql->efectuarConsulta("SELECT * FROM inscripcion WHERE identidad = '$id'");
                    if (mysqli_num_rows($consulta) > 0) {
                        $mysql->efectuarConsulta("DELETE FROM inscripcion WHERE identidad = '$id'");
                        $mysql->efectuarConsulta("INSERT INTO matriculado (identidad, nombre, ficha, programa, estado) VALUES ('$id', '$nombre', '$codFicha', '$progFormacion', '$estado')");
                        echo "El registro ha sido movido de `inscripcion` a `matriculado`";
                    } else {
                        echo $reult = 'ERROR: el archivo no ha sido pasado primero por inscripcion';
                       
                    }
                }
            }

            header('Location: http://localhost/formaser/front/admin/matriculados/');
            exit();
        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            echo 'Error al cargar el archivo: ' . $e->getMessage();
        }
    } else {
        echo "El archivo no se ha subido correctamente o ha sido eliminado.";
    }
} else {
    if (isset($_FILES['archivo']['error']) && $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
        echo "Hubo un error en la subida del archivo: " . $_FILES['archivo']['error'];
    } else {
        echo "No se ha subido ningún archivo.";
    }
}

function verificarExistencia($mysql, $tabla, $condiciones) {
    $consulta = $mysql->efectuarConsulta("SELECT COUNT(*) AS count FROM $tabla WHERE $condiciones");
    $row = mysqli_fetch_assoc($consulta);
    return $row['count'] > 0;
}

?>
