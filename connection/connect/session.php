<?php
require("connect.php");
require('prevent.php');

session_start();

date_default_timezone_set("Asia/Taipei");
$stmt = $conn->prepare("select * from member where number = ?");
$stmt->bind_param('s', $_SESSION['login_user']);
$stmt->execute();
$result = $stmt->get_result();
$row = mysqli_fetch_assoc($result);
$stmt->close();
$user_id = $row['authentication'];
$account = $row['number'];
$name = $row['name'];
$team = $row['team'];
$check=$row['update_check'];
$error=(isset($_SESSION['error'])) ? $_SESSION['error'] : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit'])) {
        $_SESSION['article_id'] = htmlspecialchars($_POST['edit']);
        header("location: ./edit/edit_article.php");
    }
// 編輯成功
    else if (isset($_POST['modify_intro'])) {
        $article_id = htmlspecialchars($_POST['modify_intro']);
        $intro = htmlspecialchars($_POST['edited']);
        $stmt = $conn->prepare("update update_data SET intro = ? where id = ?");
        $stmt->bind_param('si', $intro, $article_id);
        $stmt->execute();
        $stmt->close();
        $edit_success = 1;
        echo '<p>修改成功</p>';
        header("refresh:0.75;url=../profile.php");
    }
    else if (isset($_POST['modify_file'])) {
        header("location: ../edit/modify_file.php");
    }
    else if(isset($_POST['change_password'])){
        if(empty($_POST['old'])||empty($_POST['new'])||empty($_POST['check'])){
            $errorchange="欄位為空";
        }
        else if(htmlspecialchars($_POST['new'])==htmlspecialchars($_POST['check'])){
                  if (strlen(trim(htmlspecialchars($_POST['new']))) > 12) {
                    $_SESSION['error']=12;
                    header("Location: ./connect/error.php");
    }
                else{
            $pd = htmlspecialchars($_POST['old']);
            $password = htmlspecialchars($_POST['new']);
             $password = 'a'. htmlspecialchars($_POST['password']);
            $encrypt ='a'. hash('md5',hash('sha256',$password));
            $user_id = $row['id'];
            $old_pd = $row['password'];
            if($old_pd == $pd){
                 $stmt = $conn->prepare("update member set password = ? where id = ?");
                $stmt->bind_param('si', $encrypt, $user_id);
                $stmt->execute();
                $stmt->close();
                $_SESSION['error']=2;
                header("Location: ./connect/error.php");
            }
            else{
                $_SESSION['error']=3;
                 header("Location: ./connect/error.php");
                }
            }
        }
         else{
                $_SESSION['error']=4;
                header("Location: ./connect/error.php");
                    }

}


}
?>
