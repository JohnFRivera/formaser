<?php

require "../libreria/vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\IOFactory;

// creo el arreglo donde va ir los datos
$arregloActualizados = array();


require 'MYSQL.php';


// Verifico si se subió el archivo
if ($_FILES['archivotExcel']['size'] > 0) {


    $archivoExcel_temporal = $_FILES['archivotExcel']['tmp_name'];
    
    $tipo_archivo = $_FILES['archivotExcel']['type'];

   // Valido que se haya subido un tipo de archivo Excel 
   if ($tipo_archivo == "application/vnd.ms-excel" || $tipo_archivo == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
       importarDatos($archivoExcel_temporal);
   }
   else {
    // aca voy a guardar el error del tipo de archivo       
       $arregloError = array(
        'status' =>"404",
        'descripcion'=>"Sólo se pueden subir archivos de tipo Excel. Tipo de archivo subido: " . $tipo_archivo,
        
    );
    // aca lo agrego al array principal
    $arregloActualizados['error'][] = $arregloError;
    
    // Convertir el array de clientes a JSON
    $json_clientes = json_encode($arregloActualizados);
    
    // envio el JSON
        echo $json_clientes;
        }
    
}

// -------------------


// Función para importar datos
function importarDatos($archivoExcel)
{

    $documento = IOFactory::load($archivoExcel); // Cargo el archivo Excel
    
    // Selecciono la hoja 1 del archivo Excel
    $hojaExcel = $documento->getActiveSheet();

    // Obtengo la cantidad de filas o registros que tiene esa hoja Excel
    $filasDeHojaExcel = $hojaExcel->getHighestDataRow();
   // echo "Total de filas: " . $filasDeHojaExcel . "<br>";
   $formatoValido = false;
   for ($fila = 7; $fila <= $filasDeHojaExcel; $fila++) {
    $estado = $hojaExcel->getCell('C'.$fila);
    if($estado == "Matriculado ")
    {
        $formatoValido = true;
    }

   }


// voy a verificar que sea el mismo formato excel por si depronto sube uno que no era
if($hojaExcel->getCell('A3') != "" && $hojaExcel->getCell('A4') != "" && $hojaExcel->getCell('A6') != "" && $hojaExcel->getCell('B6') != "" && $hojaExcel->getCell('C6') != "" && $hojaExcel->getCell('B3') != "" && $hojaExcel->getCell('B4') != "")
{

    $codigoFicha = $hojaExcel->getCell('B3');
    $prgramaFormacion =$hojaExcel->getCell('B4');


 // Recorro las filas y obtengo el valor de la celda en la columna 3
 for ($fila = 7; $fila <= $filasDeHojaExcel; $fila++) {


      // voy a meter los datos en variables 
  $cedula = $hojaExcel->getCell('A' . $fila); // Acceder a la celda en la columna especificada y la fila actual
  $nombre = $hojaExcel->getCell('B'.$fila);
  $estado = $hojaExcel->getCell('C'.$fila);



if($cedula != "" && $codigoFicha != "" && $nombre != "" && $estado != "")
{
    if($formatoValido == true)
    {
    // Dividir la cadena en un array usando la coma como separador
    $arrayResultado = explode('-', $cedula);
    $cedulaEnLimpio = trim($arrayResultado[1]);
    
    
        // llamo la funcion le envio los datos para que inserte el nombre del programa, nombre Aprendiz y estado
        // si da true es porque si existe en la base de datos y se Inserte con exito los datos 
        // si da false es porque no esta en la base de datos 
    
        $data = array(actulizarDatos($codigoFicha,$cedulaEnLimpio,$prgramaFormacion,$nombre));
    
    if($data[0]["status"])
    {
        $arregloActualizados['updateExito'][] = $data;
    
    
    }
    else{
        $arregloActualizados['updateDenegado'][] = $data;
    
    }
    
    
    


    }
    else{
        // aca voy a guardar el error de que no es el tipo de archivo      
       $arregloError = array(
        'status' =>"404",
        'descripcion'=>"TIPO DE FORMATO EQUIVOCADO",
        
    );
    // aca lo agrego al array principal
    $arregloActualizados['error'][] = $arregloError;
    
   

    $fila =$filasDeHojaExcel;


    }



}
// ----------------------------------------
 }


 // Convertir el array de clientes a JSON
$json_clientes = json_encode($arregloActualizados);

// envio el JSON
    echo $json_clientes;


}




}
// ------------------

// aca voy hacer la funcion donde se va insertar el nombre del programa al aprendiz

function actulizarDatos($numeroFicha,$cedulaPaciente,$nombrePrograma,$nombreAprendiz)
{
    $arregloDatos = array();

    $mysql = new MYSQL();
    // primero hago una consulta a ver si existe
    $consultaSiExiste= $mysql->efectuarConsulta("SELECT * FROM inscripcionaprendiz1 WHERE cedula =$cedulaPaciente and numeroFicha=$numeroFicha");

if(mysqli_fetch_row($consultaSiExiste) > 0)
{

    $mysql = new MYSQL();
    // primero hago una consulta a ver si existe
    $consulta= $mysql->efectuarConsulta("SELECT * FROM inscripcionaprendiz1 WHERE cedula =$cedulaPaciente and numeroFicha=$numeroFicha and estado = 'Matriculado';");

if(mysqli_fetch_row($consulta) == 0)
{

 // aca hago ya la actulizacion del aprendiz

 $mysql = new MYSQL();

 $mysql->efectuarConsulta("UPDATE bd_formaser.inscripcionaprendiz1 SET nombreCompleto ='$nombreAprendiz', nombrePrograma= '$nombrePrograma', estado='Matriculado' WHERE cedula =$cedulaPaciente AND numeroFicha = $numeroFicha AND estado='Preinscrito' ");
// Obtener el número de filas afectadas por la consulta de actualización
$numFilasAfectadas = $mysql->filasAfectadas();
$mysql->desconectar();

if($numFilasAfectadas > 0) 
{

// aca guardo en un arreglo los aprendices que se actulizo con exito
$aprendiz_actualizadoExito = array(
    'cedula' =>"$cedulaPaciente",
    'nombre' => "$nombrePrograma",
    'codigoFicha' => "$numeroFicha",
    'estado'=> "Matriculado",
    'nombrePrograma'=> $nombrePrograma,
    'descripcion'=> "Actualizado con exito",
    'status'=>true


    


);
// aca lo agrego al array principal
$arregloDatos['updateExito'][] = $aprendiz_actualizadoExito;

return $aprendiz_actualizadoExito;
}


// ----------------------------


}
else{
// aca voy a meter en un arreglo de que ya ese aprendiz ya esta "Matriculado"


$aprendiz_denegado = array(
    'cedula' =>"$cedulaPaciente",
    'nombre' => "$nombreAprendiz",
    'codigoFicha' => "$numeroFicha",
    'estado'=> "Preinscrito",
    'nombrePrograma'=> $nombrePrograma,
    'descripcion'=> "este Aprendiz ya esta Matriculado",
    'status'=>false



    


);
// aca lo agrego al array principal
$arregloDatos['updateDenegado'][] = $aprendiz_denegado;
return $aprendiz_denegado;


}



}
else{
    // aca guardo los aprendices que no estan en la base de datos
    $aprendiz_denegado = array(
        'cedula' =>"$cedulaPaciente",
        'nombre' => "$nombreAprendiz",
        'codigoFicha' => "$numeroFicha",
        'estado'=> "Null",
        'nombrePrograma'=> $nombrePrograma,
        'descripcion'=> "este Aprendiz no a pasado por el primer formato",
        'status'=>false



        


    );
    // aca lo agrego al array principal
    $arregloDatos['updateDenegado'][] = $aprendiz_denegado;
    return $aprendiz_denegado;

}



   


}





?>