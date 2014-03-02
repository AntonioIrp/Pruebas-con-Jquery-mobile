<?php
header("Content-Type: text/html; charset=utf-8");
include '../config/db_connect.php';
include 'functions.php';
include 'form_validator.php';

$nombre = trim($_POST['nombre']);
$email = trim($_POST['email']);

echo("nombre: ".$nombre." email: ".$email);

?>