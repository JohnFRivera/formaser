<?php
require_once '../MYSQL.php';
require_once 'usuarios.php';

$usuario = new Usuario();

// Verificar si se ha enviado el formulario para actualizar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identificacion = $_POST['identificacion'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['correo'];

    $resultado = $usuario->actualizar($identificacion, $nombre, $apellido, $correo);

    if ($resultado === "Usuario actualizado exitosamente.") {
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