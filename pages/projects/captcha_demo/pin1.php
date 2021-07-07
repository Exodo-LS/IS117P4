<?php
session_set_cookie_params( 0, "/~ma2298/download/Assignment_2/");
session_start();//Session is started in next page
include ("accounts.php");
$db = mysqli_connect($hostname, $username, $password, $project);
if( ! isset ($_SESSION["logged"]) )//Gateway Code
{
	echo "<br>Login Failed ... Directing User Back To Previous Form<br>";
	header("refresh: 2; url = authForm.php");
	exit();
}
echo "<br>Admitted Securely<br>";
//pin handling
$pin = mt_rand(1000 , 9999);//Pin is generated
echo "<br>Your pin is: $pin";//The pin is echoed
$_SESSION["pin"] = $pin;//Pin is stored
$subject = "Enter Pin In The Form";
$to = "ma2298@njit.edu";
mail ($to, $subject, $pin);//Pin is emailed to my email
?>


<form action ="pin2.php">
<input type = "text" name = "pin" autocomplete = "off"> Enter Pin <br>
<input type = "submit">
</form>