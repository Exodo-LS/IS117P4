<?php
session_set_cookie_params( 0, "/~ma2298/download/Assignment_2/", "web.njit.edu");
session_start();

$sidvalue = session_id(); 
echo "<br>Your session id: " . $sidvalue . "<br>";

$_SESSION = array();		//Make $_SESSION  empty
session_destroy();			//Terminate session on server
setcookie("PHPSESSID", "", time()-3600, "/~ma2298/download/Assignment_2/", "", 0, 0); 

echo "Your session is terminated."; 

?>
