<?php
  include_once './inc/fn.php';
  if(!empty($_POST)){
     $email =  $_POST['email'];
    $psw = $_POST['password'];
    if(empty($email)||empty($psw)){
      $msg = '用户名或密码为空';
    }else{
      $sql = "select * from users where email = '$email' ";
      $date = my_query($sql);
      
      if(empty($date)){
        $msg = '用户名不存在';

      }else{
        $date = $date[0];
        if($psw == $date['password']){
          session_start();
          $_SESSION['user_id'] = $date['id'];
          header('location:./index1.php');
        }else{
          $msg = '密码错误';
        }
      }
    }
    
    // 根据用户输入的用户名去查询数据库中对应密码  如果结果为空 说明用户名不存在 到此结束  

    


  }
   
    // if($email === ''){
    //   $msg = '请输入用户名';
    // }
    // if($psw === ''){
    //   $msg = '请输入密码';
    // }




?>



<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
  <div class="login">
    <form class="login-wrap" action = "login.php" method = "post" >
      <img class="avatar" src="../assets/img/default.png">
      <!-- 有错误信息时展示 -->
      <?php  if(!empty($msg)){ ?>
      <div class="alert alert-danger">
        <strong>错误！</strong> <?php echo "$msg" ?>
      </div>
      <?php } ?>
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email"
         type="email" 
          name = "email" 
          class="form-control"
           placeholder="邮箱" 
           value  = "<?php echo !empty($msg)?$email:'' ?>"

           autofocus>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password" type="password" name = "password"  class="form-control" placeholder="密码">
      </div>     
      <input  class="btn btn-primary btn-block" type="submit" value="登录">
    </form>
  </div>
</body>
</html>
