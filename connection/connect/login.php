<?php
require('connect.php');
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['password']) || trim($_POST['password']) == ''){
        echo 'password_empty';
    }else if (!isset($_POST['username']) || trim($_POST['username']) == ''){
        echo 'username_empty';
    }else{
        $user = $_POST['username'];
        $password = $_POST['password'];
        $query=mysqli_query($conn,"select * from member where password like '$password' AND number like '$user'");
        $rows = mysqli_num_rows($query);
        if($rows == 1){
            session_start();
            $_SESSION['login_user']=$user;
            header("Location:./success.php");
        }
        else {

                header("Location:./error.php");
             
            
        }
        mysqli_close($conn);
    }
}
?>