<?php
function checkbrute($user_id, $mysqli) 
{
  // Get timestamp of current time
  $now = time();
  // All login attempts are counted from the past 2 hours. 
  $valid_attempts = $now - (2 * 60 * 60); 
  $mysql_query=("SELECT time FROM login_attempts WHERE user_id = ? AND time > ?");
  
  	if ($stmt = $mysqli->prepare($mysql_query))
  	{ 
	  	$stmt->bind_param('ii', $user_id,$valid_attempts); 
	  	// Execute the prepared query.
	  	$stmt->execute();
	  	$stmt->store_result();
	  	// If there has been more than 5 failed logins
	 	if($stmt->num_rows > 5)
		{
			 return true;
	  	} 
	  	else 
	  	{
		 	return false;
	  	}
	}
}

?>