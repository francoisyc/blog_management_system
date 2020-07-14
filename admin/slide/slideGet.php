<?php
    include_once '../../fn.php';
    // 获取轮播图数据
    $sql = "select value from options where id = 10";
    $data = my_query($sql)[0]['value'];
    echo $data;
?>
