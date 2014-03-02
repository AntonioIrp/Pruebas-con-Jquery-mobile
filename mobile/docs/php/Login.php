<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1,
user-scalable=no"/>
<title>Login</title>

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css"/>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>

</head>
<body >
<div id="Login" data-role="page">
<link href="../../css/login_style.css" rel="stylesheet" type="text/css" media="screen">

<script>
function success(response, status){
	if(response=="true")
	{
		$.mobile.changePage('../protect/welcome.php', 'flow'); 
	}
	else
	{
		response = $.trim(response);
		$("#login_form").each(function()
		{
			this.reset();
		});
		$("#login_status").html(response);	
	}
}

function error(response, status){
	$("#login_status").html("Error");
}
       
$(document).ready(function() {
	$("#login_submit").click(function(){	
		var email, pass, pass_cyph;
		
		email=$.trim($("#login_email").val().toString());
		pass=$.trim($("#login_password").val().toString());
		
		if(email === ""){
			var empty_email="Especifique su E-mail";
			$("#login_status").html(empty_email);		
		}else if(pass === ""){
			var empty_pass="Verifique su contraseña";
			$("#login_status").html(empty_pass);
		}else{
			//comienza el hash de las contraseñas
			var shaObj_pass = new jsSHA(pass, "TEXT");
			pass_cyph = shaObj_pass.getHash("SHA-256", "HEX");
			//hash completado
	
			//preparar los datos POST
			var data=
			{
				email: $("#login_email").val(),
				password: pass_cyph
			}
			//Petición Ajax
			$.ajax({
				type: "POST",
				url: "../../lib/process_login.php",
				cache: false,
				data: data,
				success: success,
				error: error
			});
			//Limpiar las variables
			pass=email=pass_cyph=data=null;
			return false;
		}
	});
});
</script>

<div id="login_back_button"><a href="../../index.php" id="login_button" data-icon="back" data-role="button" data-theme="b" data-mini="false">Volver</a></div>

<h1><div id="login_status"></div></h1>

<form id="login_form">
<div id="login_email_field"><input type="text" name="login_email" id="login_email" value="" placeholder="e-Mail:" data-mini="true"/></div>
  
<div id="login_password_field"><input type="password" name="login_password" id="login_password" value="" placeholder="Contraseña:" data-mini="true"/></div>
</form>
<div id="login_submit_button">
<input type="submit" id="login_submit" value="Acceder" data-icon="edit" data-theme="b"/></div>

</div>
</body>
</html>
