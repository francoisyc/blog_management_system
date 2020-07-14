<?php 
    include_once '../../fn.php'; 
    
    // 接收前端提交的数据后添加
    $name = $_GET['name'];
    $slug = $_GET['slug'];
    $sql = "insert into categories (name, slug) values ('$name', '$slug')";
    my_exec($sql);
?>