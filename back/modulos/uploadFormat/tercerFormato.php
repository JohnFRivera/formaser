<?php

session_start();
set_time_limit(5000);
require '../../libreria/vendor/autoload.php';
require_once '../MYSQL.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$mysql = new MYSQL;

// Inicializar las variables para evitar errores
$archivo_excel = null;
$_SESSION['error'] = ''; 
$_SESSION['success'] = '';

if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
    $archivo_excel = $_FILES['archivo']['tmp_name'];
    $fileType = $_FILES['archivo']['type']; // Obtener el tipo MIME del archivo

    // Verificar que el archivo sea de tipo Excel (MIME types)
    $allowedTypes = ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
    if (!in_array($fileType, $allowedTypes)) {
        $_SESSION['error'] = 'El archivo debe ser un archivo Excel (.xls, .xlsx).';
        header('Location: http://localhost/formaser/front/admin/subir_archivos/matriculados.php');
        exit();
    }

    // Verifica que el archivo exista en la ruta temporal
    if (file_exists($archivo_excel)) {
        try {
            // Identifica el tipo de archivo y crea el lector adecuado
            $typeFile = IOFactory::identify($archivo_excel);
            $reader = IOFactory::createReader($typeFile);
            $spreadsheet = $reader->load($archivo_excel);

            // Obtener la hoja activa y el número de filas
            $hojaExcel = $spreadsheet->getActiveSheet();
            $highestRow = $hojaExcel->getHighestDataRow();

            // Procesar cada fila
            for ($i = 2; $i <= $highestRow; $i++) { // Asumiendo que la primera fila es de encabezados
                $codFicha = $hojaExcel->getCell("A$i")->getValue();
                $progFormacion = $hojaExcel->getCell("B$i")->getValue();
                $id = $hojaExcel->getCell("C$i")->getValue();
                $nombre = $hojaExcel->getCell("D$i")->getValue();
                $estado = $hojaExcel->getCell("E$i")->getValue();

                // Validar que todas las celdas requeridas tengan valores
                if (empty($codFicha) || empty($progFormacion) || empty($id) || empty($nombre) || empty($estado)) {
                    $_SESSION['error'] = "Error: se necesita el formato matricula.";
                    header('Location: http://localhost/formaser/front/admin/subir_archivos/matriculados.php');
                    exit();
                }

                // Verificar si ya existe el estudiante en 'matriculado'
                $matriculaExistente = verificarExistencia($mysql, 'matriculado', "identidad = '$id'");

                if ($matriculaExistente) {
                    // Actualizar los datos del matriculado y eliminar de 'inscripcion'
                    $mysql->efectuarConsulta("UPDATE matriculado SET identidad = '$id', nombre = '$nombre', ficha = '$codFicha', programa = '$progFormacion', estado = '$estado' WHERE identidad = '$id'");
                    $mysql->efectuarConsulta("DELETE FROM inscripcion WHERE identidad = '$id'");
                } else {
                    // Si no existe, verificar si está en 'inscripcion'
                    $consulta = $mysql->efectuarConsulta("SELECT * FROM inscripcion WHERE identidad = '$id'");
                    if (mysqli_num_rows($consulta) > 0) {
                        // Mover el registro a 'matriculado' y eliminar de 'inscripcion'
                        $mysql->efectuarConsulta("DELETE FROM inscripcion WHERE identidad = '$id'");
                        $mysql->efectuarConsulta("INSERT INTO matriculado (identidad, nombre, ficha, programa, estado) VALUES ('$id', '$nombre', '$codFicha', '$progFormacion', '$estado')");
                        $_SESSION['success'] = "El registro ha sido movido de `inscripcion` a `matriculado`";
                    } else {
                        $_SESSION['error'] = "ERROR: el archivo no ha sido pasado primero por inscripcion para la identidad $id.";
                        header('Location: http://localhost/formaser/front/admin/subir_archivos/matriculados.php');
                        exit();
                    }
                }
            }

            $_SESSION['success'] = "El archivo fue cargado y procesado exitosamente.";
            header('Location: http://localhost/formaser/front/admin/matriculados/');
            exit();
        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            $_SESSION['error'] = 'Error al cargar el archivo: ' . $e->getMessage();
            header('Location: http://localhost/formaser/front/admin/subir_archivos/matriculados.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "El archivo no se ha subido correctamente o ha sido eliminado.";
        header('Location: http://localhost/formaser/front/admin/subir_archivos/matriculados.php');
        exit();
    }
} else {
    if (isset($_FILES['archivo']['error']) && $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['error'] = "Hubo un error en la subida del archivo: " . $_FILES['archivo']['error'];
    } else {
        $_SESSION['error'] = "No se ha subido ningún archivo.";
    }
    header('Location: http://localhost/formaser/front/admin/matriculados/');
    exit();
}

function verificarExistencia($mysql, $tabla, $condiciones) {
    $consulta = $mysql->efectuarConsulta("SELECT COUNT(*) AS count FROM $tabla WHERE $condiciones");
    $row = mysqli_fetch_assoc($consulta);
    return $row['count'] > 0;
}
?>
