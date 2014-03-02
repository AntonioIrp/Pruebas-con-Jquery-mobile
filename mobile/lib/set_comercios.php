<?php
//header("Content-Type: text/html; charset=utf-8");
include '../config/db_connect.php';
include 'functions.php';
include 'form_validator.php';

session_start();

$nombre_comercio = trim($_POST['nombre']);
$descripcion_comercio = trim($_POST['descripcion']);
$user_id=$_SESSION['user_id'];

$query=("INSERT INTO comercios (id_user,nombre_comercio,descripcion_comercio) VALUES (?,?,?)");

if(db_connection()){
	echo("Error");
}else if($validation_status=comercioValidator($nombre_comercio, $descripcion_comercio)){
	echo $validation_status;
}else if(login_check($mysqli) == false){
	echo ("Su sesión ha expirado, inicie sesión");
}else if($stmt=$mysqli->prepare($query)){
	$stmt->bind_param('sss',$user_id,$nombre_comercio,$descripcion_comercio);
	$stmt->execute();
	
	$last_id=$stmt->insert_id;
	$_SESSION['lastcomercio']=$last_id;
	
	echo("Comercio añadido correctamente");
}else{
	echo("Error");
}
?>