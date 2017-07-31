<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>主界面</title>
</head>
<body>

<?php

require_once 'common.php';

//验证用户是否合法登录
checkUserValidate();

//显示上次登录时间
getLastTime();

?>

<h1>主界面</h1><p>管理员:<?php if (!empty($_GET['name'])){echo $_GET['name'];} ?></p>
<a href="empList.php">管理用户</a><br>
<a href="addEmpUI.php">添加用户</a><br>
<a href="#">查询用户</a><br>
<a href="login.php">退出系统</a><br>

</body>
</html>


