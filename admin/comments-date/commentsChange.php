<?php
    include_once '../inc/fn.php';

        $id = $_GET['id'];

    $sql = "update comments set status = 'approved' where id in ($id) and status = 'held' ";

   if(my_exec($sql)){
    echo 'success!';

   }else{
       echo 'error!';
   }



?>