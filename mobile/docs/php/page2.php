<?php
session_start();
include '../../config/db_connect.php';
include '../../lib/functions.php';
// Include database connection and functions here.
//sec_session_start();

if(db_connection()){
	echo("FALLO AL CONECTAR");
}else if(login_check($mysqli) == false) 
{ 
	include '../sinpermisos.php';
}
else 
{
?>	

<?php
}
?>