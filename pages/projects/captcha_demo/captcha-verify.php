<?php
session_set_cookie_params( 0, "/~ma2298/download/Assignment_2/");
session_start();

error_reporting(E_ERROR | E_WARNING| E_PARSE | E_NOTICE);
ini_set('display_errors' , 1);

include ("accounts.php");
include ("myfunctionsV2.php");
$db = mysqli_connect($hostname, $username, $password, $project);

$guess = safe("guess");
$delay = safe("delay");
$captcha = $_SESSION["captcha"];


if ($captcha == $guess)
{
	echo "<br>The Captcha Guess Was Correct<br>";
	header("refresh: $delay ; url = authForm.php");
	$_SESSION ["captchapass"] = true;
	exit();
}
else
{
	echo "<br>The Captcha Guess Was Wrong<br>";
	header("refresh: $delay ; url = captcha.html");
	exit();
}
?>