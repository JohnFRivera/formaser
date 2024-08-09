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

$arregloErrores = array();
$validarPass = false;

if ($Traer_info->num_rows > 0) {
    $row = $Traer_info->fetch_assoc();
    $bd_correo = $row['correo'];
    $bd_pass = $row['pass'];

    // Validación de contraseña
    $validarPass = hash_equals($hashedPass, $bd_pass);

    if ($validarPass) {
        $arregloErrores = array(
            'Code' => "200",
            'Route' => "/admin/usuarios/",
        );
    } else {
        $arregloErrores = array(
            'Code' => "404",
            'Error' => "Contraseña incorrecta"
        );
    }
} else {
    $arregloErrores = array(
        'Code' => "404",
        'Error' => "El correo no existe"
    );
}

// Enviar los mensajes como JSON para ser capturados en JavaScript
echo json_encode($arregloErrores);
