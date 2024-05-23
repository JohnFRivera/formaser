<?php 
    require_once 'MYSQL.php' ;
    $mysql = new MYSQL();
    $resultadoConsulta = $mysql -> efectuarConsulta("SELECT tipoCedula as tipo,
    cedula as cedula,
    numeroFicha as ficha ,
    tipoPoblacion as poblacion ,
    codigoEmpresa as empresa
    FROM inscripcionaprendiz1 WHERE estado like '%Preinscrito%' ") ;
    $mysql->desconectar() ;
    $data = array();
    foreach ($resultadoConsulta as $row) 
    {
        $data[] = $row; 
    }
    echo json_encode($data) ;
?>