<?php 
    include_once '../fn.php';
    isLogin();
    // header('location:./login.php?url=posts')
?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>Posts &laquo; Admin</title>
    <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/vendors/pagination/pagination.css">
    <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>
<style>
    .edit-box{
        position:fixed;
        left:0;
        top:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.2);
        z-index:10;
        padding:30px 50px;
        display:none;
    }

    .container-fluid{
        background: #eee;
        border-radius:10px;
        padding-bottom:20px;
    }

</style>
<style>

</style>

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
                <h1>所有文章</h1>
                <a href="post-add.html" class="btn btn-primary btn-xs">写文章</a>
            </div>
            <div class="page-action">

                <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
                <!-- 分页容器 -->
                <div class="page-box  pull-right"></div>
            </div>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center" width="40"><input type="checkbox"></th>
                        <th>标题</th>
                        <th>作者</th>
                        <th>分类</th>
                        <th class="text-center">发表时间</th>
                        <th class="text-center">状态</th>
                        <th class="text-center" width="100">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center"><input type="checkbox"></td>
                        <td>随便一个名称</td>
                        <td>小小</td>
                        <td>潮科技</td>
                        <td class="text-center">2016/10/07</td>
                        <td class="text-center">已发布</td>
                        <td class="text-center">
                            <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
                            <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- 编辑模态框 -->
    <div class="edit-box">
    <div class="container-fluid my-in">
      <div class="page-title">
        <h1>修改文章</h1>
      </div>

      <form class="row" id="editForm">
        
        <input type="hidden"  id="id" name="id" value="">       
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
          </div>
          <div class="form-group">
            <label for="content">正文</label>
            <textarea id="content" class="form-control input-lg"
               name="content" cols="30" rows="10" placeholder="内容" style="display:none"></textarea>
                <!-- 生成富文本编辑器容器 -->
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
            <img class="help-block thumbnail" id="img" style="display: none; width:60px;">
            <!--  accept="image/jpeg,image/gif,image/png" 限制上传文件格式 -->
            <input id="feature" class="form-control" name="feature" type="file" accept="image/*">
          </div>
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control sel-cate sel-cate1" name="category">     
            </select>
          </div>
          <div class="form-group">
            <label for="created">发布时间</label>
            <input id="created" class="form-control" name="created" type="datetime-local">
          </div>
          <div class="form-group">
            <label for="status">状态</label>
            <select id="status" class="form-control sel-state sel-state1" name="status">
            </select>
          </div>
          <div class="form-group">
            <!-- <button class="btn btn-primary" >修改</button> -->
            <input  id="btn-update" type="button" value="修改"  class="btn btn-primary btn-update" >
            <input  id="btn-cancel" type="button" value="放弃"  class="btn btn-danger btn-cancel" >
          </div>
        </div>
      </form>
    </div>
</div>
    <!-- 给页面添加标记 -->
    <?php $page = 'posts' ?>

    <!-- 引入侧边栏 -->
    <?php include_once './inc/aside.php' ?>

    <!-- 准备模版 -->
    <script type="text/html" id="tmp">
        {{ each list v i }}
        <tr>
            <td class="text-center" data-id={{ v.id }}><input type="checkbox"></td>
            <td>{{ v.title }}</td>
            <td>{{ v.nickname }}</td>
            <td>{{ v.name }}</td>
            <td class="text-center">{{ v.created }}</td>
            <td class="text-center">{{ state[v.status] }}</td>
            <td class="text-center" data-id={{ v.id }}>
                <a href="javascript:;" class="btn btn-default btn-xs btn-edit">编辑</a>
                <a href="javascript:;" class="btn btn-danger btn-xs btn-del">删除</a>
            </td>
        </tr>
        {{ /each }}
    </script>

        <!-- 分类的模版 -->
    <script type="text/html" id="tmp-cate">
        {{ each $data.list v i }}
            <option value="{{ v.id }}">{{ v.name }}</option>   
        {{ /each }}
    </script>

    <!-- 状态的模版引擎 -->
    <!-- 在模版中 $data 表示传递给模版对象  -->
    <script type="text/html" id="tmp-state">
        {{ each $data v k }}
            <option value="{{ k }}">{{ v }}</option>   
        {{ /each }}
    </script>
    <script src="../assets/vendors/jquery/jquery.js"></script>
    <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script src="../assets/vendors/template/template-web.js"></script>
    <script src="../assets/vendors/pagination/jquery.pagination.js"></script>
    <script src="../assets/vendors/moment/moment.js"></script>
    <script src="../assets/vendors/wangEditor/wangEditor.js"></script>
    
    <script>
    NProgress.done()
    </script>

    <script>

    //文章的状态
    var state = {
        drafted: '草稿',
        published: '已发布',
        trashed: '回收站'
    }

    var currentPage = 1; 

    // 封装渲染数据
    function render(page) {
        $.ajax({
            url: './post/postGet.php',
            data: {
                page: page || 1,
                pageSize: 10
            },
            dataType: 'json',
            success: function(info) {
                var obj = {
                    list: info,
                    state: state
                }
                $('tbody').html(template('tmp', obj));
            }
        })
    }
    // 渲染
    render();
    // 分页
    function setPage (page) {
        $.ajax({
            url: './post/postTotal.php',
            dataType: 'json',
            success: function (info) {
                $('.page-box').pagination(info.total,{
                    num_display_entries: 5,
                    num_edge_entries: 1, 
                    prev_text: '上一页',
                    next_text: '下一页',
                    current_page: page-1 || 0,
                    load_first_page: false, 
                    callback: function (index) {
                        render(index + 1) 
                        currentPage = index + 1;
                    }
                });
                
            }
        })
    }
    // 生成分页
    setPage();
    $('tbody').on('click', '.btn-del', function () {
        var id = $(this).parent().attr('data-id');
        $.ajax({
            url:'./post/postDel.php',
            data: {id: id},
            dataType: 'json',
            success: function (info) {
                var maxPage = Math.ceil(info.total/10);
                if (currentPage > maxPage) {
                    currentPage = maxPage;
                }
                render(currentPage);
                setPage(currentPage);
            }
        })
    });

    // 准备模态框
    $.ajax({
        url: './category/cateGet.php',
        dataType: 'json',
        success: function (info) {
            $('#category').html( template('tmp-cate', {list: info}))
        }
    })
    // 状态列表
    var state = {
        drafted: '草稿',
        published: '已发布',
        trashed: '回收站'
    }
    //根据数据动态渲染状态列表
    $('#status').html(template('tmp-state', state));
   
    //  别名同步
    $('#slug').on('input', function () {
        $('#strong').text($(this).val() || 'slug');
    });
    //  本地预览图片
    $('#feature').on('change', function () {
        var file = this.files[0];
        if (file) {
            $('#img').attr('src', URL.createObjectURL(file) ).show();
        }
    })
    //  时间格式化
    $('#created').val(moment().format('YYYY-MM-DDTHH:mm'));

     //  准备富文本编辑器
     var E = window.wangEditor;
     var editor = new E('#content-box');
     editor.customConfig.onchange = function (html) {
        $('#content').val(html);
    }
     editor.create();


    // 把点击文章渲染在页面
    $('tbody').on('click', '.btn-edit', function () {
        var id = $(this).parent().attr('data-id'); 
        $.ajax({
            url:'./post/postGetById.php',
            data: {id: id},
            dataType: 'json',
            success:function (info) {       
                $('.edit-box').show();    
                $('#title').val(info.title);
                $('#slug').val(info.slug);
                $('#strong').text(info.slug);
                $('#img').attr('src', '../' + info.feature).show();               
                $('#created').val(moment(info.created).format('YYYY-MM-DDTHH:mm'));
                editor.txt.html(info.content);
                $('#content').val(info.content);
                $('#id').val(info.id);                
                $('#category option[value='+ info.category_id +']').prop('selected', true);
                $('#status option[value='+ info.status +']').prop('selected', true);
  
            }
        })
    })


    // 编辑放弃功能，隐藏模态框
    $('.btn-cancel').click(function () {
        $('.edit-box').hide();
    });

    // 保存修改后的数据
    $('.btn-update').click(function () {
        var  fd = new FormData( $('#editForm')[0] );
        $.ajax({
            url: './post/postUpdate.php',
            type: 'post', 
            data: fd,
            contentType: false,
            processData: false, 
            success:function (info) {         
                $('.edit-box').hide(); 
                render(currentPage);
            }
        })

    });
    </script>
</body>

</html>