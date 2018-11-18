<?php

include_once '../inc/fn.php';
    $title = $_POST['title'];
    $content = $_POST['content'];
    $slug = $_POST['slug'];
    $category = $_POST['category'];
    $created = $_POST['created'];
    $status = $_POST['status'];
    $feature = '';
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    // $feature = $_POST['feature']
    // echo '<pre>';
    // print_r($_FILES);
    // echo '</pre>';

    $file = $_FILES['feature'];
    if($file['error'] === 0){

        $ext = strrchr($file['name'],'.');
        $newname ='uploads/'.time().rand(1000,9999). $ext;
        move_uploaded_file($file['tmp_name'],'../../'.$newname);
        $feature = $newname;

    }
    session_start();
    $usersid = $_SESSION['user_id'];

    $sql = "insert into posts (slug,feature,created,content,status,user_id,category_id,title)
    values('$slug', '$feature','$created','$content','$status', $usersid,$category,'$title')";

    // if(my_exec($sql)){
    //     echo 'success!';
    //      header('location: ../posts.php');
    // }else{
    //     echo 'error';
    my_exec($sql);
    // }
    header('location: ../posts.php');

   
?>