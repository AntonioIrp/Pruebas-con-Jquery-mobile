<?php
$mysqli;

function db_connection(){
  define("HOST", "localhost"); // The host you want to connect to.
  define("USER", "root"); // The database username.
  define("PASSWORD", ""); // The database password. 
  define("DATABASE", "secure_login"); // The database name.
  error_reporting(0);
  global $mysqli; 
  
  $mysqli= new mysqli(HOST, USER, PASSWORD, DATABASE);
  if($mysqli->connect_error){
		return TRUE;  
  }else{
	  	$acentos = $mysqli->query("SET NAMES 'utf8'");
	  	return FALSE;
  }
}
?>