<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>雇员信息列表</title>
	<script type="text/javascript">

	function confirmDele(val) {
		return window.confirm("是否删除id="+val+"的雇员");
	}

	</script>
</head>
<body>

<h1>雇员信息列表</h1>

<?php



    require_once 'EmpService.class.php';
    require_once 'Paging.class.php';
    require_once 'common.php';

	//验证用户是否合法登录
	checkUserValidate();

    //创建一个paging实例
    $paging = new Paging();
    //初始化数据
	$paging->pageSize = 10;
	$paging->pageNow = 1;
	$paging->gotoUrl = "empList.php";
	//默认为第一页,根据页码控制显示
	if (!empty($_GET['pageNow'])) {
		$paging->pageNow = $_GET['pageNow'];
	}

	//创建empservice对象实例
    $empService = new EmpService();
	//通过getPaging方法实现分页
	$empService->getPaging($paging);
	//获取结果集
	$res = $paging->res_array;

	//通过数组来展示雇员列表
	echo "<table border=1 width='600px'><tr>";
	//表头
	foreach ($res[0] as $key=>$value) {
	    echo "<th>$key</th>";
	}
	echo "<td>修改信息</td><td>删除雇员</td></tr>";
    //表数据
	for ($i = 0;$i < count($res);$i++){
	    $row = $res[$i];
        echo "<tr>";
        foreach ($row as $key=>$value) {
            echo "<td>$value</td>";
        }
        echo "<td><a href='updateEmpUI.php?id={$row['id']}'>
                                           修改信息</a></td><td>
              <a onclick='return confirmDele({$row['id']})'
              href='empProcess.php?pageNow={$paging->pageNow}
              &flag=del&id={$row['id']}'>删除雇员</a></td></tr>";
	}

	echo "</table>";

	//显示上一页和下一页
	if ($paging->pageNow > 1) {
	    $prePage = $paging->pageNow - 1;
		echo "&nbsp;<a href='{$paging->gotoUrl}?pageNow="
                  . $prePage . "'>上一页</a>&nbsp;";
	}

	//显示10个页码数
	//todo 首页和末页
	if ($paging->pageNow < 4) {
		$start = 1;
	}else if ($paging->pageNow < $paging->pageCount - 4){
	    $start = $paging->pageNow - 4;
	}else {
	    $start = $paging->pageCount - 9;
	}
	$index = $start;
	for ($start; $start < $index + 10; $start++) {
	    if ($start < $paging->pageCount+1) {
		echo "<a href='{$paging->gotoUrl}?pageNow=$start'>[$start]</a>";
		}
	}

	if ($paging->pageNow < $paging->pageCount) {
	    $nextPage = $paging->pageNow + 1;
		echo "&nbsp;<a href='{$paging->gotoUrl}?pageNow="
	        . $nextPage . "'>下一页</a>&nbsp;";
	}

	//显示当前页与所有页
	echo "&nbsp;&nbsp;$paging->pageNow / $paging->pageCount&nbsp;&nbsp;";



 ?>

<!-- 跳转到指定页码页 -->
<form action="empList.php" method="get">
	跳转到<input type="text" name="pageNow">
	<input type="submit" value="GO">
</form>

</body>
</html>
