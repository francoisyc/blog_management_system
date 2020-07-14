<?php 
    include_once '../../fn.php';
    // 根据前端传递id删除对应的数据
    $id = $_GET['id'];
    $sql = "delete from categories where id = $id";
    my_exec($sql);
?>