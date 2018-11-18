<?php
include_once './inc/fn.php';
  state();

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
  <script>NProgress.start()</script>

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
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-4">
          <form id="formData">
            <h2>添加新分类目录</h2>
            <div class="form-group">
              <input type="hidden" name = "id" id="id" value="">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" placeholder="分类名称">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <p class="help-block">https://zce.me/category/<strong id = "strong">slug</strong></p>
            </div>
            <div class="form-group">              
              <input type="button" class="btn btn-primary btn-add" value="添加">
              <input type="button" class="btn btn-primary btn-update"  value="修改" style=display:none>
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
	<?php $page = 'categories' ?>
 <?php include_once './inc/aside.php'?>
  <script type="text/html" id= "tmp-category">
  {{each list v i}}
    <tr>
      <td class="text-center"><input type="checkbox"></td>
      <td>{{v.name}}</td>
      <td>{{v.slug}}</td>
      <td class="text-center" date-id="{{v.id}}">
        <a href="javascript:;" class="btn btn-info btn-xs btn-edit">编辑</a>
        <a href="javascript:;" class="btn btn-danger btn-xs btn-delete">删除</a>
      </td>
    </tr>
  {{/each}}  
  </script>
  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="../assets/vendors/template/template-web.js"></script>
  <script>NProgress.done()</script>
  <script>
  //首页渲染
  function render() {
    $.ajax({
        url:'./categories/cotegoryGet.php',
        dataType:'json',
        success:function(info){
            console.log(info);
          $('tbody').html(template('tmp-category',{list:info}));


         }
    })
 }
 render();
    //添加分类走位操作

    $('.btn-add').click(function(){

      $.ajax({
        url:'./categories/categroyAdd.php',
        data:$('#formData').serialize(),
        // dataType:'json',
        success:function(info){
          render();
        }
      })

    })
    //别名同步
    $('#slug').on('input',function(){
      $('#strong').text($(this).val());
    })
    //删除分类
    $('tbody').on('click','.btn-delete',function(){
        var id = $(this).parent().attr('date-id');
        $.ajax({
          url:'./categories/categoryDelete.php',
          data:{id:id},
          success:function(info){
            render();
          }
        })
    })
    //修改分类

    // 思路 1获取所属的id数据进行渲染
    $('tbody').on('click','.btn-edit',function(){
      var id = $(this).parent().attr('date-id');
      $.ajax({
          url:'./categories/categoryGetById.php',
          data:{id:id},
          dataType:'json',
          success:function(info){
            // render();
            console.log(info);
            $('.btn-add').hide();
            $('.btn-update').show();
            $('#name').val(info.name);
            $('#id').val(info.id);
            $('#slug').val(info.slug);
            $('#strong').text(info.slug);
            $('#strong').on('input',function(){
              $('#strong').text($('#slug').val());
            })

          }
        })
    })
    $('.btn-update').click(function(){
    
        $.ajax({
        url:'./categories/categoryUpdate.php',
        date:$('#formData').serialize(),
        // dataType:'json',
        success:function(info){
          console.log(info) ;
          $('.btn-add').show();
          $('.btn-update').hide();
          $('#formData')[0].reset();
          render();  
       }
      })
    })
    

    
  
  </script>
</body>
</html>
