<?php 
    // 后台获取保存到数据库中
    include_once '../../fn.php';
    $file = $_FILES['image'];
    if ($file['error'] ===0) {
        $ext = explode('.', $file['name'])[1]; 
        $newName = time() . rand() . '.' . $ext; 
        move_uploaded_file($file['tmp_name'], '../../uploads/'. $newName); 
        $info['image'] = 'uploads/'. $newName; 
        $info['text'] = $_POST['text'];
        $info['link'] = $_POST['link'];
        $sql = "select value from options where id = 10";
        $str = my_query($sql)[0]['value'];
        $arr = json_decode($str, true);
        $arr[] = $info;
        $str = json_encode($arr, JSON_UNESCAPED_UNICODE);
        echo $str;
        $sql1 ="update options set  value = '$str' where id = 10";
        my_exec($sql1);
    }
?>