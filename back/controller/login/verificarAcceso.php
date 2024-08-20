<?php
session_start();

function verificar_acceso(){
    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        //usuario no logueado
        header('Location: ../../../index.php');
        exit();
    }
}