<?php
session_set_cookie_params( 0, "/~ma2298/download/Assignment_2/");
session_start();

error_reporting(E_ERROR | E_WARNING| E_PARSE | E_NOTICE);
ini_set('display_errors' , 1);

include ("accounts.php");
include ("myfunctionsV2.php");
$db = mysqli_connect($hostname, $username, $password, $project);

if( ! isset ($_SESSION["captchapass"]) )//Gateway Code
{
	echo "<br>Login Failed ... Directing User Back To Previous Form<br>";
	header("refresh: 2; url = captcha.html");
	exit();
}
echo "<br>Admitted Securely<br>";

if( isset ($_GET["ucid"]) )
{
	$flag = true;
	$ucid = safe("ucid");
	$pass = safe("pass");
	$amount = safe("amount");
	$delay = safe("delay");
	if ($flag == true)
	{
		if ( ! authenticate ($ucid, $pass))//Checks if the ucid and pass match to database
		{
			echo "<br>Invalid Credentials. Try again.<br>";
		}
		else
		{
			echo "<br>Valid Credentials.<br>";
			$_SESSION ["logged"] = true;
			$_SESSION ["ucid"] = $ucid;//Stores the ucid
			header ("refresh: $delay ; url = pin1.php");//Redirects to the next if true
			exit();
		}
	}
	else
	{
		echo "<br>Regex Rules Violated!! Try again.<br>";
	}
}

mysqli_close($db);
?>

<form action= "authForm.php">
	<p> UCID: </p>
	<br>
	<input type = text name = "ucid"  autocomplete = off value = ""> 
	<br>
	<p> Password: </p>
	<br>
	<input type = text name = "pass"  autocomplete = off value = ""> 
	<br>
	<p> Amount: </p>
	<br>
	<input type = text name = "amount"  autocomplete = off value = ""> 
	<br>
	<p> Delay: </p>
	<br>
	<input type="text" name="delay" autocomplete = "off">
	<br>
	<input type = submit>
</form>