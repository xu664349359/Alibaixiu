<?php
    include_once '../inc/fn.php';
    $id = $_GET['id'];
        $sql = "delete from comments where id in ($id)";

       my_exec($sql);

    //    echo 'true'
     
       $sql1 = "select count(*) as tatol from comments join posts on comments.post_id = posts.id";

       $date = my_query($sql1)[0];
     
         // echo '<pre>';
         // print_r($date);
         // echo '</pre>';
         echo json_encode($date);
     
     

?>