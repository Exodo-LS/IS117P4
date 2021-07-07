<?php
session_set_cookie_params( 0, "/~ma2298/download/Assignment_2/");
session_start();

include ("accounts.php");//The functions called her are located in that file
include ("myfunctionsV2.php");

$db = mysqli_connect($hostname, $username, $password, $project);
if( ! isset ($_SESSION["logged"]) )//Gateway code checks if the user is still logged in and the pinpass is true
{
	if( ! isset($_SESSION["pinpass"]) )
	{
		echo "<br>Login Failed ... Directing User Back To Previous Form<br>";
		header("refresh: 2; url = pin1.php");
		exit();
	}
}

echo "<br>Admitted Securely<br>";

$choice = safe("choice"); //Safe will check the choice
$ucid = $_SESSION["ucid"];//Grabs the stored ucid

if ($choice == "List")//If the user selects list
{
	$number = safe("number");// Safe grabs and checks the number the user inputted
	retrieve($ucid, $number);//The retrieve function
}
if ($choice == "Perform")// if the user selects perform
{
	$amount = safe("amount");// Safe grabs and checks the amount the user inputted
	$account = safe("account");// Safe grabs and checks the account the user inputted
	transact ($ucid, $account, $amount);//The transact function
}
if ($choice == "Clear")//If the user selects clear
{
	$account = safe("account");// Safe grabs and checks the account the user inputted
	clear ($ucid, $account);//The clear function
}//I added the logout script as a hyperlink
?>
<a href = "logout.php" > Logout </a> 