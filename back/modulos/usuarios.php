<?php 
    require_once 'MYSQL.PHP' ;
    $mysql = new MYSQL();
    $resultadoConsulta = $mysql -> efectuarConsulta("SELECT Identificacion as id,
    Nombre,
    Apellido,
    Correo
    FROM usuarios ") ;
    $mysql->desconectar() ;
    $data = array();
    foreach ($resultadoConsulta as $row) 
    {
        $data[] = $row; 
    }
    echo json_encode($data) ;
?>