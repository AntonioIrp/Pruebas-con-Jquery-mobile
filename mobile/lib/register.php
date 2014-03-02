<?php
header("Content-Type: text/html; charset=utf-8");
include '../config/db_connect.php';
include 'functions.php';
include 'form_validator.php';

// Datos recibidos del formulario
//contraseñas en sha256
$password_form = trim($_POST['password']);
$v_password_form = trim($_POST['v_password']);
$nombre_usuario=trim($_POST['username']);
$email=trim($_POST['email']);

// Create a random salt
$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
// Create salted password (Careful not to over season)
$password_for_store = hash('sha512', $password_form.$random_salt);

//comprobaciones conexion y trabajo con bd
if(db_connection()){
	echo("ERROR AL CONECTAR");
}else if($validation_status = registerValidator($nombre_usuario, $email, $password_form, $v_password_form)){
	echo $validation_status;
}else if($check_stmt = $mysqli->prepare("SELECT username, email FROM members WHERE username= ? OR email= ? ")){
	
	$check_stmt->bind_param('ss', $nombre_usuario, $email);
	$check_stmt->execute();
	$check_stmt->store_result();
	$check_stmt->bind_result($db_username, $db_email);
    $check_stmt->fetch();
	
	if($check_stmt->num_rows >= 1){
		if($db_username == $nombre_usuario){
			echo("<li>El usuario ya existe</li>");
		}else if($db_email == $email){
			echo("<li>El e-mail ya está registrado</li>");
		}		
	}else if($insert_stmt = $mysqli->prepare("INSERT INTO members (username, email, password, salt) VALUES (?, ?, ?, ?)")){
		
		$insert_stmt->bind_param('ssss', $nombre_usuario, $email, $password_for_store, $random_salt); 
		$insert_stmt->execute();
		echo("<h3>Registrado correctamente!</h3>");
	}
}
?>
