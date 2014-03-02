<?php
include '../config/db_connect.php';
include 'functions.php';
session_start();

$identifier=$_SESSION['user_id'];
//$identifier=trim($_GET['usuario']);
//$identifier=7;

$select_query="SELECT nombre_comercio as nombre, descripcion_comercio as descripcion, id_comercio as identificador FROM comercios WHERE id_user= ?";

if(db_connection()){
	echo("FALLO AL CONECTAR");
}else if(login_check($mysqli) == false){
	echo("ERROR DE SESION");
}else if($stmt=$mysqli->prepare($select_query)){
		
		$stmt->bind_param("s", $identifier);
		$stmt->execute();
	
		$array_res=fetch($stmt);
		
		$json=json_encode($array_res, true);
		
		if($json=="[]"){
			echo("false");
		}else{
			echo($json);
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