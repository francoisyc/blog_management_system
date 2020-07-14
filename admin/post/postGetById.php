<?php 
    //根据前端传递id 返回对应的文章数据
    include_once '../../fn.php';
    $id = $_GET['id']; 
    $sql = "select * from posts where id = $id";
    $data = my_query($sql)[0];
    echo json_encode($data);
?>