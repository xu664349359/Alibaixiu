<?php
    include_once '../inc/fn.php';

    $id = $_GET['id'];

    $sql = "delete from users where id = $id";

        if( my_query($sql)){
            echo 'success!';
        }else{
            echo 'error';
        }


?>