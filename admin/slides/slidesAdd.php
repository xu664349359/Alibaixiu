<?php
header('content-type:text/html;charset=utf-8');

    include_once '../inc/fn.php';

        
        $info['image'] = '';

    $file = $_FILES['image'];
    // echo '<pre>';
    // print_r($_FILES);
    // echo '</pre>';


    if($file['error'] === 0){

       $ext = strrchr($file['name'],'.');

       $newName = 'uploads/'.time().rand(1000,9999).$ext;

       move_uploaded_file($file['tmp_name'],'../../'.$newName);

       $info['image'] = $newName;

        $info['text'] = $_POST['text'];

        $info['link'] = $_POST['link'];

    $sql = "select value from options where id = 10 ";

        $str = my_query($sql)[0]['value'] ;

        $arr = json_decode($str,true);

   


        $arr[] = $info;

        $str = json_encode($arr,JSON_UNESCAPED_UNICODE);

        $sql = "update options set value = '$str' where id =10 ";

      if(my_exec($sql)){
          echo 'success!';
      }else{
          echo 'error!';
      }
        // echo '<pre>';
        // print_r($str);
        // echo '</pre>';

}


?>