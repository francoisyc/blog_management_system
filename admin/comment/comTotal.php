<?php 
    // 查询有效的评论总数
    include_once '../../fn.php'; 
    $sql = "select count(*) as 'total' from comments 
            join posts on comments.post_id = posts.id";
    $data = my_query($sql)[0];
    echo json_encode($data);
?>