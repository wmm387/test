<?php 

require_once 'SqlHelper.class.php';

//该类是业务逻辑处理类,主要是对admin表的操作
class AdminService {
    
    //验证用户合法方法
    public function checkAdmin($id, $password) {
        
        $sql = "select password,name from admin where id=$id";
        //创建一个SqlHelper对象
        $sqlHelper = new SqlHelper();
        $res = $sqlHelper->execute_dql($sql);
        if ($row = mysql_fetch_assoc($res)) {
            if ($row['password'] == md5($password)) {
                return $row['name'];
            }else {
                return 2;
            }
        }else {
            mysql_free_result($res);
            $sqlHelper->close_connect();
            return 1;
        }
    }
    
}

?>