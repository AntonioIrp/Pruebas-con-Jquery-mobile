<?php
include '../config/db_connect.php';
include 'functions.php';
session_start();

//$id_comercio=$_SESSION['selected_id_comercio'];
$id_comercio=$_GET["selected_id_comercio"];

$select_query="SELECT id_producto as identificador, nombre_producto as nombre, descripcion_producto as descripcion FROM productos where id_comercio= ?";

if(db_connection()){
	echo("FALLO AL CONECTAR");
}//else if(login_check($mysqli) == false){
//	echo("ERROR DE SESION");
//}
else if($stmt=$mysqli->prepare($select_query)){
		$stmt->bind_param("s", $id_comercio);
		$stmt->execute();
	
		$array_res=fetch($stmt);
		
		$json=json_encode($array_res, true);
		$modificado_json="{'items':[" . $json . "]}";
		if($json=="[]"){
			echo("false");
		}else{
			echo($modificado_json);
		}
}else{
	echo("ERROR");
}

function fetch($result)
{    
     $array = array();
     
     if($result instanceof mysqli_stmt)
     {
         $result->store_result();
         
         $variables = array();
         $data = array();
         $meta = $result->result_metadata();
         
         while($field = $meta->fetch_field())
             $variables[] = &$data[$field->name]; // pass by reference
         
         call_user_func_array(array($result, 'bind_result'), $variables);
         
         $i=0;
         while($result->fetch())
         {
             $array[$i] = array();
             foreach($data as $k=>$v)
                 $array[$i][$k] = $v;
             $i++;
             
             // don't know why, but when I tried $array[] = $data, I got the same one result in all rows
         }
     }
     elseif($result instanceof mysqli_result)
     {
         while($row = $result->fetch_assoc())
             $array[] = $row;
     }
     
     return $array;
 }
?>