<?php


$cedula = $_POST['cedula'];
$ficha = $_POST['ficha'];


require_once './MYSQL.php';
$mysql = new MYSQL();


$consulta = $mysql->efectuarConsulta("UPDATE inscripcionaprendiz1 SET estado = 'Preinscrito' WHERE cedula =$cedula AND numeroFicha =$ficha");
$mysql->desconectar();

if($consulta)
{
    echo true;
}
else{
    echo false;
}






?>