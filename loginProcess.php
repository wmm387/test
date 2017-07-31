<?php

require_once 'AdminService.class.php';

session_start();

//取得id和password
$id = $_POST['id'];
$password = $_POST['password'];
$checkcode = $_POST['checkcode'];

// 判断验证码是否一致
if ($checkcode != $_SESSION['checkcode']) {
    header("Location: login.php?errno=4");
    exit();
}

// 获取用户是否保存id
if (empty($_POST['keep'])) {
	if (!empty($_COOKIE['id'])) {
		setcookie("id", $id, time()-100);
	}
}else {
	setcookie("id", $id, time()+7*2*24*3600);
}

$adminService = new AdminService();
$name = $adminService->checkAdmin($id, $password);

if ($name == "") {
    header("Location: login.php?errno=3");
    exit();
}else if ($name == 1) {
    header("Location: login.php?errno=1");
    exit();
}else if ($name == 2) {
    header("Location: login.php?errno=2");
    exit();
}else {
    //合法登录
    //把登录信息写入session
    session_start();
    $_SESSION['loginuser'] = $name;
    header("Location: empManage.php?name=$name");
    exit();
}


?>