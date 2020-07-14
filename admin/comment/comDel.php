<?php 
    header('content-type:text/html;charset=utf-8');
    include_once '../../fn.php';
    //根据前端传递id 删除对应的数据
    $id = $_GET['id'];
    $sql = "delete  from comments where id in ($id)";
    my_exec($sql);
    // 每次删除完后，重新查询总数返回
    $sql1 = "select count(*) as 'total' from comments 
    join posts on comments.post_id = posts.id";
    $data = my_query($sql1)[0];
    echo json_encode($data);

?>