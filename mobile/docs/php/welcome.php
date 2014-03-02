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
<div id="welcome_page" data-role="page" data-theme="b">
	<div data-role="header" data-theme="y">
        <a id="logout_button" data-icon="arrow-l" data-role="button" data-theme="b">Cerrar Sesión</a>
	</div>
       
	<div data-role="content">
	  	
        <br><h3>Seleccione una opcióncio:</h3><br>
      
      	<ul data-role="listview" data-theme="c">
        	<li>dlksjf</li>
        </ul>
        
        <ul  id="listadito" data-inset="true" data-role="listview"></ul>
        

             	

    </div>   
	<div data-role="footer" data-theme="b" data-position="fixed">
		<h4>Pie de página</h4>
	</div>
</div>
</body>
</html>


<script>
$(document).ready(function(e) {
			
	var user_id=<?php echo($_SESSION['user_id']); ?>;
	
	var data={
		id_usuario: user_id
	};
	
	$.ajax({
		type:"POST",
		url:"../lib/get_comercios.php",
		cache:false,
		data: data,
		success: getComerciosSuccess,
		error: getComerciosError
		});	
});

function getComerciosSuccess(response, status){
	
	var json_obj = jQuery.parseJSON(response);
	
	$("#listadito").empty();
	
	$.each(json_obj, function(i, movie){
		$("#listadito").append(generarLista(movie));	
	});
		
	$("#listadito").listview('refresh');
}

function getComerciosError(response, status){

}
</script> 

<?php
}
?>
