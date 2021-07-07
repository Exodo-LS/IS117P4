<?php
function authenticate ($ucid, $pass)
{
  global $db;
  $s = "select * from Users where ucid = '$ucid'";//This gets the actual ucid
  echo "SQL insert statement is: $s<br>";//Prints out the data from Users
  ($t = mysqli_query( $db, $s)) or die (mysqli_error($db));
  $r = mysqli_fetch_array($t, MYSQLI_ASSOC);
  $hash = $r["Hash"];
  if (password_verify($pass, $hash))
  {
	  echo "<br>Password is Valid!<br>";
	  return true;
  }
  else
  {
	  echo "<br>Invalid Password.<br>";
	  return false;
  }
}

function safe ($fieldname)
{
	global $flag;
	
	$temp = $_GET[$fieldname];
	$temp = trim($temp);
	echo "<br>$fieldname is $temp<br>";
	
	if ($fieldname == "ucid")
	{
		$count1 = preg_match( '/(^[a-z]{3,4}|\0)$/i',$temp, $matches);
		if ($count1 == 0)
		{
			$flag = false;
			return "Illegal ucid format.";
		}
	}
	if ($fieldname == "amount")
	{
		$count2 = preg_match('/^(\S)?(0{0,3}|[1-9]\d*)(\.\d{1,2}+)?/i',$temp, $matches);
		if ($count2 == 0)
		{
			$flag = false;
			return "Illegal amount format.";
		}
	}
	if ($fieldname == "pass")
	{
		$count3 = preg_match('/(^[0-9]{1,3}|\0)$/i', $temp, $matches);
		if ($count3 == 0)
		{
			$flag = false;
			return "Illegal password format.";
		}
	}
	
	return $temp;
}
function retrieve ($ucid, $number)
{
	global $db;
	$retrieved = "select account, balance, timestamp  from Transactions where ucid = '$ucid'";
	if ($result = mysqli_query($db, $retrieved)) 
	{
		$num = mysqli_num_rows($result); //Get the actual number of retrieved rws
		echo  "$num - rows retrieved from Transactions.<br>";
		if ($num > 0) // Only display transaction if there are rows retrieved
		{ 
			echo "<br>Transactions for $ucid are as follows.<br>";
			$RowNo = 0; // Get a counter to display the desired number of records
			while (($r = mysqli_fetch_array ( $result, MYSQL_BOTH)) and $RowNo < $number) 
			{
				echo "<br>----------------------------<br>";
				$account = $r["account"];
				$amount = $r["balance"];
				$timestamp = $r["timestamp"];
				echo "<br>Account: $account<br>";
				echo "<br>Amount: $amount<br>";
				echo "<br>Timestamp: $timestamp<br>";
				$RowNo = $RowNo + 1;
			}	
			echo "<br>----------------------------<br>";
			mysql_free_result($result);	
		}
	}
	else // In case of error, display 0 rows retrieved and end
	{
		echo "0 rows retrieved from Transactions.";
		die(mysqli_error($db));
	}
}
function transact ($ucid, $account, $amount)
{
	global $db;
	$mail = "N";//The mail value for Transactions
	$transacted = "insert into Transactions values('$ucid', '$account', '$amount', NOW(), '$mail') where Balance + $amount >= 0.00";//This grabs the data from service2 and inputs it into Transactions
	mysqli_query($db, $transacted) or die (mysqli_error($db));
	echo "<br> SQL update: $transacted";//Displays the action is completed
	$updated= "update Accounts set Balance = Balance + '$amount', Recent = NOW() where UCID = '$ucid' and Account = '$account' and Balance + $amount >= 0.00";//Updates Accounts with data grabbed from service2 also checks for overdraft
	mysqli_query($db, $updated) or die (mysqli_error($db));
	echo "<br> SQL update: $updated";//Displays the action is completed
}
function clear ($ucid, $account)
{
	global $db;
	$clearedTimestamp = "0000-01-01 00:00:01";// The set timestamp
	$cleared = "delete from Transactions where UCID = '$ucid' and Account = '$account'";//Deletes the data from
	mysqli_query($db, $cleared) or die(mysqli_error($db));
	echo "<br>SQL Update is : $cleared<br>";//Displays the delete action is completed
	$updated = "update Accounts set Balance = 0.00, Recent = '$clearedTimestamp' where UCID = '$ucid' and Account = '$account'";//Sets the data in Accounts based on the inputs
	mysqli_query($db, $updated) or die(mysqli_error($db));
	echo "<br>SQL Update Statement is : $updated<br>";//Displays the data in Accounts is updated
}
?>	