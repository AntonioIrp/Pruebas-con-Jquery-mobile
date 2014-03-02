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
<!DOCTYPE html> 
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

<div data-role="page" id="page32">
	<div data-role="header">
		<h1>listado list.html</h1>
        <a href="welcome.php" data-role="button">volver a welcome</a>       	<!--<a href="../../lib/logout.php" data-role="button">Logout</a>-->
        <input type="button" id="logout" value="logouto">
        <a href="../../index.php" data-role="button">inicio</a>
	</div>
	<div data-role="content">	
		<ul data-role="listview" data-split-icon="delete">
			<li>entrada 1</li>
            <li>entrada 2</li>
                 <?php
		echo ("el user id es:".$_SESSION['user_id']);
		echo("el user name es:".$_SESSION['username']);
		echo("el login_string es:".$_SESSION['login_string']);
		?>
        </ul>
        
        
        <ul id="listadito" data-inset="true" data-role="listview"></ul> 
<script>
console.log("comienzo del listado");
function Exito(response, status){
	response=$.trim(response);
	if(response=="loggedout")
	{
		$.mobile.changePage('../../index.html', 'pop');
	}
}
function Error(response, status){

}

$(document).ready(function(){
	var moviesInfoFile = "../../movie-details-with-video.json";
	$("#logout").click(function(e) {
    	$.ajax({
				type: "POST",
				url: "../../lib/logout.php",
				cache: false,
				//data: data,
				success: Exito,
				error: Error
			});  
    });
	
	
	$.getJSON(moviesInfoFile, function(movies)
	{
		$("#listadito").empty();

		$.each(movies, function(i, movie)
		{
   			$("#listadito").append(generarLista(movie));
   
		});
		
		$("#listadito").listview('refresh');	
	});
});
</script>   
	</div>
	<div data-role="footer">
		<h4>Pie de página</h4>
	</div>
</div>
</body>
</html>
<?php
}
?>

           		
