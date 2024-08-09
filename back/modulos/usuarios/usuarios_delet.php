<?php
require_once '../MYSQL.php';
require_once 'usuarios.php';

$usuario = new Usuario();

// Verificar si se ha enviado el formulario para eliminar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identificacion = $_POST['identificacion'];
    
    $resultado = $usuario->eliminar($identificacion);

    if ($resultado === "Usuario eliminado exitosamente.") {
        header('Location: http://localhost/formaser/front/admin/usuarios/');
        exit;
    } else {
        $error = $resultado;
    }
}

// Obtener el ID del usuario de la URL
if (isset($_GET['id'])) {
    $identificacion = $_GET['id'];
    $usuarioActual = $usuario->obtenerPorId($identificacion);

    if (!$usuarioActual) {
        echo "Usuario no encontrado.";
        exit;
    }
} else {
    echo "ID de usuario no proporcionado.";
    exit;
}
?>