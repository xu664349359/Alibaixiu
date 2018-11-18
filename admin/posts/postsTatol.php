<?php
    include_once '../inc/fn.php';

        $sql = " select count(*) as tatol from posts
                join categories on posts.category_id = categories.id
                join users on posts.user_id = users.id ";
        
            $date = my_query($sql)[0];
                    
            // echo '<pre>';
            // print_r($date);
            // echo '</pre>';
            echo json_encode($date);

?>