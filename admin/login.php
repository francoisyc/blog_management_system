<?php
include '../fn.php';
// 获取登录数据，传到后台验证，验证成功即可登录转向主页
if (!empty($_POST)) {
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    if (empty($email) || empty($pwd)) {
        $msg = '用户名或者密码不能为空！';
    } else {
        $sql = "select * from users where email = '$email'";
        $data = my_query($sql);
       
        if (empty($data)) {
            $msg = '用户名不存在';
        } else {
            $data = $data[0];
            if ($data['password'] === $pwd) {
                //密码正确，开启session保存用户信息添加标记后跳转首页
                session_start();
                $_SESSION['user_id'] = $data['id'];
                header('location:./index1.php');
            
            } else {
                $msg = '密码错误';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>Sign in &laquo; Admin</title>
    <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>
    <div class="login">
        <form class="login-wrap" action="" method="post">
            <img class="avatar" src="../assets/img/default.png">
            <!-- 如果$msg有内容，说明有错误信息，显示错误信息 -->
            <?php if (!empty($msg)) {?>
            <div class="alert alert-danger">
                <strong>错误！</strong> <?php echo $msg ?>
            </div>
            <?php }?>
            <div class="form-group">
                <label for="email" class="sr-only">邮箱</label>
                <input id="email" type="email" name="email" class="form-control" placeholder="邮箱" autofocus>
            </div>
            <div class="form-group">
                <label for="password" class="sr-only">密码</label>
                <input id="password" name="password" type="password" class="form-control" placeholder="密码">
            </div>
            <input class="btn btn-primary btn-block" type="submit" value="登录">
        </form>
    </div>
</body>

</html>