<?php
    include_once '../inc/fn.php';

    $id = $_GET['id'];

    $sql = "select * from posts where id = $id";

       $data = my_query($sql)[0];

        echo json_encode($data);
    // echo '<pre>';
    // print_r($_GET);
    // echo '</pre>';
?>