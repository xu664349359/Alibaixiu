<?php
    include_once '../inc/fn.php';

    $id = $_GET['id'];

    $sql = "delete from categories where id = $id";

   if( my_exec($sql)){
       echo 'success!';

   }else{
       echo 'error!';
   }

?>