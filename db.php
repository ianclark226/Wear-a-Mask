<?php 

$sName = "z3iruaadbwo0iyfp.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$uName = "igmlyd8htakal9xn";
$pass = "nniy3j9tftqsoazp";
$db_name = "o4tss27t3p9u0ssv";

try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", 
                    $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $e){
  echo "Connection failed : ". $e->getMessage();
}

