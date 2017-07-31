<?php

require_once 'SqlHelper.class.php';

class EmpService {

    //更新雇员信息
    function updateEmp($id, $name, $grade, $email, $salary) {
        $sql = "update emp set name='$name', grade=$grade, email='$email',
                salary=$salary where id=$id";
        $sqlHelper = new SqlHelper();
        $res = $sqlHelper->execute_dml($sql);
        $sqlHelper->close_connect();
        return $res;
    }

    //获取某个id的雇员信息
    function getEmpById($id) {

        $sql = "select * from emp where id=$id";

        $sqlHelper = new SqlHelper();
        $arr = $sqlHelper->execute_dql_arr($sql);
        $sqlHelper->close_connect();
        //这里可以二次封装给emp对象,但现在直接用数组比较方便
        return $arr;
    }

    //获取共有多少页
    function getPageCount($pageSize) {

        //查询$rowCount
        $sql = "select count(id) from emp";
        $sqlHelper = new SqlHelper();
        $res = $sqlHelper->execute_dql($sql);

        //计算$pageCount
        if ($row = mysql_fetch_row($res)) {
            $pageCount = ceil($row[0] / $pageSize);
        }

        mysql_free_result($res);
        $sqlHelper->close_connect();

        return $pageCount;
    }

    //获取当前页的雇员列表方法
    function getEmpListByPage($pageNow, $pageSize) {

        $sql = "select * from emp limit " . ($pageNow - 1) * $pageSize . ", $pageSize";

        $sqlHelper = new SqlHelper();
        $res = $sqlHelper->execute_dql_arr($sql);

        $sqlHelper->close_connect();

        return $res;
    }

    //第二种使用封装的方式完成的分页(业务逻辑在这)
    function getPaging ($paging) {
        $sqlHelper = new SqlHelper();

        $sql1 = "select * from emp limit "
            . ($paging->pageNow - 1) * $paging->pageSize
            . ", $paging->pageSize";

        $sql2 = "select count(id) from emp";

        $sqlHelper->execute_dql_paging($sql1, $sql2, $paging);

        $sqlHelper->close_connect();
    }

    //根据id删除雇员
    function delEmpById($id) {

        $sql = "delete from emp where id=$id";

        $sqlHelper = new SqlHelper();
        return $sqlHelper->execute_dml($sql);
    }

    //添加雇员方法
    function addEmp($name, $grade, $email, $salary) {

        $sql = "insert into emp (name, grade, email, salary)
        value ('$name', $grade, '$email', $salary)";
        $sqlHelper = new SqlHelper();
        $res =  $sqlHelper->execute_dml($sql);
        $sqlHelper->close_connect();
        return $res;
    }



}

?>