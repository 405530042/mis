<?php

$server = "localhost"; 

$user = "root";        

$password = "";

$db = "display";

 

// error_reporting(E_ALL || ~E_NOTICE); 

$conn = new mysqli($server, $user, $password, $db);

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}

mysqli_query($conn, "set names utf8");

?>