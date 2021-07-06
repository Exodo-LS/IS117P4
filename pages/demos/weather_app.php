<?php
$z   = $_GET["zip"];
$c   = $_GET["cc"];
$lat = $_GET["lat"];
$lon = $_GET["lon"];
$choice = $_GET["choice"];

sleep (2);
if ($lat != '' && $lon != '')
{
	if ($choice == "ow")
		{
			$url = "http://api.openweathermap.org/data/2.5/weather?lon=$lon&lat=$lat&units=metric&appid=6a5bb6615b21cc49bb760c68b9c4da30";
		}
	else
		{
			$url = "https://api.weatherbit.io/v2.0/current?lat=$lat&lon=$lon&key=74b0d9b301a64564aebc97086dfd05cc";
		}
}
if( $z != '' && $c != '')
{
	$country = preg_match("/^[a-zA-Z]{2}?$/i", $c, $matches);
	if ($country != 0)
	{
		$count = preg_match("/^[0-9]{5}?$/i", $z, $matches);
		if ($count != 0)
		{
			if ($choice == "ow")
			{
				$url = "http://api.openweathermap.org/data/2.5/weather?zip=$z,$c&units=metric&appid=6a5bb6615b21cc49bb760c68b9c4da30";
			}
			else
			{
				$url = "https://api.weatherbit.io/v2.0/current?postal_code=$z&country=$c&key=74b0d9b301a64564aebc97086dfd05cc";
			}
		}
		else
		{
			$foreign = preg_match("/^[a-zA-z]{1}[0-9]{1}[a-zA-z]{1}?$/i", $z, $matches);
			if ($foreign != 0)
			{
				if ($choice == "ow")
				{
					$url = "http://api.openweathermap.org/data/2.5/weather?zip=$z,$c&units=metric&appid=6a5bb6615b21cc49bb760c68b9c4da30";
				}
				else
				{
					$url = "https://api.weatherbit.io/v2.0/current?postal_code=$z&country=$c&key=74b0d9b301a64564aebc97086dfd05cc";
				}
			}
			else
			{
				trigger_error("Invalid Zip Format/Country, Please Check Zip/Country Codes", E_USER_ERROR);
				return;
			}
		}
	}
	else
	{
		trigger_error("Invalid Zip Format/Country, Please Check Zip/Country Codes", E_USER_ERROR);
		return;
	}
}
$fp = fopen($url,"r");
$contents = "";
while ($more = fread ($fp, 1000))
{
  $contents .= $more;
}
echo $contents;
?>

