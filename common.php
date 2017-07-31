<?php

//获取登录时间
function getLastTime() {

	// date_default_timezone_set("Asia/Shanghai");

	//首先查看cookie中有没有上次的登录信息
	if (!empty($_COOKIE['lastVisit'])) {
		echo "你上次登录时间是" . $_COOKIE['lastVisit'];
		//更新时间
		setcookie("lastVisit", date("Y-m-d  H:i:s"), time()+24*3600*30);
	}else {
		//说明你是第一次登录
		echo "你是第一次登录";
		//更新时间
		setcookie("lastVisit", date("Y-m-d  H:i:s"), time()+24*3600*30);
	}
}

//验证用户是否合法,通过session
function checkUserValidate() {

	session_start();

	if (empty($_SESSION['loginuser'])) {
		header("Location: login.php");
		exit();
	}
}

?>