<?php
session_start();
include "../../config/db_connect.php";
include "../../lib/functions.php";

if(db_connection()){
	echo("FALLO AL CONECTAR");
}else if(login_check($mysqli) == false) 
{ 
	include "../sinpermisos.php";	
} 
else 
{
?>
<!doctype html> 
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1,
user-scalable=no"/>
<title>Aplic. Web de jQuery Mobile</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
<script type="text/javascript" src="../../js/generateList.js"></script>
</head> 


<body>

<div data-role="page" id="page65" data-theme="b">
	<div data-role="header" data-theme="y">
        <a id="Logout_button" data-icon="arrow-l" data-role="button" data-theme="b">Cerrar Sesión</a>
	</div>
       
	<div data-role="content">
	  	
        <br><h3>Seleccione una opción:</h3><br>
      
      	<ul data-role="listview" data-theme="c">
        	<li>dlksjf</li>
        </ul>       	

<script>
$(document).ready(function(e) {

function Exito(response, status){
	$.mobile.changePage("../../index.html", 'pop');
}

function Error(){

}
	$("#Logout_button").click(function(e) {
        $.ajax({
				type: "POST",
				url: "../../lib/logout.php",
				cache: false,
				//data: data,
				success: Exito,
				error: Error
			});
    });
	
	
});
</script>  
    </div>   
	<div data-role="footer" data-theme="b" data-position="fixed">
		<h4>Pie de página</h4>
	</div>
</div>
</body>
</html>
<?php
}
?>