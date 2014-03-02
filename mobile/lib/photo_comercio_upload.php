<?php
include '../config/db_connect.php';
include 'functions.php';
session_start();

if(db_connection()){
	echo("FALLO AL CONECTAR");
}else if(login_check($mysqli) == false){
	echo("ERROR DE SESION");
} else if ($_FILES['imagen']['error'] > 0)
{
  echo "ha ocurrido un error";
} 
else {

	$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
	$limite_kb = 800;

	if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024){
		$id_comercio=$_SESSION['lastcomercio'];
		$file=$id_comercio . ".jpg";
		$dir_url="../../db_comercios_images/";
		$ruta = $dir_url . $file;
		
		if (!file_exists($ruta)){
			$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
		} else {
			echo $_FILES['imagen']['name'] . ", este archivo existe";
		}
	}else {
		echo "archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
	}
}

?>