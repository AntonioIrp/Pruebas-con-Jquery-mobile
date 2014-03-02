<?php
include '../config/db_connect.php';

session_start();

$id_comercio=trim($_GET["idcomercio"]);

$select_query="SELECT foto_comercio as foto FROM comercios WHERE id_comercio= ?";

if(db_connection()){
	echo("FALLO AL CONECTAR");
}else{
	if($stmt=$mysqli->prepare($select_query)){
		$stmt->bind_param("s", $id_comercio);
		$stmt->execute();
		$stmt->store_result();
		$fotografia=array();
		$stmt->bind_result($fotografia);
		$stmt->fetch();
		
		
		header("Content-type: image/jpeg"); 
		echo($fotografia);


	}else{
		echo("algun tipo de error");
	}
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