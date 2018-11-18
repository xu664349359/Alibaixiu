<?php

    include_once '../inc/fn.php';

    $sql = "select * from categories";

    $data =  my_query($sql);
    
    echo json_encode($data);


?>