<?php
require_once '../../modulos/MYSQL.php';

// Captura los datos de entrada de manera segura
$email = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
$pass = $_POST['password'] ?? '';

$mysql = new MYSQL();
$query = "SELECT Correo as correo, password as password FROM bd_formaser.usuarios WHERE Correo = ?";
$Traer_info = $mysql->efectuarConsulta($query, 's', [$email]);

$loginError = "";

if ($Traer_info->num_rows > 0) {
    $row = $Traer_info->fetch_assoc();
    $bd_correo = $row['correo'];
    $bd_pass = $row['password'];

    // Validación de contraseña usando password_verify
    if (password_verify($pass, $bd_pass)) {
        // Inicio de sesión exitoso, redirigir al área de administración
        header("Location: http://localhost/formaser/front/admin/subir_archivos/pre-inscritos.php");
        exit();
    } else {
        echo $loginError = "Contraseña incorrecta";
    }
} else {
    echo $loginError = "El correo no existe";
}
