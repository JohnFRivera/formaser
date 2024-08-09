<?php
require_once '../../modulos/MYSQL.php';

// Captura los datos de entrada de manera segura
$email = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
$pass = $_POST['password'] ?? '';

// Hash de la contraseña ingresada por el usuario
$hashedPass = md5($pass);

$mysql = new MYSQL();
$query = "SELECT Correo as correo, password as pass FROM bd_formaser.usuarios WHERE Correo = ?";
$Traer_info = $mysql->efectuarConsulta($query, 's', [$email]);
$mysql->desconectar();

$loginError = "";

if ($Traer_info->num_rows > 0) {
    $row = $Traer_info->fetch_assoc();
    $bd_correo = $row['correo'];
    $bd_pass = $row['pass'];

    // Validación de contraseña
    if (hash_equals($hashedPass, $bd_pass)) {
        // Inicio de sesión exitoso, redirigir al área de administración
        header("Location: /admin/usuarios/");
        exit();
    } else {
        $loginError = "Contraseña incorrecta";
    }
} else {
    $loginError = "El correo no existe";
}
?>