<?php

        include_once '../inc/fn.php';

        $sql = "select * from users ";

     $data =  my_query($sql);
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        echo json_encode($data);
?>