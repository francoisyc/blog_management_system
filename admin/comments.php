<?php
include_once '../fn.php';
isLogin();
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>Comments &laquo; Admin</title>
    <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/vendors/pagination/pagination.css">
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
                <h1>所有评论</h1>
            </div>
           
            <div class="page-action">
           
                <div class="btn-batch pull-left" style="display: none">
                    <button class="btn btn-info btn-sm btn-apps">批量批准</button>                 
                    <button class="btn btn-danger btn-sm btn-dels">批量删除</button>
                </div>
                <!-- 分页容器 -->
                <div class="page-box pull-right">

                </div>
            </div>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center" width="40"><input class="th-chk" type="checkbox"></th>
                        <th>作者</th>
                        <th>评论</th>
                        <th>评论在</th>
                        <th>提交于</th>
                        <th>状态</th>
                        <th class="text-center" width="100">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center"><input type="checkbox"></td>
                        <td>大大</td>
                        <td>楼主好人，顶一个</td>
                        <td>《Hello world》</td>
                        <td>2016/10/07</td>
                        <td>未批准</td>
                        <td class="text-center">
                            <a href="post-add.html" class="btn btn-info btn-xs">批准</a>
                            <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- 给页面添加标记 -->
    <?php $page = 'comments'?>
    <!-- 引入侧边栏 -->
    <?php include_once './inc/aside.php'?>

    <!-- 模版 -->
    <script type="text/html" id="tmp">
    {{ each list v i }}
        <tr>
            <td class="text-center" data-id={{ v.id }} ><input class="tb-chk" type="checkbox"></td>
            <td>{{ v.author }}</td>
            <td>{{ v.content.substr(0, 20) + '...' }}</td>
            <td>《{{ v.title }}》</td>
            <td>{{ date(v.created) }}</td>
            <td>{{ state[v.status] }}</td>
            <td class="text-right" data-id={{ v.id }}>
                {{ if v.status == 'held' }}
                <a href="javascript:;" class="btn btn-info btn-xs btn-app">批准</a>
                {{ /if }}
                <a href="javascript:;" class="btn btn-danger btn-xs btn-del">删除</a>
            </td>
        </tr>
    {{ /each }}
    </script>

    <script src="../assets/vendors/jquery/jquery.js"></script>
    <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script src="../assets/vendors/template/template-web.js"></script>
    <script src="../assets/vendors/pagination/jquery.pagination.js"></script>

    <script>
    NProgress.done()
    </script>
    <script>

    var state = {
        held: '待审核',
        approved: '准许',
        rejected: '拒绝',
        trashed: '回收站'
    }
    
    var  currentPage = 1; 
    // 封装请求数据并渲染
    function render(page) {
        $.ajax({
            url: './comment/comGet.php',
            data: {
                page: page || 1,
                pageSize: 10
            },
            dataType: 'json',
            success: function(info) {
                var obj = {
                    list: info,
                    state: state,
                    date: function(d) {
                        return d.split(' ')[0].replace('-', '/').replace('-', '/');
                    }
                };
                $('tbody').html(template('tmp', obj));
                $('.th-chk').prop('checked', false); 
                $('.btn-batch').hide(); 
            }
        })
    }
    // 获取第一屏的数据并渲染
    render();

    // 分页功能
    function setPage(page) {
        $.ajax({
            url: './comment/comTotal.php',
            dataType: 'json',
            success: function(info) {
                $('.page-box').pagination(info.total, {
                    prev_text: '上一页',
                    next_text: '下一页',
                    num_display_entries: 5, 
                    num_edge_entries: 1, 
                    current_page: page - 1 || 0, 
                    load_first_page: false,
                    callback: function(index) {  
                        render(index + 1);
                        currentPage = index + 1;
                    }
                });
            }
        })
    }
    // 生成分页
    setPage();

    //批准评论
    $('tbody').on('click', '.btn-app', function () {
        var id = $(this).parent().attr('data-id');
        $.ajax({
            url: './comment/comApproved.php',
            data: {id: id},
            success: function () {
                render(currentPage);
            }
        })
       
    })

    
    // 删除评论
    $('tbody').on('click', '.btn-del', function () {
        var id = $(this).parent().attr('data-id'); 
        $.ajax({
            url:'./comment/comDel.php',
            data: {id: id},
            dataType: 'json',
            success:function (info) {
                var maxPage = Math.ceil(info.total / 10);
                if (currentPage > maxPage) {
                    currentPage = maxPage;
                }
                render(currentPage);
                setPage(currentPage);
            }
        })
    });


    // 全选功能
    $('.th-chk').on('change', function () {
        var value = $(this).prop('checked');
        $('.tb-chk').prop('checked', value);
        if (value) {
            $('.btn-batch').show();
        } else {
            $('.btn-batch').hide();
        }
        

    });

    // 多选功能功能
    $('tbody').on('change', '.tb-chk', function () {
        if($('.tb-chk:checked').length == $('.tb-chk').length) {
            $('.th-chk').prop('checked', true);
        } else {
            $('.th-chk').prop('checked', false);
        }
        if ($('.tb-chk:checked').length > 0) {
            $('.btn-batch').show();
        } else {
            $('.btn-batch').hide();
        }
            
    })

    // 获取别选中数据id
    function getId() {
        var ids = []; 
        $('.tb-chk:checked').each(function (i, ele) {
           var id =  $(ele).parent().attr('data-id');
           ids.push(id); 
       })
       return ids.join();       
    }


    // 批量批准
    $('.btn-apps').click(function () {
        var ids = getId();
        $.ajax({
            url: './comment/comApproved.php',
            data:{id: ids},
            success: function () {
                render(currentPage);
            }
        })
    });

 
    // 批量删除功能：
    $('.btn-dels').click(function () {
        var ids = getId();
        $.ajax({
            url: './comment/comDel.php',
            data: {id: ids},
            dataType: 'json',
            success: function (info) {
                console.log(info);
                var maxPage = Math.ceil(info.total/10); 
                if (currentPage > maxPage) {
                    currentPage = maxPage;
                }
                render(currentPage);
                setPage(currentPage);               
            }
        })
    })
    



    
    </script>
</body>

</html>