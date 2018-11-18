<?php
     include_once '../inc/fn.php';

      $id = $_GET['id'];
    
     $sql = "delete from posts where id in ($id)";

        my_exec($sql);

        $sql1 = "select count(*) as tatol from posts join categories on posts.category_id = categories.id 
        join users on posts.user_id = users.id";

         $date = my_query($sql1)[0];
          echo json_encode($date);

        // echo '<pre>';
        // print_r($date);
        // echo '</pre>';
?>