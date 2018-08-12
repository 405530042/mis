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
        $password = htmlspecialchars($_POST['password']);
        $stmt = $conn->prepare("select * from member where password = ? && number = ?");
        $params = array($password,$user);
        $stmt->bind_param('ss',$password,$user);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $rows = mysqli_num_rows($result);
        echo $rows;

        if ($rows == 1) {
            $_SESSION['login_user'] = $user;
            header("Location: ./success.php");
        }
        else {
             $_SESSION['error'] = 1;
            header("Location: ./error.php");
        }
        
        mysqli_close($conn);
    }
}
?>
