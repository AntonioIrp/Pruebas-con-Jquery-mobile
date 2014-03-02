<?php
session_start();
include '../../config/db_connect.php';
include '../../lib/functions.php';


if(db_connection()){
	echo("FALLO AL CONECTAR");
}else if(login_check($mysqli) == false) 
{ 
	include '../sinpermisos.php';	
} 
else 
{
	header ("Location: ../protect/welcome.php");
	//include '../protect/welcome.php';
	exit;
}
?>