<?php
include 'check_brute_force.php';

//INICIO DE SESION SEGURO PHP
function sec_session_start() 
{
        $session_name = 'sec_session_id'; // Set a custom session name
        $secure = false; // Set to true if using https.
        $httponly = true; // This stops javascript being able to access the session id. 
		
        ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies. 
        $cookieParams = session_get_cookie_params(); // Gets current cookies params.
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], 				$cookieParams["domain"], $secure, $httponly); 
        session_name($session_name); // Sets the session name to the one set above.
        
		//// Extend cookie life time by an amount of your liking
//		$cookieLifetime = 365 * 24 * 60 * 60; // A year in seconds
//		setcookie(session_name(),session_id(),time()+$cookieLifetime);
		
		session_start(); // Start the php session
        session_regenerate_id(true); // regenerated the session, delete the old one.   
}


//FUNCION DE LOGIN
function login($email, $password, $mysqli) 
{
	global $accoun_blocked;
	global $login_successful;
	global $login_error;
	
	$account_blocked=("cuenta bloqueada");
	$login_successful=("true");
	$login_error=("Error de acceso");
	
	if ($stmt = $mysqli->prepare("SELECT id, username, password, salt FROM members WHERE email = ? LIMIT 1")) 
	{ 
		$stmt->bind_param('s', $email); 
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($user_id, $username, $db_password, $salt); 
		$stmt->fetch();
		$password = hash('sha512', $password.$salt); 
		
		if($stmt->num_rows == 1)
		{         
			if(checkbrute($user_id, $mysqli)==TRUE)
			{
				return $account_blocked;
			}	
			else
			{
				if($db_password == $password)
				{ 
					$user_browser = $_SERVER['HTTP_USER_AGENT']; 
					// XSS protection as we might print this value 
					$user_id = preg_replace("/[^0-9]+/", "", $user_id); 
					$_SESSION['user_id'] = $user_id; 
					// XSS protection as we might print this value
					$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); 
					$_SESSION['username'] = $username;
					$_SESSION['login_string'] = hash('sha512', $password.$user_browser);
					// Login successful.
					return $login_successful;	
				}
				else
				{
					$now = time();
					$mysqli->query("INSERT INTO login_attempts (user_id, time) VALUES ('$user_id', '$now')");
					return $login_error;
				}
			}
		}
		else
		{
			return $login_error;
		}
	}
	else
	{
			return $login_error;
	}
}


//LOGIN CHECK STATUS
function login_check($mysqli) {
   // Check if all session variables are set
   if(isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
     $user_id = $_SESSION['user_id'];
     $login_string = $_SESSION['login_string'];
     $username = $_SESSION['username'];
 
     $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
 
     if ($stmt = $mysqli->prepare("SELECT password FROM members WHERE id = ? LIMIT 1")) { 
        $stmt->bind_param('i', $user_id); // Bind "$user_id" to parameter.
        $stmt->execute(); // Execute the prepared query.
        $stmt->store_result();
 
        if($stmt->num_rows == 1) { // If the user exists
           $stmt->bind_result($password); // get variables from result.
           $stmt->fetch();
           $login_check = hash('sha512', $password.$user_browser);
           if($login_check == $login_string) {
              // Logged In!!!!
              return true;
           } else {
              // Not logged in
              return false;
           }
        } else {
            // Not logged in
            return false;
        }
     } else {
        // Not logged in
        return false;
     }
   } else {
     // Not logged in
     return false;
   }
}

?>