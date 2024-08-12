<?php
require "../libreria/vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\IOFactory;

require 'MYSQL.php';

$mysql = new MYSQL();
$arregloYaAgregados = array();

// Verifico si se subió el archivo
if ($_FILES['archivotExcel']['size'] > 0) {
    $archivoExcel_temporal = $_FILES['archivotExcel']['tmp_name'];
    $tipo_archivo = mime_content_type($archivoExcel_temporal);

    // Valido que se haya subido un tipo de archivo Excel 
    if (in_array($tipo_archivo, [
        "application/vnd.ms-excel", 
        "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
    ])) {
        importarDatos($archivoExcel_temporal, $mysql, $arregloYaAgregados);
    } else {
        $arregloYaAgregados['error'][] = [
            'status' => "404",
            'descripcion' => "Sólo se pueden subir archivos de tipo Excel. Tipo de archivo subido:" . $tipo_archivo,
        ];
        echo json_encode($arregloYaAgregados);
    }
}

// Función para importar datos
function importarDatos($archivoExcel, $mysql, &$arregloYaAgregados)
{
    $documento = IOFactory::load($archivoExcel); // Cargo el archivo Excel
    $hojaExcel = $documento->getActiveSheet();
    $filasDeHojaExcel = $hojaExcel->getHighestDataRow();

    // Verificación del formato del archivo
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
