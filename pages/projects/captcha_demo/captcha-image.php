<?php
session_set_cookie_params( 0, "/pages/projects/demos/captcha_demo/");
session_start();

$font = 'Zillah Modern Expanded.ttf';
$info = 'FairfaxStation.ttf';

//----------------------------------------------------//Bonus 1 - Decoy Fonts
$df1 = 'Onyx BT.ttf';
$df2 = 'CafePop.ttf';
$df3 = 'Tonio.ttf';
//----------------------------------------------------

header ('Content-Type: image/png');

$im = imagecreatetruecolor (450, 300);

//----------------------------------------------------//Bonus 1 - Decoy Colors
$decoyGreen = imagecolorallocate ($im, 110, 229, 174);
$decoyBrown = imagecolorallocate($im, 108, 57, 10);
$decoyYellowish = imagecolorallocate ($im, 245, 206, 66);
//----------------------------------------------------

$blue = imagecolorallocate($im, 26, 50, 199);//background color
$border = imagecolorallocate($im, 255, 255, 255);
$fill = imagecolorallocate($im, 255, 0, 0);
$black = imagecolorallocate($im, 0, 0, 0);

//----------------------------------------------------
imagefilltoborder($im, 0, 0, $border, $fill);//Bonus 2
//----------------------------------------------------

imagefilledrectangle($im, 10, 10, 440, 290, $blue);

//----------------------------------------------------

$length = 2;

//----------------------------------------------------

$_SESSION["captcha"] = makeSendCaptcha($length, $font);
$captcha = $_SESSION["captcha"];
$id = session_id();

imagettftext($im, 15, 0, 10, 280, $black, $info, "Captcha: $captcha");
imagettftext($im, 15, 0, 10, 260, $black, $info, "Session ID: $id");

//----------------------------------------------------//Bonus 1 - Decoy Captcha
$dlength = 2;
$distractor1 = randomCaptcha($dlength);
$dlength = 2;
$distractor2 = randomCaptcha($dlength);
$dlength = 2;
$distractor3 = randomCaptcha($dlength);
imagettftext($im, 35, 179, 357, 35, $decoyGreen, $df1, $distractor1);
imagettftext($im, 35, 94, 150, 150, $decoyBrown, $df2, $distractor2);
imagettftext($im, 35, 228, 400, 50, $decoyYellowish, $df3, $distractor3);
//----------------------------------------------------

imagepng($im);
imagedestroy($im);

//----------------------------------------------------
function makeSendCaptcha($length, $font)//Bonus 3
{
	global $im;
	$lightGreen = imagecolorallocate ($im, 100, 239, 169);//text 1
	$brown = imagecolorallocate($im, 118, 52, 0);//text 2
	$captcha1 = randomCaptcha($length);
	$captcha2 = randomCaptcha($length);
	imagettftext($im, 40, 0, 50, 200, $lightGreen, $font, $captcha1);
	imagettftext($im, 50, -60, 200, 50, $brown, $font, $captcha2);
	$completeCaptcha = $captcha1 . $captcha2;
	return $completeCaptcha;
}
//----------------------------------------------------
function randomCaptcha($length) //Bonus 4
{ 
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
	$randomString = ''; 

	for ($i = 0; $i < $length; $i++) 
	{ 
		$index = rand(0, strlen($characters) - 1); 
		$randomString .= $characters[$index]; 
	} 

	return $randomString; 
} 
//----------------------------------------------------
?> 