<?php
include_once './inc/fn.php';
  state();






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
        <h1>所有评论</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <div class="btn-batch pull-left " style="display: none ">
          <button class="btn btn-info btn-sm  all-proved">批量批准</button>
          
          <button class="btn btn-danger btn-sm all-delete">批量删除</button>
        </div>
        <div class="pull-right " id = "page-box">
        
        </div>
        
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox" class = "th-checkbox"></th>
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
  <?php $page = 'comments' ?>
   <?php include_once './inc/aside.php'?>
   <script type = "text/html" id = "tmp">
   {{ each list v i}}
          <tr>
            <td class="text-center"date-id = {{v.id}}><input type="checkbox" class= "tb-checkbox"></td>
            <td>{{ v.author }}</td>
            <td>{{ v.content.substr(0,20)+'....' }}</td>
            <td>《{{ v.title }}》</td>
            <td>{{ v.created }}</td>
            <td>{{state[v.status] }}</td>
            <td class="text-right" hahaid = {{v.id}}>
              {{if v.status === 'held'}}
              <a href="#" class="btn btn-info btn-xs btn-approved">批准</a>
              {{/if}}
              <a href="javascript:;" class="btn btn-danger btn-xs btn-delete">删除</a>
            </td>
          </tr>
    {{ /each }}

   
    </script>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="../assets/vendors/template/template-web.js"></script>
  <script src="../assets/vendors/分页/jquery-plugin-pagination/jquery-plugin-pagination-zh/jquery.pagination.js"></script>

  <script>NProgress.done()</script>

  <script>

      var state = {
        held:'待审核',
        approved:'准许',
        rejected:'拒绝',
        trashed:'回收站'
      }
      //记录仪当前页
      var currentPage = 1;
      //评论数据渲染
    function render(page){
      $.ajax({
        url:'./comments-date/commentsGet.php', 
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
        var listStr =  template('tmp',obj);
          $('tbody').html(listStr);
          $('.th-checkbox').prop('checked',false);
          $('.btn-batch').hide();


        }
        
      })
    }
    render();
    //分页功能数据渲染
    function setPage(page){
      console.log(22222)
      $.ajax({
        url:'./comments-date/commentsTatol.php',
        date:'get',
        dataType:'json',
        success:function(info){
          console.log(info)
          $('#page-box').pagination(info.tatol,{
            prev_text:'前一页',
            next_text:'下一页',
            current_page: page - 1 || 0,
            num_display_entries:5,
            num_edge_entries:1,
            load_first_page:false,
            callback:function(index){
              render(index+1);
              currentPage = index + 1;
              console.log(index,currentPage,1111)
            }
          })


        }
      })


    }
    setPage();
    //批准按钮数据功能实现
    //ajax是异步请求，所以数据没渲染成功之前，后面代码已经执行完毕！
    // console.log('我是猪');
    //所以为批准按钮绑定点击事件，必须使用事件委托绑定
    $('tbody').on('click','.btn-approved',function(){
      var id = $(this).parent().attr('hahaid');

        $.ajax({

          url:'./comments-date/commentsChange.php',
          type:'get',
          data:{ id :id },
          // dataType:'json',
          success:function(info){
            console.log(info);
            render(currentPage);

          }
        })





    })
    //删除事件
    //和批准一样，都是动态生成的，所以需要事件委托
    $('tbody').on('click','.btn-delete',function(){

      var id = $(this).parent().attr('hahaid');

          $.ajax({

            url:'./comments-date/deleteCmments.php',
            type:'get',
            data:{ id :id },
            // dataType:'json',
            success:function(info){
              console.log(info.tatol);
              console.log(currentPage)
              var maxPage = Math.ceil(info.tatol / 10);
              console.log(maxPage)
              if(currentPage > maxPage){
                console.log(1)
                currentPage = maxPage;
              }
              render(currentPage);
              setPage(currentPage);
              

        }
      })

    })
    //批量批准和批量删除
    $('.th-checkbox').change(function(){
      var value = $(this).prop('checked');
      console.log(value);
      $('.tb-checkbox').prop('checked',value);
      if(value == true){
        $('.btn-batch').show();
      }else{
        $('.btn-batch').hide();

      }

    })
    //检测tbody中的多选框，因为是动态渲染生成的，所以需要委托事件。
    $('tbody').on('change','.tb-checkbox',function(){
      // console.log($('.tb-checkbox').length);
      // console.log($('.tb-checkbox:checked').length);

      if ($('.tb-checkbox:checked').length == $('.tb-checkbox').length) {
        $('.th-checkbox').prop('checked',true);
      }else{
        $('.th-checkbox').prop('checked',false);
      }   
      if($('.tb-checkbox:checked').length > 0){
        $('.btn-batch').show();
      }else{
        $('.btn-batch').hide();

      }               
      
    })
       function getId(){
         var ids = [];
         $('.tb-checkbox:checked').each(function(index,item){
           ids.push($(item).parent().attr('date-id'));


         })
          return ids.join();
       }
       //批量批准
       $('.all-proved').click(function(){
        var ids = getId();
          $.ajax({
            url:'./comments-date/commentsChange.php',
            type:'get',
            data:{id :ids},
            success:function(){
                render(currentPage);


            }
          })
       

        
       })
       //批量删除
       $('.all-delete').click(function(){
         var ids = getId();
            $.ajax({
              url:'./comments-date/deleteCmments.php',
              type:'get',
              data:{id:ids},
              dataType:'json',
              success:function(info){
                console.log(info);
                var maxPage = Math.ceil(info.tatol/10);
                if(currentPage > maxPage){
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
