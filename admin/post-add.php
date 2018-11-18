
<?php
include_once './inc/fn.php';
  state();

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
        <h1>写文章</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="row" action = "./posts/postsAdd.php" method="post" enctype="multipart/form-data">
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
          </div>
          <div class="form-group">
            <label for="content">标题</label>
            <textarea id="content" class="form-control input-lg" name="content" cols="30" rows="10" placeholder="内容" style = display:none></textarea>
          </div>
          <div id="content-editor"></div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="slug">别名</label>
            <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
            <p class="help-block">https://zce.me/post/<strong id="slug2">slug</strong></p>
          </div>
          <div class="form-group">
            <label for="feature">特色图像</label>
            <!-- show when image chose -->
            <img class="help-block thumbnail img" style="display: none">
            <input id="feature" class="form-control" name="feature" type="file" accept = "image/*">
          </div>
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control select-classify" name="category">
              <option value="1">未分类</option>
              <option value="2">潮生活</option>
            </select>
          </div>
          <div class="form-group">
            <label for="created">发布时间</label>
            <input id="created" class="form-control" name="created" type="datetime-local">
          </div>
          <div class="form-group">
            <label for="status">状态</label>
            <select id="status" class="form-control " name="status">
              <option value="drafted">草稿</option>
              <option value="published">已发布</option>
            </select>
          </div>
          <div class="form-group">
            <button class="btn btn-primary" type="submit">保存</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php $page = 'post-add' ?>
   <?php include_once './inc/aside.php'?>
   <script type=text/html id = "tmp">
   {{each list v}}
   <option value="{{v.id}}">{{v.name}}</option>
   {{/each}}
   </script>
   <script type = "text/html" id ="tmp-status">
     {{ each $data v k}}
       <option value="{{k}}">{{ v }}</option>
     {{ /each }}
   </script>
  <script src= "../assets/vendors/template/template-web.js"></script>
  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src = "../assets/vendors/moment/moment.js"></script>
  <script src="../assets/vendors/wangEditor/wangEditor.js"></script>
  <script>NProgress.done()</script>

  <script>
        //分类部分
          $.ajax({
            url:'./posts/classifyposts.php',
            dataType:'json',
            success:function(info){
              console.log(info);
            str = template('tmp',{list:info})
            $('.select-classify').html(str);
            }
          })
        //状态栏的渲染
        var state = {
          trashed:'回收站',
          published:'已发布',
          drafted:'草稿'
          }
      // var statusStr = template('tmp-status',status)
      $('#status').html( template('tmp-status', state));
    // console.log(statusStr);
          // $('#slug').input(function(){

          // var result  =  $(this).val();

          // $('#slug2').text(result);
          // })
          //别名同步渲染
          $('#slug').on('input',function(){

            var result  =  $(this).val();
            // if(result === ''){
            //   $('#slug2').text('slug');
            // }else{
              $('#slug2').text(result || 'slug');
            // }
         
          })
          //时间创建渲染
          $('#created').val(moment().format('YYYY-MM-DDTHH:mm'));
          //图像渲染
          $('#feature').change(function(){
              var file = $(this)[0].files[0];
            var url =  URL.createObjectURL(file);
            
            $('.img').attr('src',url).show();



          })
          //文本输入框渲染
          var E = window.wangEditor
            var editor = new E('#content-editor');
            // 或者 var editor = new E( document.getElementById('editor') )
            var $text1 = $('#content');
            editor.customConfig.onchange = function (html) {
            // 监控变化，同步更新到 textarea
            $text1.val(html);
          }
            editor.create();

           $text1.val(editor.txt.html());




  
  </script>
</body>
</html>
