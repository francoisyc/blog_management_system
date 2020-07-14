<?php 
    include_once '../fn.php';
    isLogin();
?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>Add new post &laquo; Admin</title>
    <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <script src="../assets/vendors/nprogress/nprogress.js"></script>
    <style>
        #img {           
            width: 80px;
        }
    </style>
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
                <h1>写文章</h1>
            </div>
            <form class="row" action="./post/postAdd.php" method="post" enctype="multipart/form-data">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="title">标题</label>
                        <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
                    </div>
                    <div class="form-group">
                        <label for="content">内容</label>
                        <textarea id="content" class="form-control input-lg" name="content" cols="30" rows="10" placeholder="内容" style="display: none"></textarea>
                        <!-- 富文本容器 -->
                        <div id="content-box"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="slug">别名</label>
                        <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
                        <p class="help-block">https://zce.me/post/<strong id="strong">slug</strong></p>
                    </div>
                    <div class="form-group">
                        <label for="feature">特色图像</label>
                        <!-- show when image chose -->
                        <img class="help-block thumbnail" id="img" style="display: none">
                        <input id="feature" class="form-control" name="feature" type="file" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="category">所属分类</label>
                        <select id="category" class="form-control" name="category">
                            <option value="1">未分类</option>                      
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="created">发布时间</label>
                        <input id="created" class="form-control" name="created" type="datetime-local">
                    </div>
                    <div class="form-group">
                        <label for="status">状态</label>
                        <select id="status" class="form-control" name="status">
                            <option value="drafted">草稿</option>   
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">保存</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- 给页面添加标记 -->
    <?php $page = 'post-add' ?>

    <!-- 引入侧边栏 -->
    <?php include_once './inc/aside.php' ?>

    <!-- 分类的模版 -->
    <script type="text/html" id="tmp-cate">
        {{ each $data.list v i }}
            <option value="{{ v.id }}">{{ v.name }}</option>   
        {{ /each }}
    </script>

    <!-- 状态的模版引擎 -->
    <script type="text/html" id="tmp-state">
        {{ each $data v k }}
            <option value="{{ k }}">{{ v }}</option>   
        {{ /each }}
    </script>
   


    <script src="../assets/vendors/jquery/jquery.js"></script>
    <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script src="../assets/vendors/template/template-web.js"></script>
    <script src="../assets/vendors/moment/moment.js"></script>
    <script src="../assets/vendors/wangEditor/wangEditor.js"></script>
     <script>
             // 分类下拉数据填充   
             $.ajax({
            url:'./category/cateGet.php',
            dataType: 'json',
            success: function (info) {
                console.log(info);               
                $('#category').html( template('tmp-cate', {list: info}) );
            }
        })

        // 状态下拉数据填充
        var state = {
            drafted: '草稿',
            published: '已发布',
            trashed: '回收站',
        }
        $('#status').html(template('tmp-state', state));

         $('#slug').on('input', function () {
            $('#strong').text( $(this).val() || 'slug');
         });

        // 图片本地预览
        $('#feature').change(function () {            
            var file = this.files[0]; 
            if (file) {
                var url = URL.createObjectURL(file);
                $('#img').attr('src', url).show();
            }
        });

        // 默认时间设置
        
        $('#created').val( moment().format('YYYY-MM-DDTHH:mm') );

         // 富文本编辑器
         var E = window.wangEditor;
         var editor = new E('#content-box');
         editor.customConfig.onchange = function (html) {
            $('#content').val(html);
        }
        editor.customConfig.menus = [
            'fontName',  
            'head',  
            'bold',  
            'fontSize',       
            'italic',  
            'underline',  
            'strikeThrough',  
            'foreColor',  
            'backColor', 
            'link',         
            'emoticon',  
            'image',  
            'table',  
            'undo',  
            'redo'  
        ];
         editor.create();
    </script>
</body>

</html> 