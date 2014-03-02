//$(document).ready(function(){
//	});

$("body").css("-webkit-user-select","none");
$("body").css("-moz-user-select","none");
$("body").css("-ms-user-select","none");
$("body").css("-o-user-select","none");
$("body").css("user-select","none");
$.mobile.ignoreContentEnabled = true;

var id_comercio;  

$(document).ready(function(e) {

	$("#logout_button").click(function(e) {
    	$.ajax({
			type:"POST",
			url:"../lib/logout.php",
			cache:false,
			success: logoutSuccess,
			error: logoutError
			});			
	});
	
	
    $("ul").on('taphold', 'li', function() {
		var idcomercio = this.id;
		id_comercio=idcomercio;        
		$("#delete_comercio_popup").popup("open");
    });
	
	$("#confirm_delete_comercio_button").click(function(e) {
		var data={idcomercio: id_comercio}
			 
		 $.ajax({
				type:"POST",
				url:"../lib/delete_comercios.php",
				cache:false,
				data: data,
				success: deleteComercioSuccess,
				error: logoutError
			});	
    });
	
	$("#cancel_delete_comercio_button").click(function(e) {
        $("#delete_comercio_popup").popup("close");
    });
		
});		
	

function get_comercios(){ 
	  $.ajax({
		  type:"POST",
		  url:"../lib/get_comercios.php",
		  cache:false,
		  success: getComerciosSuccess,
		  error: getComerciosError
		  });	
}

function getComerciosSuccess(response, status){
	if(response=="false"){
		$("#comercios_list_status").html("No se han encontrado comercios");
	}else{
		var json_obj = jQuery.parseJSON(response);
	
		$("#comercios_list").empty();
	
		$.each(json_obj, function(i, json_list){
			$("#comercios_list").append(generarListaComercios(json_list));	
		});
		
		$("#comercios_list").listview('refresh');
	}
}

function getComerciosError(response, status){
	$("#comercios_list_status").html("Error")
}

function logoutSuccess(response, status){
	$.mobile.changePage('../index.php', 'slide');
}

function logoutError(response, status){
	$("#comercios_list_status").html("No se ha podido cerrar la sesión correctamente");
}
	
function deleteComercioSuccess(response, status){
	id="#"+id_comercio;
	$("#delete_comercio_popup").popup("close");
	$(id).remove();
	$("#comercios_list").listview("refresh");
}