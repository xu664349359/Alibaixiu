<?php
//封装php 操作数据库的工具函数


//封装非查询语句
// 连接数据库
function my_exec($sql){

    $link = mysqli_connect('127.0.0.1','root','root','zbaixiu');

    if(!$link){
        echo '数据库连接失败了';
        return false;
    }
    if(!mysqli_query($link,$sql)){
        echo '执行失败了';
        mysqli_close($link);
        return false;
    }
    mysqli_close($link);
    return true;
}
// $sql = "delete from posts where id = 63 ";

// my_exec($sql);


// 准备sql语句
// 执行语句
// 关闭数据库


// 查询语句封装

function my_query($sql){
 $link =  mysqli_connect('127.0.0.1','root','root','zbaixiu');
 if(!$link){
    echo '数据库连接失败了';
    return false;
}
$res = mysqli_query($link,$sql);
if(!$res || mysqli_num_rows($res) == 0 ){
    echo '未获取到数据';
    mysqli_close($link);    
    return false;
}
    // $date = [];
    for($i = 0;$i < mysqli_num_rows($res);$i++){

        $date[]= mysqli_fetch_assoc($res);
    }
        mysqli_close($link);
        return $date;

   



}

// $sql = "select * from users ";

// $date = my_query($sql);
// echo '<pre>';
// print_r($date);
// echo '</pre>';

// echo '<pre>';
// print_r($res);
// echo '</pre>';
// mysqli_close($link);
// }

//关闭数据库

//  $link = mysqli_connect('127.0.0.1','root','root','zbaixiu', 3306);
 
//  $sql = "select * from users where id = 2";

//  $res = mysqli_query($link,$sql);
 
//   echo '<pre>';
//   print_r($res);
//   echo '</pre>';

//   mysqli_close($link);
    function state(){
        if(empty($_COOKIE['PHPSESSID'])){
            header('location:./login.php');
        }else{
          session_start();
          if(empty($_SESSION['user_id'])){
            header('location:./login.php');
        
          }
     } 
    }
?>
