<?php

require_once 'usuarios.php';


// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $identificacion = $_POST['identificacion'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['password'];

    // Crear una instancia de la clase Usuario
    $usuario = new Usuario();

    // Agregar el nuevo usuario
    $mensaje = $usuario->crear($identificacion, $nombre, $apellido, $correo, $contrasena);

    // Redirigir o mostrar un mensaje según el resultado
    if ($mensaje == "Usuario creado exitosamente.") {
        header("Location: http://localhost/formaser/front/admin/usuarios/"); // Redirigir al listado de usuarios
        exit();
    } else {
        $error = $mensaje;
    }
}