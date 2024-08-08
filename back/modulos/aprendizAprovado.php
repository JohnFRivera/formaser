<?php
// Verificar si se recibieron los datos necesarios
if (isset($_POST['cedula']) && isset($_POST['ficha'])) {
    // Obtener los datos de POST
    $cedula = $_POST['cedula'];
    $ficha = $_POST['ficha'];

    // Validar y sanitizar las entradas
    if (is_numeric($cedula) && is_numeric($ficha)) {
        require_once './MYSQL.php';
        
        try {
            // Crear una instancia de la clase MYSQL
            $mysql = new MYSQL();
            
            // Ejecutar la consulta para actualizar el estado
            $consulta = $mysql->efectuarConsulta("UPDATE inscripcionaprendiz1 
                                                   SET estado = 'Preinscrito' 
                                                   WHERE cedula = $cedula 
                                                   AND numeroFicha = $ficha");
            
            // Desconectar la base de datos
            $mysql->desconectar();
            
            // Verificar si la consulta se ejecutó con éxito
            if ($consulta) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('success' => false, 'error' => 'No se pudo actualizar el registro.'));
            }
        } catch (Exception $e) {
            // Manejo de errores en caso de problemas con la conexión o consulta
            echo json_encode(array('success' => false, 'error' => 'Ocurrió un error: ' . $e->getMessage()));
        }
    } else {
        echo json_encode(array('success' => false, 'error' => 'Datos de entrada inválidos.'));
    }
} else {
    echo json_encode(array('success' => false, 'error' => 'Faltan datos necesarios.'));
}
?>
