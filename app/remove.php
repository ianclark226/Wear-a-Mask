<!-- DELETE REQUEST -->

<?php

if(isset($_POST['id'])){
    require '../db.php';

    $id = $_POST['id'];

// IF THERE IS NO ID, IT CAN NOT BE DELETED FROM DATABASE

    if(empty($id)){
       echo 0;
    }else {
        $stmt = $conn->prepare("DELETE FROM slacker WHERE id=?");
        $res = $stmt->execute([$id]);

        if($res){
            echo 1;
        }else {
            echo 0;
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}