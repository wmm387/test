<?php

//分页类

class Paging {

    public $pageSize = 10;
    public $res_array;
    public $rowCount;//这是个变量值,要从数据库的表获取
    public $pageNow;//用户指定当前页码
    public $pageCount;//计算得到
    public $navigate;//分页导航
    public $gotoUrl;
}

 ?>