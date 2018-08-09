<?php
require("connect.php");
session_start();
date_default_timezone_set("Asia/Taipei");
$user_check=$_SESSION['login_user'];
$ses_sql=mysqli_query($conn,"select * from member where number like '$user_check'");
$row=mysqli_fetch_assoc($ses_sql);
$user_id=$row['authentication'];
$account=$row['number'];
$name=$row['name'];
$team=$row['team'];

// else if(isset($_POST['edit'])){
//     $article_id = $_POST['edit'];
//     $_SESSION['revision']=$article_id;
//     header("location: edit/editarticle.php");
// }
// else if(isset($_POST['delete'])){
//     $article_id = $_POST['delete'];
//     $article_query = mysql_query("select * from articles where id='$article_id'");
//     $result_query = mysql_fetch_assoc($article_query);
//     $download_files = $result_query['download_files'];
//     if($download_files == 1){
//         $picture_query = mysql_query("select * from files where author_id='$article_id'");
//         $picture_result = mysql_fetch_assoc($picture_query);
//         $replace_name = $picture_result['replace_name'];
//         $targetFolder = '/uploads';
//         $targetPath = $_SERVER['DOCUMENT_ROOT'].$targetFolder;
//         $targetFile = rtrim($targetPath,'/').'/files/'.$replace_name;
//         unlink($targetFile);
//         mysql_query("delete from files where author_id='$article_id'");
//     }
//     mysql_query("delete from articles where id='$article_id'");
//     header("location: login_myarticle.php");
// }
// else if(isset($_POST['submit'])){
//     if(empty($_POST['pd'])||empty($_POST['password'])){
//         $errorchange="欄位為空";
//     }
//     else{
//         $pd = $_POST['pd'];
//         $password = $_POST['password'];
//         $old_pd = $row['password'];
//         if($old_pd == $pd){
//             mysql_query("update members set password='$password' where id like '$user_id'");
//             $errorchange="已更改密碼";
//         }
//         else{
//             $errorchange = "舊密碼錯誤";
//         }
//     }
// }
?>