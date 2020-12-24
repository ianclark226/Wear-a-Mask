<?php

if(isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['store'])){
    require '../db.php';

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $store = $_POST['store'];

    if(empty($first_name || $last_name || $email || $store)){
        header("Location: ../index.php?mess=error");
    }else {
        $stmt = $conn->prepare("INSERT INTO slacker(first_name, last_name, email, store) VALUES(:first_name, :last_name, :email, :store)");
        $stmt->execute(array (':first_name' => $first_name,':last_name' => $last_name,':email' => $email,':store' => $store
    ));

    if($stmt){
        header("Location: ../index.php?mess=success"); 
    }else {
        header("Location: ../index.php");
    }
    $conn = null;
    exit();
    }
    
} else {
    header("Location: ../index.php?mess=error");
}