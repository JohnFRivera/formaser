<?php
require_once 'C:/xampp/htdocs/formaser/back/modulos/MYSQL.php';


try {
    // Crear una instancia de la clase MYSQL
    $mysql = new MYSQL();
    
    // Ejecutar la consulta para obtener datos de inscritos
    $resultadoConsulta = $mysql->efectuarConsulta("SELECT * FROM inscripcion");
    
    // Desconectar la base de datos
    $mysql->desconectar();

    // Inicializar el arreglo de datos
    $data = array();

    // Recorrer los resultados y agregarlos al arreglo
    while ($row = mysqli_fetch_assoc($resultadoConsulta)) {
        $data[] = $row;
    }

    // Codificar los datos a formato JSON y devolverlos
    return $data;

} catch (Exception $e) {
    // Manejo de errores en caso de problemas con la conexión o consulta
    echo json_encode(array('error' => 'Ocurrió un error: ' . $e->getMessage()));
}
?>
