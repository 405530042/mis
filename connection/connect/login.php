<?php
require('session.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['password']) || trim($_POST['password']) == '') {
        echo 'password_empty';
    }
    else if (!isset($_POST['username']) || trim($_POST['username']) == '') {
        echo 'username_empty';
    }
    else {
        $user = htmlspecialchars($_POST['username']);
        $password = 'a'. htmlspecialchars($_POST['password']);
        $encrypt ='a'. hash('md5',hash('sha256',$password));
        $stmt = $conn->prepare("select * from member where password = ? && number = ?");
        $stmt->bind_param('ss',$encrypt,$user);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $rows = mysqli_num_rows($result);
        echo $rows;

        if ($rows == 1) {
            ob_start();
            $_SESSION['login_user'] = $user;
            header("Location: ./success.php");
            ob_end_flush();
        }
        else {
            ob_start();
            $_SESSION['error'] = 1;
            header("Location: ./error.php");
            ob_end_flush();
        }
        
        mysqli_close($conn);
    }
}
?>
