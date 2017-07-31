 <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>修改雇员</title>
</head>
<body>

<?php

require_once 'EmpService.class.php';

$id = $_GET['id'];//获取id

$empService = new EmpService();
//查找并得到信息数组
$arr = $empService->getEmpById($id);

 ?>

<h1>修改雇员</h1>
<form action="empProcess.php" method="post">
	<table>
		<tr>
			<td>ID</td>
			<td><input readonly="true" type="text" name="id" value="<?=$arr[0]['id']?>"></td>
		</tr>
		<tr>
			<td>名字</td>
			<td><input type="text" name="name" value="<?=$arr[0]['name']?>"></td>
		</tr>
		<tr>
			<td>级别</td>
			<td><input type="text" name="grade" value="<?=$arr[0]['grade']?>"></td>
		</tr>
		<tr>
			<td>邮件</td>
			<td><input type="text" name="email" value="<?=$arr[0]['email']?>"></td>
		</tr>
		<tr>
			<td>薪水</td>
			<td><input type="text" name="salary" value="<?=$arr[0]['salary']?>"></td>
		</tr>
		<input type="hidden" name="flag" value="updateemp">
		<tr>
			<td><input type="submit" value="提&nbsp;交"></td>
		</tr>
	</table>
</form>

</body>
</html>