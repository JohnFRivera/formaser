<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../libreria/vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\IOFactory;
require 'MYSQL.php';

$mysql = new MYSQL();
$arregloYaAgregados = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    
    if (isset($_FILES['archivo'])) {
        echo "hola";
        if ($_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
            $archivoExcel_temporal = $_FILES['archivo']['tmp_name'];
            $tipo_archivo = mime_content_type($archivoExcel_temporal);

            if (in_array($tipo_archivo, [
                "application/vnd.ms-excel", 
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
            ])) {
                importarDatos($archivoExcel_temporal, $mysql, $arregloYaAgregados);
            } else {
                $arregloYaAgregados['error'][] = [
                    'status' => "404",
                    'descripcion' => "Sólo se pueden subir archivos de tipo Excel. Tipo de archivo subido: " . $tipo_archivo,
                ];
                echo json_encode($arregloYaAgregados);
            }
        } else {
            $errorMsg = "Error desconocido";
            switch ($_FILES['archivo']['error']) {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    $errorMsg = "El archivo es demasiado grande.";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $errorMsg = "El archivo se cargó parcialmente.";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $errorMsg = "No se subio ningun archivo.";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $errorMsg = "Falta el directorio temporal.";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $errorMsg = "Error al escribir el archivo en el disco.";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $errorMsg = "Se detuvo la carga del archivo por una extensión.";
                    break;
            }
            $arregloYaAgregados['error'][] = [
                'status' => "404",
                'descripcion' => "Error en la carga del archivo. Código de error: " . $_FILES['archivo']['error'] . " - " . $errorMsg,
            ];
            echo json_encode($arregloYaAgregados);
        }
    } else {
        $arregloYaAgregados['error'][] = [
            'status' => "404",
            'descripcion' => "No se subió ningún archivo.",
        ];
        echo json_encode($arregloYaAgregados);
    }
} else {
    $arregloYaAgregados['error'][] = [
        'status' => "405",
        'descripcion' => "Método de solicitud no permitido.",
    ];
    echo json_encode($arregloYaAgregados);
}

// Función para importar datos
function importarDatos($archivoExcel, $mysql, &$arregloYaAgregados)
{
    try {
        $documento = IOFactory::load($archivoExcel); 
        $hojaExcel = $documento->getActiveSheet();
        $filasDeHojaExcel = $hojaExcel->getHighestDataRow();
        
        if (validarFormato($hojaExcel)) { 
            for ($fila = 3; $fila <= $filasDeHojaExcel; $fila++) {
                $cedula = $hojaExcel->getCell('C' . $fila)->getValue();
                $tipoDocumento = $hojaExcel->getCell('B' . $fila)->getValue();
                $codigoFicha = $hojaExcel->getCell('D' . $fila)->getValue();
                $tipoPoblacion = $hojaExcel->getCell('E' . $fila)->getValue();
                $codigoEmpresa = $hojaExcel->getCell('G' . $fila)->getValue() ?: 0;

                if ($cedula && $codigoFicha && $tipoDocumento && $tipoPoblacion) {
                    procesarRegistro($mysql, $arregloYaAgregados, $cedula, $tipoDocumento, $codigoFicha, $tipoPoblacion, $codigoEmpresa);
                }
            }
        } else {
            $arregloYaAgregados['error'][] = [
                'status' => "404",
                'descripcion' => "Formato Equivocado",
            ];
        }
    } catch (Exception $e) {
        $arregloYaAgregados['error'][] = [
            'status' => "500",
            'descripcion' => "Error al procesar el archivo: " . $e->getMessage(),
        ];
    }

    echo json_encode($arregloYaAgregados);
}

// Función para validar el formato del archivo
function validarFormato($hojaExcel)
{
    return $hojaExcel->getCell('A2')->getValue() !== "" && 
           $hojaExcel->getCell('B2')->getValue() !== "" &&
           $hojaExcel->getCell('C2')->getValue() !== "" &&
           $hojaExcel->getCell('D2')->getValue() !== "" &&
           $hojaExcel->getCell('E2')->getValue() !== "" &&
           $hojaExcel->getCell('F2')->getValue() === "" &&
           $hojaExcel->getCell('G2')->getValue() !== "" &&
           $hojaExcel->getCell('H2')->getValue() === "";
}

// Función para procesar cada registro
function procesarRegistro($mysql, &$arregloYaAgregados, $cedula, $tipoDocumento, $codigoFicha, $tipoPoblacion, $codigoEmpresa)
{
    $stmt = $mysql->efectuarConsulta("SELECT * FROM bd_formaser.inscripcionaprendiz1 WHERE cedula = ? AND numeroFicha = ?");
    $stmt->bind_param('ii', $cedula, $codigoFicha);
    $stmt->execute();
    $stmt->store_result();
    $selecionados = $stmt->num_rows;
    $stmt->close();

    if ($selecionados == 0) {
        if (in_array(strtoupper($tipoDocumento), ["CC", "TI", "CE", "PEP", "PPT"])) {
            $stmt = $mysql->efectuarConsulta("INSERT INTO bd_formaser.inscripcionaprendiz1(tipoCedula, cedula, numeroFicha, tipoPoblacion, codigoEmpresa) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('siiis', strtoupper($tipoDocumento), $cedula, $codigoFicha, strtoupper($tipoPoblacion), $codigoEmpresa);
            if ($stmt->execute()) {
                $arregloYaAgregados['registrado'][] = [
                    'cedula' => $cedula,
                    'tipoDocumento' => $tipoDocumento,
                    'numeroFicha' => $codigoFicha,
                    'codigoEmpresa' => $codigoEmpresa,
                    'razones' => "Agregado con Éxito",
                ];
            }
            $stmt->close();
        } else {
            $arregloYaAgregados['no_aceptados'][] = [
                'cedula' => $cedula,
                'tipoDocumento' => $tipoDocumento,
                'numeroFicha' => $codigoFicha,
                'codigoEmpresa' => $codigoEmpresa,
                'razones' => "El documento es $tipoDocumento, no cumple con el tipo de documento permitido.",
            ];
        }
    } else {
        $arregloYaAgregados['no_aceptados'][] = [
            'cedula' => $cedula,
            'tipoDocumento' => $tipoDocumento,
            'numeroFicha' => $codigoFicha,
            'codigoEmpresa' => $codigoEmpresa,
            'razones' => "Ya está en la Base de Datos.",
        ];
    }
}
?>
