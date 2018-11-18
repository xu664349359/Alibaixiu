<?php
    include_once '../inc/fn.php';

    $id = $_GET['id'];

    $sql = "select * from categories where id = $id";

   $data = my_query($sql)[0];
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
    echo json_encode($data);
?>