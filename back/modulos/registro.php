<?php
    require_once 'MYSQL.php';
    $name = $_POST['nombre'];
    $lastname = $_POST['apellido'];
    $id = $_POST['identificacion'];
    $email = $_POST['correo'];
    $password = md5($_POST['password']);
    $mysql = new  MYSQL();
    $buscarCorreo = $mysql ->efectuarConsulta("SELECT Correo as correo FROM usuarios WHERE Correo='".$email."'");

    $resultadoBusqueda = "";
    while ($row = $buscarCorreo->fetch_assoc())
    {
        $resultadoBusqueda = $row['correo'];
    }
    // ? Valido si el correo ya esta registrado 
    // ? sino no lo esta lo agrego a la base 
    switch ( true )
    {
        case ($email != $resultadoBusqueda):
            $mysql->efectuarConsulta("INSERT INTO usuarios VALUES(" . $id . ",'" . $name . "','" . $lastname . "','" . $email . "','" . $password . "')");
            $mysql->desconectar();
            $arregloErrores = array();
            break;
        case ($email == $resultadoBusqueda):
            $error = array(
                'code' => "404",
                'Des' => "Error!!! Ya existe un usuario registrado con esta direccion de correo",
                'Correo' => $email,
            );
            $arregloErrores['error'][] = $error;
    }
    echo json_encode($arregloErrores);
  
  
?>
 