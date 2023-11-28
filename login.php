<?php
$usuario = $_POST ['user'];
$contrasenia = $_POST ["password"];

session_start();
$_SESSION["usuario"] =$usuario;


$miuser = "admin";
$mipass = "1234";

if ($usuario === $miuser && $contrasenia === $mipass){
    header("Location: listar.php");
    exit;
}else{
    echo 'Contraseña erronea';
}



?>