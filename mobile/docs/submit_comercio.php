<?php
session_start();
include "../config/db_connect.php";
include "../lib/functions.php";

if(db_connection()){
	echo("FALLO AL CONECTAR");
}else if(login_check($mysqli) == false) 
{
	include "sinpermisos.php";	
} 
else 
{
?>
<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8">
<title>Añade comercios</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
</head> 
<body> 

<div data-role="page" id="submit_comercios_page">
	<div data-role="header" data-theme="b">
    	<h1></h1>
		<a href="welcome.php" id="back_button" data-icon="back">Atras</a>
	</div>

<div data-role="content">

<script type="text/javascript" src="../js/submit_comercios_control.js"></script>
<script type="text/javascript" src="../plugins/jquery.form.min.js"></script>  	

<div id="comercio_form">
<form id="comercio_submit_form_fields" enctype="multipart/form-data">
<input id="nombre_comercio_text_field" type="text" name="nombre" value="" placeholder="Nombre del comercio:"/>
<input id="descripción_comercio_text_field" type="text" name="descripcion" value="" placeholder="Descripción del comercio:" /> 
</form>      

<form id="photo_form" method="post" action="../lib/photo_comercio_upload.php"  enctype="multipart/form-data">
  <label for="imagen">Fotografia (Opcional):</label>
  <input type="file" name="imagen" id="imagen"/>
</form>
</div>

<div id="status_form"></div>
<input type="submit" id="comercio_submit_button" value="Agregar" data-icon="edit" data-iconpos="right" data-theme="e"/>

<div id="confirmation_submit_comercio_popup" data-role="popup">
<ul id="acerca_de_info" data-role="listview" data-inset="true">
	<li data-role="list-divider">Estado...</li>
    <li>
    <p><div id="submit_comercio_status"></div></p>
	</li>
</ul>
</div>		
</div>
</div>
</body>
</html>
<?php
}
?>