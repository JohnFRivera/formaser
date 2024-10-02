<?php
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

    //usuario no logueado
    header('Location: ../../../index.php');
    exit();
}