<?php
session_set_cookie_params( 0, "/~ma2298/download/Assignment_2/");
session_start();//Session is started again
include ("accounts.php");
include ("myfunctionsV2.php");
$db = mysqli_connect($hostname, $username, $password, $project);

if( ! isset ($_SESSION["logged"]) )//The Gateway Code
{
	echo "<br>Login Failed ... Directing User Back To Previous Form<br>";
	header("refresh: 2; url = authForm.php");
	exit();
}
echo "<br>Admitted Securely<br>";

$sessionPin = $_SESSION["pin"];//Grabs the Session's pin
$safePin = safe("pin");// Grabs the pin after it is checked by safe

if ($sessionPin != $safePin )//Checks the two pins if they are the same
{
	echo "<br>Invalid Pin.<br>";
	header ("refresh: 2  ; url = pin1.php");//Redirects the user back
	exit();
}
else
{
	echo "<br>Valid Pin.<br>";
	$_SESSION ["logged"] = true;
	$_SESSION ["pinpass"] = true;//New true condition
	header ("refresh: 2 ; url = service1.php");//Sends the user to the next page
	exit();
}
?>