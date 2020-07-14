<?php 
    include_once '../../fn.php';
    //获取全部分类数据并返回
    $sql = "select * from categories";
    echo json_encode( my_query($sql) );
?>