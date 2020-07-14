<?php 
    include_once '../../fn.php';
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $slug = $_POST['slug'];
    $category = $_POST['category'];
    $created = $_POST['created'];
    $status = $_POST['status'];
    $feature = ''; 

    //保存上传的图片
    $file = $_FILES['feature'];
    if ($file['error'] === 0) {
        $ext = explode('.', $file['name'])[1]; 
        $newName = time() . rand(99, 9999) . '.' . $ext; 
        move_uploaded_file($file['tmp_name'], '../../uploads/' . $newName); 
        $feature = './uploads/' . $newName;
    }

    if (empty($feature)) {
        $sql = "update posts set title = '$title', content='$content', slug = '$slug', category_id = $category, created = '$created', status = '$status' where id = $id";
    } else{
        $sql = "update posts set title = '$title', content='$content', slug = '$slug', category_id = $category, created = '$created', status = '$status',feature = '$feature' where id = $id";
    }


    my_exec($sql);


?>