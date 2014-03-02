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
<title>Comercios</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
</head> 

<body> 
<div data-role="page" id="welcome_page">
<script type="text/javascript" src="../js/welcome_control.js"></script>
<script type="text/javascript" src="../js/generateList.js"></script>
<script>
get_comercios();
</script>

<div data-role="header" data-theme="b">
  <h1></h1>
  <a id="logout_button" data-icon="arrow-l" data-role="button" data-theme="b">Cerrar Sesión</a>
  <a href="submit_comercio.php" id="agregar_comercio_button" data-icon="plus" data-iconpos="right" data-role="button" data-theme="b">Agregar</a>
</div>
	
<div data-role="content">	

<ul  id="comercios_list" data-inset="true" data-role="listview" data-split-theme="d" data-split-icon="delete"></ul>

<div id="comercios_list_status"></div>
 

<div data-role="popup" id="delete_comercio_popup" data-overlay-theme="a" data-theme="c" style="max-width:400px;" class="ui-corner-all">
    <div data-role="header" data-theme="a" class="ui-corner-top">
        <h1>¿Borrar Comercio?</h1>
    </div>
    <div data-role="content" data-theme="d" class="ui-corner-bottom ui-content">
        <h3 class="ui-title">¿Está seguro de querer eliminar de la base de datos el comercio?</h3>
        <p>Esta acción no se puede deshacer</p>
        <a id="cancel_delete_comercio_button" data-role="button" data-inline="true" data-theme="c">Cancel</a>    
        <a id="confirm_delete_comercio_button" data-role="button" data-inline="true" data-transition="flow" data-theme="b">Delete</a>  
    </div>
</div>

<!--<div id="confirmation_delete_comercio_popup" data-role="popup">
<ul data-role="listview" data-inset="true">
	<li data-role="list-divider">Estado...</li>
    <li>
    <p>Comercio eliminado correctamente</p>
	</li>
</ul>
</div>-->

</div>  
</div>
</body>
</html>
<?php
}
?>