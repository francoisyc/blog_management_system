<?php 
    //返回数据库中有效的文章总数
    include_once '../../fn.php';
    $sql = "select count(*) as 'total' from posts 
            join users on posts.user_id = users.id
            join categories on posts.category_id = categories.id";

    $data = my_query($sql)[0];
    echo json_encode($data);
?>