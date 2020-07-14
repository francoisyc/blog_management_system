<?php 
    include_once '../../fn.php';
    $page = $_GET['page'];
    $pageSize = $_GET['pageSize'];
    $start = ($page - 1 ) * $pageSize;
    // 获取文章数据
    $sql = "select posts.id,  posts.title, posts.created, posts.status, users.nickname, categories.name from posts
            join users on  posts.user_id  = users.id
            join categories on posts.category_id = categories.id
            order by id  desc
            limit $start, $pageSize"; 
    $data = my_query($sql);
    echo  json_encode($data);    
?>