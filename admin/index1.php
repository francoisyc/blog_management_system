<?php 
    include_once '../fn.php';
    isLogin();

    // 准备首页查询语句
    // 查询文章总数
    $postSql = "select count(*) as 'total' from posts";
    // 查询草稿
    $draSql = "select count(*) as 'total' from posts where status = 'drafted'";
    // 查询分类的总数
    $cateSql = "select count(*) as 'total' from categories";
    // 查询评论的总数
    $comSql = "select count(*) as 'total' from comments";
    // 查询待审核的总数
    $heldSql = "select count(*) as 'total' from comments where status = 'held'";

    $postTotal = my_query($postSql)[0]['total'];
    $draTotal = my_query($draSql)[0]['total'];
    $cateTotal = my_query($cateSql)[0]['total'];
    $comTotal = my_query($comSql)[0]['total'];
    $heldTotal = my_query($heldSql)[0]['total'];
?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>Dashboard &laquo; Admin</title>
    <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>

<body>
    <script>
        NProgress.start()
    </script>

    <div class="main">
        <nav class="navbar">
            <button class="btn btn-default navbar-btn fa fa-bars"></button>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="profile.html"><i class="fa fa-user"></i>个人中心</a></li>
                <li><a href="login.php"><i class="fa fa-sign-out"></i>退出</a></li>
            </ul>
        </nav>
        <div class="container-fluid">
            <div class="jumbotron text-center">
                <h1>One Belt, One Road</h1>
                <p>Thoughts, stories and ideas.</p>
                <p><a class="btn btn-primary btn-lg" href="post-add.html" role="button">写文章</a></p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">站点内容统计：</h3>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item"><strong><?php echo $postTotal ?>
                                </strong>篇文章（<strong><?php echo $draTotal ?></strong>篇草稿）</li>
                            <li class="list-group-item"><strong><?php echo $cateTotal ?></strong>个分类</li>
                            <li class="list-group-item"><strong><?php echo $comTotal ?></strong>条评论
                                （<strong><?php echo $heldTotal ?></strong>条待审核）</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
    <!-- 给页面添加标记 -->
    <?php $page = 'index1' ?>

    <!-- 引入侧边栏 -->
    <?php include_once './inc/aside.php' ?>

    <script src="../assets/vendors/jquery/jquery.js"></script>
    <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script>
        NProgress.done()
    </script>
</body>

</html> 