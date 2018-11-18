<?php
    include_once '../inc/fn.php';

    $slug = $_GET['slug'];
    $email = $_GET['email'];
    $psd = $_GET['password'];
    $nickname = $_GET['nickname'];

    $sql = "insert   into users (slug,email,password,nickname) values ('$slug',  '$email','$psd','$nickname')";

   if( my_exec($sql)){
       echo 'success!';
   }else{
       echo 'error!';
   }
?>