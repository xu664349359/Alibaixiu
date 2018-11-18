<?php
    include_once '../inc/fn.php';

    $page = $_GET['page'];
    $pageSize = $_GET['pageSize'];

    $start = ($page - 1) * $pageSize;

    $sql = "select comments.* , posts.title from comments join posts on comments.post_id = posts.id order by comments.id limit $start,$pageSize";
    
    

    //页数 = （  ）

   $date = my_query($sql);

    echo json_encode($date);

?>