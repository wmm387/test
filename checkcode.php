<?php

session_start();

//使用php绘图技术,画验证码
$checkCode = "";
for ($i=0; $i < 4; $i++) {
	$checkCode .= dechex(rand(1,15));
}

//存入到session
$_SESSION['checkcode'] = $checkCode;

//创建画布
$image = imagecreatetruecolor(80, 30);
$white = imagecolorallocate($image, 255, 255, 255);

//画干扰线
for ($i=0; $i < 20; $i++) {
	imageline($image, rand(0, 80), rand(0, 30), rand(0, 80), rand(0, 30),
	imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255)));
}

imagestring($image, rand(3, 7), rand(0, 45), rand(0, 16), $checkCode, $white);

header("content-type: image/png");
imagepng($image);

imagedestroy($image);

?>