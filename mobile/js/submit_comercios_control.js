$("#comercio_submit_button").click(function(e) {
       	var nombre, descripcion=null;
		
		nombre=$.trim($("#nombre_comercio_text_field").val().toString()); 
		descripcion=$.trim($("#descripción_comercio_text_field").val().toString());
		if(nombre===""){
			$("#confirmation_submit_comercio_popup").popup({ history: false });
			$("#confirmation_submit_comercio_popup").popup("open");
			$("#submit_comercio_status").html("El nombre no puede estar vacio");
		}else if(descripcion===""){
			$("#confirmation_submit_comercio_popup").popup({ history: false });
			$("#confirmation_submit_comercio_popup").popup("open");
			$("#submit_comercio_status").html("La descripcion no puede estar vacia");
		}else{
			var data={
				nombre: nombre,
				descripcion: descripcion
				};
			
			$.ajax({
			type:"POST",
			url:"../lib/set_comercios.php",
			cache:false,
			data: data,
			success: submitComerciosSuccess,
			error: submitComerciosError
			});
			
		}
		nombre=descripcion=null;
});

function submitPhotoSuccess(){
$.mobile.changePage('../docs/welcome.php');
}

function submitComerciosSuccess(response, status){
	$("#comercio_submit_form_fields").each(function()
	{
    	this.reset();
	});
	
	$("#photo_form").ajaxForm({target: "#status_form", success: submitPhotoSuccess }).submit();
	
	$("#confirmation_submit_comercio_popup").popup({ history: false });
	$("#confirmation_submit_comercio_popup").popup("open");
	$("#submit_comercio_status").html(response);
}

function submitComerciosError(response, status){
	$("#comercio_submit_status").html("Error");
}
