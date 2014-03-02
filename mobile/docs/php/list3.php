<?php
//session_start(); 
include '../../config/db_connect.php';
include '../../lib/functions.php';

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
<script src="../../js/generateList.js"></script>
</head> 

<body>
<script>
console.log("script index antes ready");
$(document).ready(function(){
var moviesInfoFile = "../../movie-details-with-video.json";

$.getJSON(moviesInfoFile, function(movies){
   
   $('#placeholder').empty();
   
   $.each(movies, function(i, movie){
	   $('#placeholder').append(generarLista(movie));
   });
   
	$('#placeholder').listview('refresh');
	console.log("script index despues de refresh");
	
 });
});
</script>
<div data-role="page" id="page">
	<div data-role="header">
		<h1>Página uno</h1>
        <a href="page2.php" data-role="button">a pagina2</a>       
	</div>
	<div data-role="content">	
		<ul data-role="listview" data-split-icon="delete">
			<li>entrada 1</li>
            <li>entrada 2</li>
        </ul>
        
        
        <ul  id="placeholder" data-inset="true" data-role="listview"></ul> 
        
          <?php
		echo ("el user id es:".$_SESSION['user_id']);
		echo("el user name es:".$_SESSION['username']);
		echo("el login_string es:".$_SESSION['login_string']);
		?>
<script>
console.log("script ejecutado list");
</script>      
        		
	</div>
	<div data-role="footer">
		<h4>Pie de página</h4>
	</div>
</div>
</body>
</html>