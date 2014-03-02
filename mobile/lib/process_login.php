<?php
include '../config/db_connect.php';
include 'functions.php';
include 'form_validator.php';

//sec_session_start(); // Our custom secure way of starting a php session. 
session_start();

$email=trim($_POST["email"]);
$password=trim($_POST["password"]);
$login_status=("");

if(db_connection()){
	echo("FALLO AL CONECTAR");
}else if($validation_status = loginValidator($email, $password)){
	echo $validation_status;
}else
{ 
	if($login_status=login($email,$password,$mysqli))
	{
		//header('Location: ../docs/php/welcome.php');
		echo($login_status);
		exit;
	}
	else
	{
		echo("Error general");
		exit;
	}
}
?>