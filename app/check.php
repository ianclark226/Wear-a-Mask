<?php

if(isset($_POST['id'])){
    require '../db.php';

    $id = $_POST['id'];
    

    if(empty($id)){
        echo 'error';
    }else {
       $slackers = $conn->prepare("SELECT id, checked FROM slacker WHERE id=?");
       $slackers->execute([$id]);

       $slacker = $slackers->fetch();
       $uId = $slacker['id'];
       $checked = $slacker['checked'];

       $uChecked = $checked ? 0 : 1;

       $res = $conn->query("UPDATE slacker SET checked=$uChecked WHERE id=$uId");

       if($res){
           echo $checked;

       } else {
           echo "error";
       }

    $conn = null;
    exit();
    }
    
} else {
    header("Location: ../index.php?mess=error");
}