<?php
session_start();
include "../config/db_connect.php";
include "../lib/functions.php";

$identificador_comercio=trim($_GET['idcomercio']);
$_SESSION['selected_id_comercio']=$identificador_comercio;

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
</head> 

<body> 
<div data-role="page" id="productos_page">
<script type="text/javascript" src="../js/productos_control.js"></script>
<script type="text/javascript" src="../js/generateList.js"></script>

<script>
$.mobile.ignoreContentEnabled = true;
get_productos();
</script>


<div data-role="header" data-theme="b">
  <h1></h1>
  <a href="welcome.php" id="productos_back_button" data-icon="arrow-l" data-role="button" data-theme="b">Atras</a>
 <!-- <a href="submit_comercio.php" id="agregar_comercio_button" data-icon="plus" data-iconpos="right" data-role="button" data-theme="b">Agregar</a>-->
</div>
	
<div data-role="content">	
  <ul  id="productos_list" data-inset="true" data-role="listview"></ul>
  <div id="productos_list_status"></div>	
</div>


    
</div>
</body>
</html>
<?php
}
?>