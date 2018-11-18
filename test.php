<?php
    fuction my_query($sql){

    
  $link = mysqli_connect('127.0.0.1','root','123456','itcast',3306);
    if(!$link){
        echo '数据库连接失败了';
        // return false;
    }
     $sql = select * from users;
     $ext = mysqli_query($link,$sql);
    if(!$ext || mysqli_num_rows($ext) == 0){
        echo '未查到数据';
        mysqli_close($link);
        return false;
    }
    
    for($i = 0; $i < mysqli_num_rows($ext);$i++){
        $data[]= mysqli_fetch_assoc($ext);

    }
    // return $ext;
    mysqli_close($link);
    return $data;
}  
//     mysqli_close($link);
    
// //   $ext =  my_query($sql);
// echo '<pre>';
// print_r($ext);
// echo '</pre>';
 ?>
