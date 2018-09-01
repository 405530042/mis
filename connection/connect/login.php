<?php

require('connect.php');

session_start();



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

        $stmt = $conn->prepare("SELECT * FROM member WHERE password = ? && number = ?");

        $stmt->bind_param('ss',$encrypt,$user);

        $stmt->execute();

        $result = $stmt->get_result();

        $stmt->close();

        $rows = mysqli_num_rows($result);

        //echo $rows;

        $member=mysqli_fetch_assoc($result);

        if ($rows == 1) {

            $_SESSION['login_user'] = $member['id'];

            $_SESSION['account'] = $member['number'];

            $_SESSION['auth'] = $member['authentication'];

?>

			<script type="text/javascript">

			    setTimeout(() => {

			        window.location ="./success.php";

			    }, 0);

            </script>

<?php   }

        else {

            $_SESSION['error'] = 1;

?>

			<script type="text/javascript">

			    setTimeout(() => {

			        window.location ="./error.php";

			    }, 0);

            </script>

<?php   }

        

        mysqli_close($conn);

    }

}

?>

