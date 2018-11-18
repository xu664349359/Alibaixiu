<?php
include_once './inc/fn.php';
  state();

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
  <link rel="stylesheet" href="../assets/vendors/分页/jquery-plugin-pagination/jquery-plugin-pagination-zh/pagination.css">
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
        <h1>所有文章</h1>
        <a href="post-add.php" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none" id="delete-all">批量删除</a>
        <div class="pull-right btn-page"></div>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox" id = "th-btn"></th>
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
  <?php $page = 'posts' ?>
   <?php include_once './inc/aside.php'?>
   <?php include_once './inc/edit.php'?>
  <script type = "text/html" id = "tmp-posts">
    {{each list v}}
          <tr>
            <td class="text-center" date-id = {{v.id}}><input type="checkbox" class="tb-btn" ></td>
            <td>{{v.title}}</td>
            <td>{{v.nickname}}</td>
            <td>{{v.name}}</td>
            <td class="text-center">{{v.created}}</td>
            <td class="text-center">{{state[v.status]}}</td>
            <td class="text-center" date-id ={{v.id}}>
              <a href="javascript:;" class="btn btn-default btn-xs" id = "editor">编辑</a>
              <a href="javascript:;" class="btn btn-danger btn-xs" id = "btnposts-delete">删除</a>
            </td>
          </tr>
    {{/each}}
  </script>
  <script type=text/html id = "tmp-category">
    {{each list v}}
    <option value="{{v.id}}">{{v.name}}</option>
    {{/each}}
    </script>
   <script type = "text/html" id ="tmp-status">
     {{ each $data v k}}
       <option value="{{k}}">{{ v }}</option>
     {{ /each }}
   </script>
  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="../assets/vendors/template/template-web.js"></script>
  <script src="../assets/vendors/分页/jquery-plugin-pagination/jquery-plugin-pagination-zh/jquery.pagination.js"></script>
  <script src="../assets/vendors/moment/moment.js"></script>
  <script src="../assets/vendors/wangEditor/wangEditor.js"></script>
  <script>NProgress.done()</script>

  <script>
          var state = {
            published :'已发布',
            trashed:'回收站',
            drafted:'草稿'
          }
          // 记录当前页
          var currentPage = 1; 
          //首页渲染
          function  postsRender(page){
            $.ajax({
              url:'./posts/Getposts.php', 
              type:'get',
              data:{
                page:page||1,
                pageSize :10
              },
              dataType:'json',
            success :function(info){
              console.log(info);
                var obj = {
                  list:info,
                  state:state
                }
              var listStr =  template('tmp-posts',obj);
                $('tbody').html(listStr);
                $('.th-checkbox').prop('checked',false);
                $('.btn-batch').hide();
                $('#th-btn').prop('checked',false);
                $('#delete-all').hide();


              }
        
      })
    }
    postsRender();

    //分页部分
    function setpostsPage(page){
          $.ajax({
            url:'./posts/postsTatol.php',
            // type:'post',
            dataType:'json',
            success:function(info){
              console.log(info);
              $('.btn-page').pagination(info.tatol,{
                // items_per_page:5,
                num_display_entries:5,
                num_edge_entries	:1,
                current_page:page -1||0,
                // prev_show_always:'上一页',
                // next_show_always: '下一页' ,
                prev_text:'上一页',
                next_text:'下一页',
                callback:function(index){
                  postsRender(index+1);
                  currentPage = index + 1;
                },
                load_first_page:false
              })

            }
          })



    }
    setpostsPage();
  
    $('tbody').on('click','#btnposts-delete',function(){
      // console.log(this);
      var id =  $(this).parent().attr('date-id');
        $.ajax({
          url:'./posts/deleteposts.php',
          // type:'get',
          data:{id:id},
          dataType:'json',
          success:function(info){
            // console.log(info);
            // console.log('haha');
            var maxPage  = Math.ceil(info.tatol/10);
            if(currentPage > maxPage){
              currentPage = maxPage;
            }
            postsRender(currentPage);
           setpostsPage(currentPage);
          }
        })


    })
  //批量删除
      $('#th-btn').click(function(){
        var i =  $(this).prop('checked');
          console.log(i);
          if(i == true){
            $('#delete-all').show();
            $('.tb-btn').prop('checked',true);
          }else{
            $('#delete-all').hide();
            $('.tb-btn').prop('checked',false);

          }
     
      })
      //tb 部分  因为是动态渲染形成的，所以需要事件委托
       $('tbody').on('click','.tb-btn',function(){

         
        var i = $('.tb-btn').length;
          console.log(i);
        // console.log($('.tb-btn').length);
        var i2 = $('.tb-btn:checked').length;
        console.log(i2);
          if(i === i2){
            $('#th-btn').prop('checked',true);
          }else{
            $('#th-btn').prop('checked',false);
          }
          if(i2 > 0){
            $('#delete-all').show();
          }else{
            $('#delete-all').hide();
          }
       })

       //获取删除的id
            // function getId(){
            //   var  ids = [];
            //     $('.tb-btn:checked').each(function(index,item){
            //     ids.push($(item).parent().attr('date-id'));
            //     })
            //     return ids;
            // }
              
       //批量删除动态渲染
        $('#delete-all').click(function(){

            // $('tb-btn').parent().attr('date-id');
             var ids = [];
              $('.tb-btn:checked').each(function(index,item){
               ids.push($(item).parent().attr('date-id'));
              })
              console.log(ids);
              ids = ids.join();

              $.ajax({
                  url:'./posts/deleteposts.php',
                  data:{id:ids},
                  dataType:'json',
                  success:function(info){
                    console.log('success!');
                    var maxPage = Math.ceil(info.tatol/10);
                    if(currentPage > maxPage){
                      currentPage = maxPage;
                    }
                    postsRender(currentPage);
                    setpostsPage(currentPage);

                  }
              })

        })
        //编辑部分
        //引进模板框架
        //第一先获取id值 获取相应的数据，然后渲染

      $.ajax({
                  url:'./posts/classifyposts.php',
                  dataType:'json',
                  success:function(info){
                    console.log(info);
                  str = template('tmp-category',{list:info})
                  $('#category').html(str);
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
    
          var E = window.wangEditor
              var editor = new E('#content-box')
              var $text1 = $('#content')
            
              editor.customConfig.onchange = function (html) {
                  // 监控变化，同步更新到 textarea
                  $text1.val(html)
              }
              editor.create()
              // 初始化 textarea 的值
              $text1.val(editor.txt.html())
        $('tbody').on('click','#editor',function(){

         var id =  $(this).parent().attr('date-id');
          $.ajax({
              url:'./posts/searchPosts.php',
              // type:'get',
              data:{id:id},
              dataType:'json',
              success:function(info){
                $('.edit-box').show();
                $('#slug').val(info.slug);
                $('#img').attr('src','../'+info.feature).show();
                $('#created').val(moment().format('YYYY-MM-DDTHH:mm'));
                $('#title').val(info.title);
                $('#slug').on('input',function(){
                  var i = $(this).val();
                  $('#strong').text(i);
                })
                
                editor.txt.text(info.content);
                $('#content').val(info.content);
                  $('#id').val(info.id);
                  $('#strong').text(info.slug);
                  $('#category option[value='+info.category_id+']').prop('selected',true);
                  $('#status option[value'+info.status+']').prop('selected',true);

              }

          })


        })
        //修改的步骤
        //1.利用ajax技术获取元素
        $('#btn-update').click(function(){
          var formData = new FormData($('#editForm')[0]);
            $.ajax({
              url:'./posts/updatePosts.php',
              type:'post',
              data:formData,
              // dataType:'json',
              contentType:false,
              processData:false,
              success:function(info){
                console.log(info);
                $('.edit-box').hide();
                postsRender(currentPage);

              }
            })
        })
          //放弃
        $('#btn-cancel').click(function(){

          $('.edit-box').hide();

        })
        
    
  
  
  </script>
</body>
</html>
