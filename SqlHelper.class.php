<?php

//工具类,作用是数据库的操作
class SqlHelper {

	public $conn;
	public $dbname = "mydb";
	public $username = "root";
	public $password = "123456";
	public $host = "localhost";

	public function __construct() {

		$this->conn = mysql_connect($this->host, $this->username, $this->password);
		if (!$this->conn) {
			die("连接失败" . mysql_error());
		}

		mysql_query("set names utf8", $this->conn);
		mysql_select_db($this->dbname, $this->conn);
	}

	//执行dql语句
	public function execute_dql($sql) {

		$res = mysql_query($sql, $this->conn) or die(mysql_error());
		return $res;
	}

	//执行dql语句,返回资源数组
	public function execute_dql_arr($sql) {

	    $arr = array();
	    $res = mysql_query($sql, $this->conn) or die(mysql_error());

	    //把资源变成数组
	    while ($row = mysql_fetch_assoc($res)) {
	        $arr[] = $row;//自增长
	    }
	    //这里就可以马上把$res关闭
	    mysql_free_result($res);
	    return $arr;
	}
	
	//考虑分页情况的查询
	//$sql1 = "select * from 表名 limit 0,10";
	//$sql2 = "select count(id) from 表名";
	public function execute_dql_paging($sql1, $sql2, $paging) {
	    
	    //查询要分页的数据
	    $res = mysql_query($sql1, $this->conn) or die(mysql_error());
	    //将数据传入数组
	    $arr = array();
	    while ($row = mysql_fetch_assoc($res)) {
	        $arr[] = $row;
	    }
	    
	    mysql_free_result($res);
	    
	    $res2 = mysql_query($sql2, $this->conn) or die(mysql_error());
	    
	    if ($row = mysql_fetch_row($res2)) {
	        $paging->pageCount = ceil($row[0] / $paging->pageSize);
	        $paging->rowCount = $row[0];
	    }
	    
	    mysql_free_result($res2);
	    
	    //将数组赋给paging分页实例
	    $paging->res_array = $arr;
	}

	//执行dml语句
	public function execute_dml($sql) {

		$b = mysql_query($sql, $this->conn) or die(mysql_error());
		if (!$b) {
			return 0;
		}else {
			if (mysql_affected_rows($this->conn) > 0) {
				return 1;//表示执行成功
			}else {
				return 2;//表示没有行受到影响
			}
		}
	}

	//关闭连接方法
	public function close_connect() {

		if (!empty($this->conn)) {
			mysql_close($this->conn);
		}
	}
}

 ?>