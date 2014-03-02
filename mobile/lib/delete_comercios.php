<?php
//header("Content-Type: text/html; charset=utf-8");
include '../config/db_connect.php';
session_start();

$id_comercio = trim($_POST['idcomercio']);
$id_user=$_SESSION['user_id'];

$query=("DELETE FROM comercios WHERE id_user= ? AND id_comercio= ?");

if(db_connection()){
	echo("ERROR AL CONECTAR");
}else if($stmt=$mysqli->prepare($query)){
	$stmt->bind_param('ss',$id_user,$id_comercio);
	$stmt->execute();
	echo("Comercio eliminado");
}else{
	echo("error");
}
?>