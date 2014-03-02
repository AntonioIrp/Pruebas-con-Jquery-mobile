<?php
include 'email_validator.php';

//VALIDACION DE LOGIN
function loginValidator($pEmail, $pPassword){
$m_empty_email=("El email no puede estar vacio");
$m_empty_password=("La contraseña no puede estar vacia");

if(empty($pEmail)){
	return $m_empty_email;
}else if(empty($pPassword)){
	return $m_empty_password;
}
}

//VALIDACION DE ALTA DE COMERCIO
function comercioValidator($nombre_comercio, $descripcion_comercio){

//mensajes de validacion:
$m_empty_nombre_comercio=("El nombre del comercio no puede estar vacio");
$m_empty_descripcion_comercio=("La descripcion del comercio no puede estar vacio");

if(empty($nombre_comercio)){
	return $m_empty_nombre_comercio;
}else if(empty($descripcion_comercio)){
	return $m_empty_descripcion_comercio;
}
}


//VALIDACION DE REGISTRO
function registerValidator($pUsername, $pEmail, $pPassword, $pVpassword){

//mensajes de error de validacion:
$m_empty_username=("El nombre no puede estar vacio");
$m_empty_email=("El email no puede estar vacio");
$m_error_email=("E-mail no válido");
$m_empty_password=("La contraseña no puede estar vacia");
$m_empty_vpassword=("Verifique su contraseña");
$m_passwords_mismatch=("Las contraseñas no coinciden");	

//comienzo de la validación
if(empty($pUsername)){
	return $m_empty_username;
	
}else if(empty($pEmail)){
	return $m_empty_email;
	
}else if(ValidaMail($pEmail)==false){
	return $m_error_email;
	
}else if(empty($pPassword)){
	return $m_empty_password;
	
}else if(empty($pVpassword)){
	return $m_empty_vpassword;
	
}else if($pPassword !== $pVpassword){
	return $m_passwords_mismatch;
	
}

}
?>