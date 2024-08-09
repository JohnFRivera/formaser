<?php
require_once 'MYSQL.php';

try {
    $mysql = new MYSQL();
    // Ejecuta la consulta
    $resultadoConsulta = $mysql->efectuarConsulta("SELECT tipoCedula AS tipo,
      cedula AS cedula,
      numeroFicha AS ficha,
      tipoPoblacion AS poblacion,
      codigoEmpresa AS empresa
      FROM inscripcionaprendiz1
      WHERE estado LIKE '%Preinscrito%'");
    
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
    echo json_encode(array('error' => 'Ocurrió un error: ' . $e->getMessage()));
}
?>
