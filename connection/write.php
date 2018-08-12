<?php
require("../../connection/connect.php");

session_start();

$user_check=$_SESSION['login_user'];
$ses_sql=mysql_query("select * from members where account like '$user_check'");
$row=mysql_fetch_assoc($ses_sql);
$user_id=$row['id'];
$account=$row['account'];
$name=$row['name'];
if(!isset($user_id)){
    mysql_close($connection);
    header("location: ../../login.html");
}
else if(isset($_POST['back'])){
    header("location: ../login_myarticle.php");
}
else if(isset($_POST['save'])){
    if(empty($_POST['title']) ||empty($_POST['article'])||empty($_POST['year'])||empty($_POST['month'])||empty($_POST['day'])){
        $error="有些欄位是空的";
    }
    else{
        $title = $_POST['title'];
        $article = $_POST['article'];
        $article_type = $_POST['article_type'];
        $year =$_POST['year'];
        $month = $_POST['month'];
        $day = $_POST['day'];
        date_default_timezone_set('Asia/Taipei');
        $time = date("Y-m-d H:i:s");
        mysql_query("insert into articles value(NULL,'$user_id','$article_type','$title',NULL,'$article','$year','$month','$day','$time','$time','0')");
        header("location: ../login_myarticle.php");
    }
}
?>