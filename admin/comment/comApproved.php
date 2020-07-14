<?php 
    include_once '../../fn.php';
    
    $id = $_GET['id']; //获取前端传递id
    $sql = "update  comments  set status = 'approved' where id in ($id)  and status = 'held' ";
    my_exec($sql);
?>