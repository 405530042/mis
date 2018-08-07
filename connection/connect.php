<?php
$server = "localhost"; 
$user = "root";        
$password = "";
$db = "display";
   
 $conn = new mysqli($server,$user,$password,$db);
 mysqli_query($conn,"set names utf8");
?>