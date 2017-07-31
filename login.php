<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>管理员登录界面</title>
</head>
<body>

<?php

$cookieId = "";

if (!empty($_COOKIE['id'])) {
	$cookieId = $_COOKIE['id'];
}

?>

<h1>管理员登录系统</h1>
<form action="loginProcess.php" method="post">
	<table>
		<tr>
			<td>用户id</td>
			<td><input type="text" name="id" value="<?=$cookieId?>"></td>
		</tr>
		<tr>
			<td>密&nbsp;码</td>
			<td><input type="password" name="password"></td>
		</tr>
		<tr>
			<td>请输入验证码</td>
			<td><input type="text" name="checkcode"></td>
			<td><img src="checkcode.php"
				onclick="this.src='checkcode.php?a='+Math.random()"></td>
		</tr>
		<tr>
			<td colspan="2">是否保存用户ID<input type="checkbox" name="keep"></td>
		</tr>
		<tr>
			<td><input type="submit" value="登&nbsp;录"></td>
		</tr>
	</table>
</form>

<?php
	//接受errno
	if (!empty($_GET['errno'])) {
		$errno = $_GET['errno'];
		if ($errno == 1) {
			echo "<br><font color='red' size='3'>用户ID错误!</font>";
		}
		if ($errno == 2) {
			echo "<br><font color='red' size='3'>密码错误!</font>";
		}
		if ($errno == 4) {
			echo "<br><font color='red' size='3'>验证码错误!</font>";
		}
	}
 ?>

</body>
</html>