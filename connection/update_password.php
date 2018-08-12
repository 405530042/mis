<?php
include('./connect/session.php');
if(isset($_POST['change_password'])){
    if(empty($_POST['old'])||empty($_POST['new'])||empty($_POST['check'])){
        $errorchange="欄位為空";
    }
    else if(empty($_POST['new'])==empty($_POST['check'])){
        $pd = htmlspecialchars($_POST['old']);
        $password = htmlspecialchars($_POST['new']);
        $user_id = $row['id'];
        $old_pd = $row['password'];
        if($old_pd == $pd){
             $stmt = $conn->prepare("update member set password = ? where id = ?");
        $stmt->bind_param('si', $password, $user_id);
        $stmt->execute();
        $stmt->close();
            $error = 2;
            $_SESSION['error'] = 2;
            // header("Location: ./connect/error.php");
        }
        else{
              $_SESSION['error'] = 3;
           //  header("Location: ./connect/error.php");
              echo '3';
            }
        }
         else{
              $_SESSION['error'] =4;
                        echo '4';
               // header("Location: ./connect/error.php");
                    }

}
?>