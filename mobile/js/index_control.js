$(document).ready(function(e) {
	var clicked=false;
	
    $("#informacion_index_button").click(function(e) {
		$("#informacion_popup").popup("open");
    });
	$("#acerca_de_index_button").click(function(e) {
		$("#acerca_de_popup").popup("open");
    });
	$("#proseguir_sesion_index_button").click(function(e) {
        $.mobile.changePage("docs/welcome.php", 'flow');
    });
	
	$("#submit_form_button").click(function(e) {
		if(clicked === false) {
        	$(this).addClass('ui-disabled');
        	clicked = true;
        	//alert('Button is now disabled');
    	}
		 
        var pass,v_pass,pass_cyph,v_pass_cyph,data;
		$("#register_popup").popup("open");
		pass=$.trim($("#signup_password_text_field").val().toString());
		v_pass=$.trim($("#signup_vpassword_text_field").val().toString());
		
		if(pass===""){
			var empty_pass="No se permiten contraseñas vacias";
			signupSuccess(empty_pass, null);
			clicked=false;
			$("#submit_form_button").removeClass('ui-disabled');		
		}else if(v_pass===""){
			var empty_vpassword="Verifique su contraseña";
			signupSuccess(empty_vpassword,null);
			clicked=false;
			$("#submit_form_button").removeClass('ui-disabled');
		}else{
			//comienza el hash de las contraseñas
			var shaObj_pass = new jsSHA(pass, "TEXT");
			pass_cyph = shaObj_pass.getHash("SHA-256", "HEX");
			var shaObj_v_pass = new jsSHA(v_pass, "TEXT");
			v_pass_cyph = shaObj_v_pass.getHash("SHA-256", "HEX");
			//hash completado
			
			//preparar los datos POST
			data=
			{
				username: $("#signup_username_text_field").val(),
				email: $("#signup_email_text_field").val(),
				password: pass_cyph,
				v_password: v_pass_cyph
			}
			//Petición Ajax
			$.ajax({
				type: "POST",
				url: "lib/register.php",
				cache: false,
				data: data,
				success: signupSuccess,
				error: signupError
			});
			//Limpiar las variables
			pass=v_pass=pass_cyph=v_pass_cyph=data=null;
			clicked=false;
			$("#submit_form_button").removeClass('ui-disabled');
			return false;
		}
	});
	
	$("#login_submit_button").click(function(){	
		var email, pass, pass_cyph;
		
		if(clicked === false) {
       		$(this).addClass('ui-disabled');
        	clicked = true;
        	//alert('Button is now disabled');
    	} 
		
		email=$.trim($("#login_email_text_field").val().toString());
		pass=$.trim($("#login_password_text_field").val().toString());
		
		if(email === ""){
			var empty_email="Especifique su E-mail";
			$("#login_popup").popup("open");
			$("#login_message_error").html(empty_email);
			clicked=false;
			$("#login_submit_button").removeClass('ui-disabled');		
		}else if(pass === ""){
			var empty_pass="Verifique su contraseña";
			$("#login_popup").popup("open");
			$("#login_message_error").html(empty_pass);
			clicked=false;
			$("#login_submit_button").removeClass('ui-disabled');	
		}else{
			//comienza el hash de las contraseñas
			var shaObj_pass = new jsSHA(pass, "TEXT");
			pass_cyph = shaObj_pass.getHash("SHA-256", "HEX");
			//hash completado
	
			//preparar los datos POST
			var data=
			{
				email: $("#login_email_text_field").val(),
				password: pass_cyph
			}
			//Petición Ajax
			$.ajax({
				type: "POST",
				url: "lib/process_login.php",
				cache: false,
				data: data,
				success: loginSuccess,
				error: loginError
			});
			//Limpiar las variables
			pass=email=pass_cyph=data=null;
			clicked=false;
			$("#login_submit_button").removeClass('ui-disabled');	
			return false;
		}
	});
});


function signupSuccess(response, status)
{
	response = $.trim(response);
	$("#signup_form_fields").each(function()
	{
    	this.reset();
	});
	$("#message").html(response);
	
	window.setTimeout(function() 
		{
			$("#register_popup").popup("close");
			$("#message").text("");
		}, 3000);	
}
  
function signupError(retorno, status)
{
	var ajax_error="Error Ajax";
	$("#message").text(ajax_error);
}  

function loginSuccess(response, status){
	if(response=="true")
	{
		$("#login_form_fields").each(function()
		{
			this.reset();
		});
		$.mobile.changePage('docs/welcome.php', { transition: "slide", changeHash: true});
	}
	else
	{
		response = $.trim(response);
		$("#login_form_fields").each(function()
		{
			this.reset();
		});
		$("#login_popup").popup("open");
		$("#login_message_error").html(response);	
	}
}

function loginError(response, status){
	$("#login_status").html("Error");
}