<?php 
    include_once '../fn.php';
    isLogin();
?>


<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>Categories &laquo; Admin</title>
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
                <li><a href="login.html"><i class="fa fa-sign-out"></i>退出</a></li>
            </ul>
        </nav>
        <div class="container-fluid">
            <div class="page-title">
                <h1>分类目录</h1>
            </div>
            <div class="alert alert-danger" style="display: none">
                <strong>错误！</strong>分类名称和别名不能为空
            </div>
            <div class="row">
                <div class="col-md-4">
                    <form id="form">
                        <h2>添加新分类目录</h2>
                        <!-- 存放当前数据id -->
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name">名称</label>
                            <input id="name" class="form-control" name="name" type="text" placeholder="分类名称">
                        </div>
                        <div class="form-group">
                            <label for="slug">别名</label>
                            <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
                            <p class="help-block">https://zce.me/category/<strong>slug</strong></p>
                        </div>
                        <div class="form-group">
                            <input type="button" class="btn btn-primary btn-add" value="添加">
                            <input type="button" class="btn btn-primary btn-update" style="display: none" value="修改">
                            <!-- <input type="reset" value="重置"> -->
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
                                <th class="text-center" width="40"><input type="checkbox"></th>
                                <th>名称</th>
                                <th>Slug</th>
                                <th class="text-center" width="100">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"><input type="checkbox"></td>
                                <td>未分类</td>
                                <td>uncategorized</td>
                                <td class="text-center">
                                    <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
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
    <?php $page = 'categories' ?>
    <!-- 引入侧边栏 -->
    <?php include_once './inc/aside.php' ?>

    <!-- 模版 -->
    <script type="text/html" id="tmp">
        {{ each list v i }}
        <tr>
            <td class="text-center" data-id="{{ v.id }}"><input type="checkbox"></td>
            <td>{{ v.name }}</td>
            <td>{{ v.slug }}</td>
            <td class="text-center" data-id="{{ v.id }}">
                <a href="javascript:;" class="btn btn-info btn-xs btn-edit">编辑</a>
                <a href="javascript:;" class="btn btn-danger btn-xs btn-del">删除</a>
            </td>
        </tr>              
        {{ /each }}
    </script>
    <script src="../assets/vendors/jquery/jquery.js"></script>
    <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script src="../assets/vendors/template/template-web.js"></script>
    <script>NProgress.done()</script>
    <script>
        //1-获取数据并渲染方法
        function render() {
            $.ajax({
                url: './category/cateGet.php',
                dataType: 'json',
                success: function (info) {
                    console.log(info);         
                    //渲染
                    $('tbody').html(template('tmp', {list: info}));           
                }
            })
        }
        // 获取第一屏的数据并渲染
        render();

        // 删除
        $('tbody').on('click', '.btn-del', function () {
            var id = $(this).parent().attr('data-id');
            $.ajax({
                url:'./category/cateDel.php',
                data:{id:id}, 
                success: function (info) {
                    render();                    
                }
            })
        })

        //添加分类
        $('.btn-add').click(function () {
            var str = $('#form').serialize();
            $.ajax({
                url:'./category/cateAdd.php',
                data:str, 
                beforeSend: function () {
                    if ($('#name').val().trim().length == 0 || $('#slug').val().trim().length == 0) {
                        $('.alert').show();
                        return false;
                    } else {
                        $('.alert').hide();
                    }
                },
                success: function () {
                    render();
                    $('#form')[0].reset();

                }
            })
        });

        // 把数据取出来填充在页面中供修改
        $('tbody').on('click', '.btn-edit', function () {
            var id = $(this).parent().attr('data-id');
            $.ajax({
                url: './category/cateGetById.php',
                data:{id: id},
                dataType: 'json',
                success: function (info) {
                    $('#name').val(info.name);
                    $('#slug').val(info.slug);      
                    $('#id').val(info.id);
                    $('.btn-add').hide();
                    $('.btn-update').show();
                }
            })
        });

        
        // 修改完成后，把数据根据id更新回数据库 
        $('.btn-update').click(function () {
            var str = $('#form').serialize();
            $.ajax({
                url:'./category/cateUpdate.php',
                data: str,
                success: function () {
                    render();
                    $('#form')[0].reset();
                    $('.btn-update').hide();
                    $('.btn-add').show();
                }
            })
        })


        
    </script>


</body>

</html>