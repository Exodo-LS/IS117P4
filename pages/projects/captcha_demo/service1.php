<?php
session_set_cookie_params( 0, "/~ma2298/download/Assignment_2/");
session_start();
include ("accounts.php");
$db = mysqli_connect($hostname, $username, $password, $project);
if( ! isset ($_SESSION["logged"]) )//Gateway Code checks if it is still logged in
{
	if( ! isset($_SESSION["pinpass"]) )//Then it checks if the pinpass condition is true
	{
		echo "<br>Login Failed ... Directing User Back To Previous Form<br>";
		header("refresh: 2; url = pin1.php");
		exit();
	}
}
echo "<br>Admitted Securely<br>";
?>

<meta charset="utf-8">
<style>

	#number, #amount, #account {display: none;}
	form{margin: auto; width: 300px; border: 2px dashed blue; padding: 20px;}
</style>
<form action = "service2.php">
	<div>
		<input type="radio" id="List" name="choice" value="List">
		<label for="List">List</label><br>
	</div>
	<div>
		<input type="radio" id="Perform" name="choice" value="Perform">
		<label for="Perform">Perform</label><br>
	</div>	
	<div>
		<input type="radio" id="Clear" name="choice" value="Clear">
		<label for="Clear">Clear</label>
	</div>
	<div id="number">		<input 	type="text" 	name="number" 		autocomplete = "off">Enter number <br><br></div>
	<div id="amount">		<input 	type="text" 	name="amount" 		autocomplete = "off">Enter amount <br><br></div>
	<div id="account">		<input 	type="text" 	name="account" 		autocomplete = "off">Enter account <br><br></div>
	<input type = "submit">
</form>
<script>
var v = ""
var ptrChoice1 = document.getElementById("List")
var ptrChoice2 = document.getElementById("Perform")
var ptrChoice3 = document.getElementById("Clear")
ptrChoice1.addEventListener( "change" , F )
ptrChoice2.addEventListener( "change" , F )
ptrChoice3.addEventListener( "change" , F )

var ptrNumber 	= 	document.getElementById("number")
var ptrAmount 	= 	document.getElementById("amount")
var ptrAccount 	= 	document.getElementById("account")


function F( )
{
	ptrNumber.style.display="none"
	ptrAmount.style.display="none"
	ptrAccount.style.display="none"
	
	if (this.value == "List")  {ptrNumber.style.display = "block"}
	if (this.value == "Perform")  {ptrAccount.style.display = "block";
									ptrAmount.style.display = "block";}
	if (this.value == "Clear")  {ptrAccount.style.display = "block"}
	
}

</script>