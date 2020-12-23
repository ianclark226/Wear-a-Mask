<?php 

$uName = "root";
$pass = "";
$db_name = "slackers";

$db_name = new mysqli('localhost', $uName, $pass, $db_name) or die('unable to connect');

echo"greatwork";

