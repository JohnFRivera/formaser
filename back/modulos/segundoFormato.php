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
   

   // aca verifica que si sea el formato de preinscritos

   $formatoValido = false;
   for ($fila = 7; $fila <= $filasDeHojaExcel; $fila++) {
    $estado = $hojaExcel->getCell('C'.$fila);
    $estado= trim($estado);
    if($estado == "Preinscrito")
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


    // aca voy a eliminar los espacios si depronto tiene 
    $estado = trim($estado);
    $arrayResultado = explode('-', $cedula);
    $cedulaEnLimpio = trim($arrayResultado[1]);
    // aca voy a ejecutar la funcion donde va averificar si ese aprendiz se encuentra cursando otro curso en el año vigente 
    $verificacion = array(verificandoCursoAnoVigente($cedulaEnLimpio,$prgramaFormacion,$estado,$codigoFicha,$nombre));
    if($verificacion[0] == false)
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

    $arregloActualizados['updateDenegado'][] = $verificacion;


     
    
 

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
    $consulta= $mysql->efectuarConsulta("SELECT * FROM inscripcionaprendiz1 WHERE cedula =$cedulaPaciente and numeroFicha=$numeroFicha and estado = 'Preinscrito';");

if(mysqli_fetch_row($consulta) == 0)
{

 // aca hago ya la actulizacion del aprendiz

 $mysql = new MYSQL();

 $mysql->efectuarConsulta("UPDATE bd_formaser.inscripcionaprendiz1 SET nombreCompleto ='$nombreAprendiz', nombrePrograma= '$nombrePrograma', estado='Preinscrito' WHERE cedula =$cedulaPaciente AND numeroFicha = $numeroFicha");
// Obtener el número de filas afectadas por la consulta de actualización
$numFilasAfectadas = $mysql->filasAfectadas();
$mysql->desconectar();

if($numFilasAfectadas > 0) 
{

// aca guardo en un arreglo los aprendices que se actulizo con exito
$aprendiz_actualizadoExito = array(
    'cedula' =>"$cedulaPaciente",
    'nombre' => "$nombreAprendiz",
    'codigoFicha' => "$numeroFicha",
    'estado'=> "Preinscrito",
    'nombrePrograma'=> "$nombrePrograma",
    'descripcion'=> "Actualizado con exito",
    'status'=>true,
    'descripcionCursos' => null,
    'cursoRepetido'=> null

    


    


);
// aca lo agrego al array principal
$arregloDatos['updateExito'][] = $aprendiz_actualizadoExito;

return $aprendiz_actualizadoExito;
}


// ----------------------------


}
else{
// aca voy a meter en un arreglo de que ya ese aprendiz ya esta "Preinscrito"


$aprendiz_denegado = array(
    'cedula' =>"$cedulaPaciente",
    'nombre' => "$nombreAprendiz",
    'codigoFicha' => "$numeroFicha",
    'estado'=> "Preinscrito",
    'nombrePrograma'=> "$nombrePrograma",
    'descripcion'=> "este Aprendiz ya esta Preinscrito",
    'status'=>false,
    'descripcionCursos' => null,
    'cursoRepetido'=> null





    


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
        'status'=>false,
        'descripcionCursos' => null,
        'cursoRepetido'=> null





        


    );
    // aca lo agrego al array principal
    $arregloDatos['updateDenegado'][] = $aprendiz_denegado;
    return $aprendiz_denegado;

}
}


// aca voy hacer la funcion donde va verificar si esta cursando otro curso en este mismo año o si esta en otro curso diferente

function verificandoCursoAnoVigente($cedulaAprendiz,$nombreCurso,$estadoCurso,$fichaAprendi,$nombreAprendiz)
{

// voy primero a verificar que no alla ya hecho el mismo curso

$sql = new MYSQL();

$programa = trim($nombreCurso);
    $consultaVerificacion = $sql->efectuarConsulta("SELECT * from inscripcionaprendiz1 WHERE cedula= $cedulaAprendiz AND nombrePrograma ='$programa' AND estado = 'Matriculado';");

    $sql->desconectar();
    $tamaño1 = mysqli_num_rows($consultaVerificacion);
    $arregloDatos1 = array();
    if ($tamaño1 > 0) {

         //  ACA LLAMO LA FUNCION PARA ACTUALIZAR SOLO EL NOMBRE EN LA BASE DE DATOS 

         actualizarDatosAprendiz($nombreCurso,$cedulaAprendiz,$fichaAprendi);

         // -------------------------

        $descripcionCursos = array();
    
        while ($fila = mysqli_fetch_array($consultaVerificacion)) {
            $nombrePrograma = $fila['nombrePrograma'];
            $fecha = $fila['fechaMatricula'];
            $ficha = $fila['numeroFicha'];
    
            // Agregar datos al array $descripcionCursos
            $descripcionCursos[] = array(
                'fichaPrograma' => $ficha,
                'nombrePrograma' => $nombrePrograma,
                'fecha' => $fecha
            );
        }
    
        $arregloDatos1 = array(
            'cedula' =>"$cedulaAprendiz",
            'nombre' => "$nombreAprendiz",
            'codigoFicha' => "$fichaAprendi",
            'estado'=> null, // aca le voy a colocar Null porque en la base de datos no se actualizo
            'nombrePrograma'=> "$nombreCurso",
            'descripcion'=> null,
            'status'=>false,
            'descripcionCursos' => null,
            'cursoRepetido'=> $descripcionCursos
        );
    
        // aca lo agrego al array principal
        return $arregloDatos1;








    }
    else{


// aca voy a verificar que no se encuentre en un curso en el año vigente



        $mysql = new MYSQL();
        // obtengo el año actual para verificar si el aprendiz se encuentra inscripto en este mismo programa
       $ano_actual = date('Y');
    
        $consulta = $mysql->efectuarConsulta("SELECT * from inscripcionaprendiz1 WHERE cedula= $cedulaAprendiz AND fechaMatricula LIKE '$ano_actual%' AND estado = 'Matriculado';");
    
        $mysql->desconectar();
        $tamaño = mysqli_num_rows($consulta);
        $arregloDatos = array();
        if ($tamaño > 0) {

            //  ACA LLAMO LA FUNCION PARA ACTUALIZAR SOLO EL NOMBRE EN LA BASE DE DATOS 

            actualizarDatosAprendiz($nombreCurso,$cedulaAprendiz,$fichaAprendi);

            // -------------------------
            $descripcionCursos = array();
        
            while ($fila = mysqli_fetch_array($consulta)) {
                $nombrePrograma = $fila['nombrePrograma'];
                $fecha = $fila['fechaMatricula'];
                $ficha = $fila['numeroFicha'];
        
                // Agregar datos al array $descripcionCursos
                $descripcionCursos[] = array(
                    'fichaPrograma' => $ficha,
                    'nombrePrograma' => $nombrePrograma,
                    'fecha' => $fecha
                );
            }
        
            $arregloDatos = array(
                'cedula' =>"$cedulaAprendiz",
                'nombre' => "$nombreAprendiz",
                'codigoFicha' => "$fichaAprendi",
                'estado'=> null,
                'nombrePrograma'=> "$nombreCurso",
                'descripcion'=> null,
                'status'=>false,
                'descripcionCursos' => $descripcionCursos,
                'cursoRepetido'=> null
    
            );
        
            // aca lo agrego al array principal
            return $arregloDatos;
        
          
        }
        else{
            return false;
        }
        


    }




    // ---------------------------------------------
   


}




// funcion para actualizar solo el nombre de la empresa de los que no fueron Aceptados
function actualizarDatosAprendiz($nombreEmpresa,$cedulaAprendiz,$numeroFicha)
{

$sql = new MYSQL();

$sql->efectuarConsulta("UPDATE inscripcionaprendiz1 SET nombrePrograma ='$nombreEmpresa' WHERE cedula =$cedulaAprendiz AND numeroFicha = $numeroFicha ");
$sql->desconectar();

}

?>