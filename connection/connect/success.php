<?php

require('connect.php');

session_start();

if (!isset($_SESSION['account'])) {

    mysqli_close($conn);

    // header("location: ./error.php");

?>

			<script type="text/javascript">

			    setTimeout(() => {

			        window.location ="./error.php";

			    }, 0);

            </script>

<?php

}

if(isset($_SESSION['login_user'])){

        $account=$conn->prepare("SELECT * FROM member WHERE id = ?");

        $account->bind_param('s', $_SESSION['login_user']);

        $account->execute();

        $result = $account->get_result();

        $row = mysqli_fetch_assoc($result);

        $account->close();

        $_SESSION['user_id'] = $row['authentication'];

        $_SESSION['account'] = $row['number'];

        $_SESSION['name'] = $row['name'];

        $_SESSION['team'] = $row['team'];

        $_SESSION['id']= $row['id'];

        $_SESSION['check']=$row['update_check'];

    }

$status = '';

if(isset($_SESSION['user_id'])){

    $name=$_SESSION['name'];

    $user_id=$_SESSION['user_id'];

        switch ($_SESSION['user_id']) {

            case 5:

                 $time = date("Y-m-d H:i:s");

                $stmt = $conn->prepare("INSERT INTO login_time (name,time,auth) VALUES(?,?,?)");

                $stmt->bind_param('ssi',$name,$time,$user_id);

                $stmt->execute();

                $stmt->close();

                $row=mysqli_fetch_assoc($result);

                echo $row[name];

                // $time = date("Y-m-d H:i:s");

                // $stmt = $conn->prepare("insert into login_time (name,auth,time) values(?,?,?)");

                // $stmt->bind_param('sis',$name,$user_id,$time);

                // $stmt->execute();

                // $stmt->close();

                $status = $name . '登入成功';

                echo $status;

?>

			<script type="text/javascript">

			    setTimeout(() => {

			        window.location ="../index.php";

			    }, 1000);

            </script>

<?php

                break;

        	case 3:

                $time = date("Y-m-d H:i:s");

                $stmt = $conn->prepare("INSERT INTO login_time (name,time,auth) VALUES(?,?,?)");

                $stmt->bind_param('ssi',$name,$time,$user_id);

                $stmt->execute();

                $stmt->close();

        		$status = $name . '同學(組長)登入成功';

        		echo $status;

        // 		header("refresh:1; url=../index.php");

?>

			<script type="text/javascript">

			    setTimeout(() => {

			        window.location ="../index.php";

			    }, 1000);

            </script>

<?php

        		break;

        	case 4:

                $time = date("Y-m-d H:i:s");

                $stmt = $conn->prepare("INSERT INTO login_time (name,time,auth) VALUES(?,?,?)");

                $stmt->bind_param('ssi',$name,$time,$user_id);

                $stmt->execute();

                $stmt->close();

        		$status = $name . '管理員登入成功';

        		echo $status;

        // 		header("refresh:1; url=../index.php");

?>

			<script type="text/javascript">

			    setTimeout(() => {

			        window.location ="../index.php";

			    }, 1000);

            </script>

<?php

                break;

            case 2:

                $time = date("Y-m-d H:i:s");

                $stmt = $conn->prepare("INSERT INTO login_time (name,time,auth) VALUES(?,?,?)");

                $stmt->bind_param('ssi',$name,$time,$user_id);

                $stmt->execute();

                $stmt->close();

                $status = $name . '同學登入成功';

                echo $status;

                // header("refresh:1; url=../index.php");

?>

			<script type="text/javascript">

			    setTimeout(() => {

			        window.location ="../index.php";

			    }, 1000);

            </script>

<?php

                break;

            case 1:

               $time = date("Y-m-d H:i:s");

               $stmt = $conn->prepare("INSERT INTO login_time (name,time,auth) VALUES(?,?,?)");

                $stmt->bind_param('ssi',$name,$time,$user_id);

                $stmt->execute();

                $stmt->close();

                $status = $name . '登入成功';

                echo $status;

                // header("refresh:1; url=../index.php");

?>

			<script type="text/javascript">

			    setTimeout(() => {

			        window.location ="../index.php";

			    }, 1000);

            </script>

<?php

                break;



            }

}

?>

