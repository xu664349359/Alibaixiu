<?php
    include_once 'admin/inc/fn.php';

    $sql = "select value from options where id = 10";

      $data =  my_query($sql)[0]['value'];

      echo $data;
>