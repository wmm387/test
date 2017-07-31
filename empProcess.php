<?php

require_once 'EmpService.class.php';

	//创建empservice对象实例
    $empService = new EmpService();

    if (!empty($_GET['pageNow'])) {
		$pageNow = $_GET['pageNow'];
	}

    if (!empty($_REQUEST['flag'])) {
    	//接受flag值
    	$flag = $_REQUEST['flag'];
    	//如果是del操作
    	if ($flag == "del") {
    		$id = $_REQUEST['id'];//要删除雇员的id
        	if($empService->delEmpById($id) == 1) {
        		header("Location: empList.php?pageNow=$pageNow");
        		exit();
        	}else {
        		header("Location: error.php");
        		exit();
        	}
    	}else if ($flag == "addemp") {
    		//添加操作,接受数据
    		$name = $_POST['name'];
    		$grade = $_POST['grade'];
    		$email = $_POST['email'];
    		$salary = $_POST['salary'];
    		//添加雇员
    		$res = $empService->addEmp($name, $grade, $email, $salary);
    		if($res == 1) {
        		header("Location: ok.php");
        		exit();
        	}else {
        		header("Location: error.php");
        		exit();
        	}
    	}else if ($flag == "updateemp") {
    		//更新数据
    		$id = $_POST['id'];
    		$name = $_POST['name'];
    		$grade = $_POST['grade'];
    		$email = $_POST['email'];
    		$salary = $_POST['salary'];

    		$res = $empService->updateEmp($id, $name, $grade, $email, $salary);
    		if($res == 1) {
    			//todo:直接回到列表界面
        		header("Location: ok.php");
        		exit();
        	}else {
        		header("Location: error.php");
        		exit();
        	}
    	}

    }

 ?>