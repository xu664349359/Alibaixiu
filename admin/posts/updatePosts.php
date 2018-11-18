<?php
    include_once '../inc/fn.php';
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $slug = $_POST['slug'];
    $category = $_POST['category'];
    $created = $_POST['created'];
    $status = $_POST['status'];
    $feature = '';

    $file = $_FILES['feature'];
    if($file['error']===0){
        $ext = strrchr($file['name'],'.');
        $newName ='uploads/'. time().rand(1000,9999).$ext;
        move_uploaded_file($file['tmp_name'],'../../'+$newName);
        $feature = $newName;
    }
     if(empty($feature)){

        $sql = "update posts set title = '$title',content = '$content',slug = '$slug',category_id = $category,created = '$created',status = '$status' where id = $id ";
        
    }else{
      $sql = "update posts set title = '$title',content = '$content',slug = '$slug',category_id = $category,created = '$created',status = '$status',feature ='$newName' where id = $id ";
    }
    if(my_exec($sql)){
        echo 'success!';

    }else{
        echo 'error!';
    }


?>