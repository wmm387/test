<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>添加雇员</title>
</head>
<body>

<h1>添加雇员</h1>
<form action="empProcess.php" method="post">
	<table>
		<tr>
			<td>名字</td>
			<td><input type="text" name="name"></td>
		</tr>
		<tr>
			<td>级别</td>
			<td><input type="text" name="grade"></td>
		</tr>
		<tr>
			<td>邮件</td>
			<td><input type="text" name="email"></td>
		</tr>
		<tr>
			<td>薪水</td>
			<td><input type="text" name="salary"></td>
		</tr>
		<input type="hidden" name="flag" value="addemp">
		<tr>
			<td><input type="submit" value="提&nbsp;交"></td>
		</tr>
	</table>
</form>

</body>
</html>