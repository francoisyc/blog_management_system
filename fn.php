<?php
define('HOST', '127.0.0.1');
define('UNAME', 'root');
define('PWD', 'root');
define('DB', 'zbaixiu');

// 封装执行增删改语句
function my_exec($sql)
{
    $link = mysqli_connect(HOST, UNAME, PWD, DB);
    $r = mysqli_query($link, $sql); 
    mysqli_close($link);
    return $r;
}

// 封装执行查找语句
function my_query($sql)
{
    $link = mysqli_connect(HOST, UNAME, PWD, DB);
    $r = mysqli_query($link, $sql);
    $num = mysqli_num_rows($r);
    if (!$r || $num == 0) {
        mysqli_close($link);
        return false;
    }

    $data = [];
    for ($i = 0; $i < $num; $i++) {
        $data[] = mysqli_fetch_assoc($r);
    }
    mysqli_close($link);
    return $data;

}
//判断用户之前是否登录过
function isLogin()
{
    
    if (empty($_COOKIE['PHPSESSID'])) {
        header('location:./login.php');
        die();
    } else {
        session_start();
        if (empty($_SESSION['user_id'])) {
            header('location:./login.php');
            die();
        }
    }
}
