<?php 
    include_once  '../../fn.php';
    // 根据前端传递id，去更新对应的数据
    $id = $_GET['id'];
    $name = $_GET['name'];
    $slug = $_GET['slug'];
    $sql = "update categories set name = '$name', slug = '$slug'  where id = $id";
    my_exec($sql);
?>