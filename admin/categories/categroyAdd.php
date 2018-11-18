<?php
    include_once '../inc/fn.php';
    $name = $_GET['name'];

    $slug = $_GET['slug'];

    $sql = "insert   into categories (name,slug) values ('$name','$slug')";

   if(my_exec($sql)){
       echo 'success!';
   }else{
       echo 'error!';
   }

?>