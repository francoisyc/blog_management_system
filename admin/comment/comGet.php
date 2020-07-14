<?php 
    include_once '../../fn.php';
    //  根据前端传递 页码和 每页数据条数 返回对应的数据；
    $page = $_GET['page']; //页码
    $pageSize = $_GET['pageSize']; //每页数据条数

    //起始索引 = （页码 - 1 ）* 每页数据条数
    $start = ($page - 1) * $pageSize; 

    $sql = "select comments.*, posts.title from comments  
            join posts on comments.post_id = posts.id -- 只要文章的标题
            limit $start, $pageSize -- limit 起始索引  截取长度";
    //执行
    $data = my_query($sql);
    echo json_encode($data);
?>