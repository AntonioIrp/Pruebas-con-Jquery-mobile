$(document).ready(function(){
		$("body").css("-webkit-user-select","none");
		$("body").css("-moz-user-select","none");
		$("body").css("-ms-user-select","none");
		$("body").css("-o-user-select","none");
		$("body").css("user-select","none");
		});
		

function get_productos(){ 
	  $.ajax({
		  type:"POST",
		  url:"../lib/get_productos.php",
		  cache:false,
		  //data: data,
		  success: getProductosSuccess,
		  error: getProductosError
		  });	
}

function getProductosSuccess(response, status){
	if(response=="false"){
		$("#productos_list_status").html("No se han encontrado productos");
	}else{
		//$("#productos_list_status").html(response);
		var json_obj = jQuery.parseJSON(response);
	
		$("#productos_list").empty();
	
		$.each(json_obj, function(i, json_list){
			$("#productos_list").append(generarListaProductos(json_list));	
		});
		
		$("#productos_list").listview('refresh');
	}
}

function getProductosError(response, status){
	$("#productos_list_status").html("Error")
}