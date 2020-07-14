<?php 
    include_once '../../fn.php';   

    // 添加文章
    // 获取前端提交表单数据
    $title = $_POST['title'];
    $content = $_POST['content'];
    $slug = $_POST['slug'];
    $category = $_POST['category'];
    $created = $_POST['created'];
    $status = $_POST['status'];
    // 当前登录用户就是作者
    session_start();
    $userid = $_SESSION['user_id'];

    //保持图片地址
    $feature = '';

    //保存图片
    $file = $_FILES['feature'];
    if ($file['error'] === 0) {
        $ext = explode('.', $file['name'])[1];
        $newName = time() .  rand(999, 999999) . '.' . $ext;
        move_uploaded_file($file['tmp_name'], '../../uploads/' .$newName);
        $feature = 'uploads/' .$newName;
    }

    // 把表单数据和图片在服务器中地址，存储数据库中
    $sql = "insert into posts (title, content, slug, category_id, created, status, user_id, feature) 
            values('$title', '$content', '$slug', $category, '$created', '$status', $userid, '$feature')";

    my_exec($sql);
    header('location:../posts.php');
?>