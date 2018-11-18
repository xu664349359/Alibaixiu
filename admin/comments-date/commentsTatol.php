<?php
  include_once '../inc/fn.php';

  $sql = "select count(*) as tatol from comments join posts on comments.post_id = posts.id";

  $date = my_query($sql)[0];

    // echo '<pre>';
    // print_r($date);
    // echo '</pre>';
    echo json_encode($date);





?>