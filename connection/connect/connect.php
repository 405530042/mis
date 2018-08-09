<?php
$server = "localhost"; 
$user = "root";        
$password = "";
$db = "display";
 
//error_reporting(E_ALL || ~E_NOTICE); 
 $conn = new mysqli($server,$user,$password,$db);
 mysqli_query($conn,"set names utf8");
?>