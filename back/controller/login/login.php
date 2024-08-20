<?php
require_once '../../modulos/MYSQL.php';

// Captura los datos de entrada de manera segura
$email = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
$pass = $_POST['password'] ?? '';

$mysql = new MYSQL();

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $query = "SELECT id,correo, password as password FROM usuarios WHERE Correo = ?";
    $Traer_info = $mysql->efectuarConsulta($query, 's', [$email]);
    
    $loginError = "";
    
    if ($Traer_info->num_rows > 0) {
        $row = $Traer_info->fetch_assoc();
        $id =$row['id'];
        $bd_correo = $row['correo'];
        $bd_pass = $row['password'];
    
        // Validación de contraseña usando password_verify
        if (password_verify($pass, $bd_pass)) {

            $_SESSION['user_id'] = $id['id'];
            $_SESSION['logged_in'] = true;
            // Inicio de sesión exitoso, redirigir al área de administración
            header("Location: http://localhost/formaser/front/admin/subir_archivos/pre-inscritos.php");
            echo htmlspecialchars($_SESSION['user_id']);
            exit();
        } else {
            echo $loginError = "Contraseña incorrecta";
        }
    } else {
        echo $loginError = "El correo no existe";
    }
    
}
