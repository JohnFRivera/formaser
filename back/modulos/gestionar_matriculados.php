<?php 
    require_once 'MYSQL.php' ;
    $mysql = new MYSQL();
    $resultadoConsulta = $mysql -> efectuarConsulta("SELECT cedula as cedula,
    nombreCompleto as nombre,
    numeroFicha as ficha,
    nombrePrograma as programa,
    estado as estado
    FROM inscripcionaprendiz1 WHERE estado like '%Matriculado%' ") ;
    $mysql->desconectar() ;
    $data = array() ;
    foreach ($resultadoConsulta as $row){
        $data[] = $row ; 
    }
    echo json_encode($data) ;
?>