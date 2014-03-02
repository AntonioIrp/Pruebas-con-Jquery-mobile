<?php
	include 'lib/functions.php';
	//sec_session_start();
	session_start();
	
?>
<!DOCTYPE html> 
<html manifest="myapp.manifest">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1,
user-scalable=no"/>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="apple-mobile-web-app-title" content="miWebApp" />

<title>Aplic. Web de jQuery Mobile</title>

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>


<link href="css/index_page_style.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="plugins/add2home/add2home.css">
<script src="plugins/add2home/add2home.js"></script>

<script type="text/javascript" src="js/sha.js"></script>
<script type="text/javascript" src="js/sha256.js"></script>
<script type="text/javascript" src="js/index_control.js"></script>
</head> 

<body>
<div id="index_page" data-role="page">
<div data-role="content">	 
<ul id="login_option_buttons" data-role="listview" data-inset="true">
	<li data-role="list-divider">Seleccione una opción:</li>
	
    <li><a href="#login_page" data-transition="slide">
	<h2>Acceder</h2>
	<p>Acceda con sus credenciales de usuario</p>
	</a></li>

	<li><a href="#signup_page" data-transition="slide">
	<h2>Registrarse:</h2>
	<p>Registrese con su e-Mail y una contraseña</p>
	</a></li>
</ul>	
</div>

<div id="info_buttons" data-type="vertical" data-mini="true" data-role="controlgroup" style="text-align:center;">
	<a id="informacion_index_button" data-icon="info" data-iconpos="right" data-role="button" data-theme="e">Información</a>
	<a id="acerca_de_index_button" data-icon="info" data-iconpos="right" data-role="button" data-theme="e">Acerca de</a>
    <a id="proseguir_sesion_index_button" data-icon="arrow-r" data-iconpos="right" data-role="button" data-theme="e">Proseguir sesión</a>
    
</div>

<div id="informacion_popup" data-role="popup">
<ul id="informacion_info" data-role="listview" data-inset="true">
	<li data-role="list-divider">Información</li>
    <li>
	<p align="justify" >Esta aplicacion trata de ayudar a gestionar</p>
    <p align="justify">tanto los productos como el personal de un </p>
    <p align="justify">negocio, proporciona herramientas de</p>
    <p align="justify">gestion e inventariado</p>
    <a href="maps:q=2001+Flora+Street,+Dallas,+TX">Map: 2001 Flora Street, Dallas</a>
	</li>
</ul>  
</div>

<div id="acerca_de_popup" data-role="popup">
<ul id="acerca_de_info" data-role="listview" data-inset="true">
	<li data-role="list-divider">Acerca de...</li>
    <li>
    <h3>Realizada por:</h3>
    <h3>&copy; antonio_irp@hotmail.com</h3>
	<p align="justify" >2013</p>
	</li>
</ul>
</div>
</div>



<div data-role="page" id="login_page">
<a href="#index_page" id="back_to_index_button" data-role="button" data-theme="e" data-mini="true" data-icon="back" data-transition="slide" data-direction="reverse">Volver</a>
<h1><div id="login_status"></div></h1>
<div id="login_form">
<form id="login_form_fields">
	<input id="login_email_text_field" type="text" name="textinput" value="" placeholder="E-Mail:"/>
	<input id="login_password_text_field" type="password" name="textinput2" value="" placeholder="Contraseña:" /> 
</form>       
</div>

<div id="login_submit_button"> 
	<input type="submit" id="submit_form" value="Acceder" data-icon="edit" data-iconpos="right" data-theme="e"/>
</div>

<div data-role="popup" id="login_popup" data-overlay-theme="a" data-theme="c" style="max-width:400px;" class="ui-corner-all">

	<div data-role="header" data-theme="a" class="ui-corner-top">
  		<h1>Problemas con el acceso:</h1>
  	</div>		
	<div data-role="content" data-theme="d" class="ui-corner-bottom ui-content">
    	<p>Asegurese de haber escrito correctamente sus credenciales</p>
        <br> 
        <div id="login_message_error"></div>
    </div> 
</div>
	
</div>



<div data-role="page" id="signup_page">
<a href="#index_page" id="back_to_index_button" data-role="button" data-theme="e" data-mini="true" data-icon="back" data-transition="slide" data-direction="reverse">Volver</a>

<div id="signup_form">
<form id="signup_form_fields">
	<input id="signup_username_text_field" type="text" name="username" value="" placeholder="Nombre de usuario:"/>
	<input id="signup_email_text_field" type="text" name="email" value="" placeholder="E-mail:" /> 
    <input id="signup_password_text_field" type="password" name="password" value="" placeholder="Contraseña:" />
    <input id="signup_vpassword_text_field" type="password" name="vpassword" value="" placeholder="Repita su contraseña..." />  
</form>      
</div>

<div id="login_submit_button"> 
	<input type="submit" id="submit_form_button" value="Enviar" data-icon="edit" data-iconpos="right" data-theme="e"/>
</div>

<div data-role="popup" id="register_popup" data-overlay-theme="a" data-theme="c" style="max-width:400px;" class="ui-corner-all">

	<div data-role="header" data-theme="a" class="ui-corner-top">
  		<h1>Registrando usuario</h1>
  	</div>		
	<div data-role="content" data-theme="d" class="ui-corner-bottom ui-content">
		<h3 class="ui-title">El proceso puede tardar unos segundos</h3>
    	<p>Espere por favor.</p>
        <br> 
        <div id="message"></div>
    </div> 
</div>

</div>

</body>
</html>