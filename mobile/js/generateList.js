function generarListaComercios(json_list,i)
{	
	var listaHtml="<li id='"+json_list.identificador+"'>"; 
	listaHtml+="<img src=../../db_comercios_images/"+json_list.identificador+".jpg />";
	listaHtml+="<h2>"+json_list.nombre+"</h2>";
	listaHtml+="<p>"+json_list.descripcion+"</p>"; 
	listaHtml+="</li>";	  
	
	return listaHtml;
}


function generarListaProductos(json_list,i)
{	
	var listaHtml="<li id='"+json_list.identificador+"'>"; 
	//listaHtml+="<a href=''>";
	listaHtml+="<img src=../../db_productos_images/"+json_list.identificador+".jpg/>";
	listaHtml+="<h2>"+json_list.nombre+"</h2>";
	listaHtml+="<p>"+json_list.descripcion+"</p>";
	//listaHtml+="</a>";
	listaHtml+="</li>";
	
	return listaHtml;
}