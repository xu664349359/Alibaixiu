<?php
        include_once '../inc/fn.php';

        $id = $_GET['id'];

        $sql = "select * from options where id = 10";

         $date = my_query($sql)[0][value];

        $date = json_decode($data,true);

       $arr = array_splice($date,$id,1);

        $str =  json_encode($arr);
        $sql1 = "update options set value = '$str' where id = 10";

        my_exec($sql1);

    //    echo '<pre>';
    //    print_r($arr);
    //    echo '</pre>';

?>