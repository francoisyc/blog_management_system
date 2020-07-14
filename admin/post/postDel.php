<?php 
    include_once '../../fn.php';
    //  根据前端传递的id， 删除对应的数据
    $id = $_GET['id'];
    $sql = "delete from posts where id in ($id)";
    my_exec($sql);

    //返回删除剩余的数据总数
    $sql1 = "select count(*) as 'total' from posts 
    join users on posts.user_id = users.id
    join categories on posts.category_id = categories.id";

    $data = my_query($sql1)[0];
    echo json_encode($data);
?>