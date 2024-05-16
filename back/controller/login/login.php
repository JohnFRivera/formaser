<?php
    require_once '../../modulos/MYSQL.php';
    $email = $_POST['correo'];
    $pass = $_POST['password'];
    // ? Creo una variable que va almacenar el password enviada por el el usuario 
    // ? y lo convierte en hash
    $passStr = '';
    $passStr = md5($pass);
    $mysql = new MYSQL();
    $Traer_info = $mysql-> efectuarConsulta("SELECT usuarios.Correo as correo, usuarios.password as pass FROM bd_formaser.usuarios WHERE usuarios.Correo = '".$email."'");
    $mysql -> desconectar();
    $arregloErrores = array() ;
    // ? Variables que capturan los datos de la base
    $bd_correo ="" ;
    $bd_pass = '' ;
    // ? Validador de password
    $validarPass = false;
    while ($row = $Traer_info->fetch_assoc())
    {
        $bd_correo = $row['correo'];
        $bd_pass = $row['pass'];
    }
    // ? Valido si las passwords son iguales, 
    // ? toca convertir la password que envia el usuario en hash 
    // ? para validar con el hash que trae la consulta
    if( hash_equals( $passStr , $bd_pass)) {
        $validarPass = true ;
    }else{
        $validarPass = false ;
    }
    // ? Valido los diferentes casos cuando el usuario inicie sesion
    switch ( true ) {
        case ($email == $bd_correo && $validarPass == true):
        $Mensaje = array( 
            'Code' => "200",
            'Route'=> "/front/admin/",
             ) ;
        $arregloErrores = $Mensaje ;
        break;
        case ($email == $bd_correo && $validarPass == false):
        $Mensaje = array( 
            'Code' => "404",
            'Error'=> "Contraseña incorrecta"
             ) ;
        $arregloErrores = $Mensaje ;
        break;
        case ($email != $bd_correo && $pass != $bd_pass):
        $Mensaje = array(
            'Code' => "404",
            'Error' => "El correo no existe"
        );
        $arregloErrores = $Mensaje ;
        break;
    }
    // ? Envio los mensajes como json para capturarlos en JavaScript
    // ?  y mostrar alguna respuesta
        echo json_encode($arregloErrores);
?>