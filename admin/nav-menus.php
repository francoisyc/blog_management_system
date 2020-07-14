<?php 
    include_once '../fn.php';
    isLogin();
?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>Navigation menus &laquo; Admin</title>
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
                <li><a href="profile.php"><i class="fa fa-user"></i>个人中心</a></li>
                <li><a href="logout.php"><i class="fa fa-sign-out"></i>退出</a></li>
            </ul>
        </nav>
        <div class="container-fluid">
            <div class="page-title">
                <h1>导航菜单</h1>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <form>
                        <h2>添加新导航链接</h2>
                        <div class="form-group">
                            <label for="text">文本</label>
                            <input id="text" class="form-control" name="text" type="text" placeholder="文本">
                        </div>
                        <div class="form-group">
                            <label for="title">标题</label>
                            <input id="title" class="form-control" name="title" type="text" placeholder="标题">
                        </div>
                        <div class="form-group">
                            <label for="link">链接</label>
                            <input id="link" class="form-control" name="link" type="text" placeholder="链接">
                        </div>
                        <div class="form-group">
                            <label for="href">图标</label><br>
                            <input type="radio" name="icon" value="fa fa-glass" checked><i class="fa fa-glass"></i> &nbsp; &nbsp;
                            <input type="radio" name="icon" value="fa fa-fire"><i class="fa fa-fire"></i> &nbsp; &nbsp;
                            <input type="radio" name="icon" value="fa fa-gift"><i class="fa fa-gift"></i> &nbsp; &nbsp;
                            <input type="radio" name="icon" value="fa fa-phone"><i class="fa fa-phone"></i> &nbsp; &nbsp;
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="button" value="添加">
                        </div>
                    </form>
                </div>
                <div class="col-md-8">
                    <div class="page-action">
                        <!-- show when multiple checked -->
                        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>文本</th>
                                <th>标题</th>
                                <th>链接</th>
                                <th class="text-center" width="100">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><i class="fa fa-glass"></i>奇趣事</td>
                                <td>奇趣事</td>
                                <td>#</td>
                                <td class="text-center">
                                    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-phone"></i>潮科技</td>
                                <td>潮科技</td>
                                <td>#</td>
                                <td class="text-center">
                                    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-fire"></i>会生活</td>
                                <td>会生活</td>
                                <td>#</td>
                                <td class="text-center">
                                    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- 给页面添加标记 -->
    <?php $page = 'nav-menus' ?>

    <!-- 引入侧边栏 -->
    <?php include_once './inc/aside.php' ?>

    <script src="../assets/vendors/jquery/jquery.js"></script>
    <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script>
        NProgress.done()
    </script>
</body>

</html> 