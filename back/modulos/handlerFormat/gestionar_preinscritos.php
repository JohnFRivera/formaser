<?php

require_once 'C:/xampp/htdocs/formaser/back/modulos/MYSQL.php';


try {
    $mysql = new MYSQL();
    // Ejecuta la consulta
    $resultadoConsulta = $mysql->efectuarConsulta("SELECT * FROM pre_inscrito");
    
    // Desconecta la base de datos
    $mysql->desconectar();

    // Inicializa el arreglo de datos
    $data = array();

    // Recorre los resultados y los agrega al arreglo
    while ($row = mysqli_fetch_assoc($resultadoConsulta)) {
        $data[] = $row;
    }

    // Codifica los datos a formato JSON y los devuelve
    return $data;

} catch (Exception $e) {
    // Manejo de errores en caso de problemas con la conexión o consulta
    array('error' => 'Ocurrió un error: ' . $e->getMessage());
}
?>
