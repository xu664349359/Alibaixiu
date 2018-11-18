<?php
    include_once '../inc/fn.php';
        $page = $_GET['page'];
        $pageSize = $_GET['pageSize'];
    $start = ($page - 1) * $pageSize; 
    $sql =  "select posts.*, users.nickname, categories.name from posts 
            join users  on posts.user_id = users.id  -- 联合用户表  查用户名 
            join categories on posts.category_id = categories.id -- 联合分类表 查询分类名称
            order by posts.id desc -- 根据文章id进行排序 
            limit $start, $pageSize -- 一页10条件   limit 起始索引， 截取长度";
    

    // 0    1   1-10
    // 10    2   11-20
    // 20    3  21-30
    // 30    4   31-40
    $date = (my_query($sql));
    echo json_encode($date);
?>
   
    