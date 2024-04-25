<?php
require "../libreria/vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\IOFactory;

// creo el arreglo donde va ir los datos
$arregloYaAgregados = array();


require 'MYSQL.php';

$mysql = new MYSQL();
// Verifico si se subió el archivo
if ($_FILES['archivotExcel']['size'] > 0) {
    $archivoExcel_temporal = $_FILES['archivotExcel']['tmp_name'];
    
     $tipo_archivo = $_FILES['archivotExcel']['type'];

    // Valido que se haya subido un tipo de archivo Excel 
    if ($tipo_archivo == "application/vnd.ms-excel" || $tipo_archivo == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
        importarDatos($archivoExcel_temporal);
    } else {
// aca voy a guardar el error del tipo de archivo       
   $arregloError = array(
    'status' =>"404",
    'descripcion'=>"Sólo se pueden subir archivos de tipo Excel. Tipo de archivo subido: " . $tipo_archivo,
    
);
// aca lo agrego al array principal
$arregloYaAgregados['error'][] = $arregloError;

// Convertir el array de clientes a JSON
$json_clientes = json_encode($arregloYaAgregados);

// envio el JSON
    echo $json_clientes;
    }
}




// ---------------------------------------------------------------------------------











// Función para importar datos
function importarDatos($archivoExcel)
{

    $documento = IOFactory::load($archivoExcel); // Cargo el archivo Excel
    
    // Selecciono la hoja 1 del archivo Excel
    $hojaExcel = $documento->getActiveSheet();

    // Obtengo la cantidad de filas o registros que tiene esa hoja Excel
    $filasDeHojaExcel = $hojaExcel->getHighestDataRow();
   // echo "Total de filas: " . $filasDeHojaExcel . "<br>";


// voy a verificar que sea el mismo formato excel por si depronto sube uno que no era
if($hojaExcel->getCell('A2') != "" && $hojaExcel->getCell('B2') != "" && $hojaExcel->getCell('C2') != "" && $hojaExcel->getCell('D2') != "" && $hojaExcel->getCell('E2') != "" && $hojaExcel->getCell('F2') == "" && $hojaExcel->getCell('G2') != ""  && $hojaExcel->getCell('H2') == "")
{
 // Recorro las filas y obtengo el valor de la celda en la columna 3
 for ($fila = 3; $fila <= $filasDeHojaExcel; $fila++) {


  // voy a meter los datos en variables 
  $cedula = $hojaExcel->getCell('C' . $fila); // Acceder a la celda en la columna especificada y la fila actual
  $tipoDocumento =$hojaExcel->getCell('B'.$fila);
  $codigoFicha = $hojaExcel->getCell('D'.$fila);
  $tipoPoblacion =$hojaExcel->getCell('E'.$fila);
  $codigoEmpresa = $hojaExcel->getCell('G'.$fila);
  if($codigoEmpresa == null || $codigoEmpresa == "")
  {
    $codigoEmpresa= 0;
  }

if($cedula != "" && $codigoFicha != "" && $tipoDocumento != "" && $tipoPoblacion != "")
{
    $mysql = new MYSQL();
  
     $consultaVerificacion = $mysql->efectuarConsulta("SELECT * FROM bd_formaser.inscripcionaprendiz1 WHERE cedula =$cedula and numeroFicha =$codigoFicha;");
     $selecionados= mysqli_num_rows($consultaVerificacion);
     $mysql->desconectar();
     // aca voy hacer una desicion que si hay mas de una fila es porque ya lo habia agregado
     if($selecionados == 0)
     {
if(strtoupper($tipoDocumento) == "CC" || strtoupper($tipoDocumento) == "TI" || strtoupper($tipoDocumento) == "CE" || strtoupper($tipoDocumento) == "PEP" || strtoupper($tipoDocumento) == "PPT")
{
    $mysql = new MYSQL();

   $tipoDocumentoMayusca =strtoupper($tipoDocumento);
   $tipoPoblacionMayuscula =strtoupper($tipoPoblacion);
   $consultaInsertacion = $mysql->efectuarConsulta("INSERT INTO bd_formaser.inscripcionaprendiz1(tipoCedula,cedula,numeroFicha,tipoPoblacion,codigoEmpresa) VALUES('$tipoDocumentoMayusca',$cedula,$codigoFicha,'$tipoPoblacionMayuscula',$codigoEmpresa) ;");

   if($consultaInsertacion)
   {
    // aca voy a guardar en un arreglo los que se insertaron con exito

    $aprendiz_registradoConExito = array(
        'cedula' =>"$cedula",
        'tipoDocumento'=>"$tipoDocumento",
        'numeroFicha' => "$codigoFicha",
        'codigoEmpresa' => "$codigoEmpresa",
        'razones'=> "Agregado con Exito"
    );
    // aca lo agrego al array principal
    $arregloYaAgregados['registrado'][] = $aprendiz_registradoConExito;
     
   }



}
else{
    //  aca voy a guardar en un arreglo los que no fueron aceptados porque no cumple el tipo de Documento de identidad

// aca voy a meterl los datos en un arreglo los que no fueron aceptados por el tipo de documento
$aprendiz_no_Aceptados = array(
    'cedula' =>"$cedula",
    'tipoDocumento'=>"$tipoDocumento",
    'numeroFicha' => "$codigoFicha",
    'codigoEmpresa' => "$codigoEmpresa",
    'razones'=> "el documento es "."$tipoDocumento"." No cumple con el tipo de documento "
);
$arregloYaAgregados['no_aceptados'][] = $aprendiz_no_Aceptados;



}
    }
    else{
        // aca voy hacer que se guarde en un arreglo los que no fueron agregados por que ya estan en la base de datos

$aprendiz_no_registrado = array(
    'cedula' =>"$cedula",
    'tipoDocumento'=>"$tipoDocumento",
    'numeroFicha' => "$codigoFicha",
    'codigoEmpresa' => "$codigoEmpresa",
    'razones'=> "Es segunda vez que pasa por el primer formato y ya esta en la Base de Datos"
);
// Agregar el cliente no registrado al array de arreglo ya agregados
$arregloYaAgregados['no_aceptados'][] = $aprendiz_no_registrado;



    }
}
 
}

}
else
{
   // echo "este formato no es ";


   $arregloError = array(
    'status' =>"404",
    'descripcion'=>"formato Equivocado ",
    
);
// aca lo agrego al array principal
$arregloYaAgregados['error'][] = $arregloError;





}

// ----------------------------------------------------------


// Convertir el array de clientes a JSON
$json_clientes = json_encode($arregloYaAgregados);

// envio el JSON
    echo $json_clientes;



  
}





?>




