<?php
    include_once '../inc/fn.php';
    $id = $_GET['id'];
    $name = $_GET['name'];
    $slug = $_GET['slug'];
    // echo '<pre>';
    // print_r($_GET);
    // echo '</pre>';

     $sql = "update categories set name = '$name',slug = '$slug' where id = $id ";
    
        if( my_exec($sql)){
            echo 'success!';
        }else{
            echo 'error!';
        }

?>