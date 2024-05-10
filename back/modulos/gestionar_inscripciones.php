<?php 
    require_once '../modulos/MYSQL.php' ;
    $mysql = new MYSQL();
    $resultadoConsulta = $mysql -> efectuarConsulta("SELECT tipoCedula, cedula, numeroFicha, tipoPoblacion, codigoEmpresa FROM inscripcionaprendiz1 WHERE estado = 'Preinscrito' ") ;
    $mysql->desconectar() ;
    echo json_encode($resultadoConsulta) ;
?>