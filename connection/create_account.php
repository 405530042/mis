<?php
require('connect/connect.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['create_name']) || trim($_POST['create_name']) == '') {
        echo 'name_empty';
        // header("refresh:1.5; url=./create_member.php");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="./create_member.php";
			    }, 1500);
            </script>
<?php
    }
    else if (!isset($_POST['create_number']) || trim($_POST['create_number']) == '') {
        echo 'school_number_empty';
        // header("refresh:1.5; url=./create_member.php");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="./create_member.php";
			    }, 1500);
            </script>
<?php
    }
    else if (!isset($_POST['pass']) || trim($_POST['pass']) == '') {
        echo 'password_empty';
        // header("refresh:1.5; url=./create_member.php");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="./create_member.php";
			    }, 1500);
            </script>
<?php
    }
    else if (strlen(trim($_POST['pass'])) > 12) {
        echo 'password_TooLong';
        // header("refresh:1.5; url=./create_member.php");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="./create_member.php";
			    }, 1500);
            </script>
<?php
    }
	else {
		$create_number=htmlspecialchars($_POST['create_number']);
		$stmt = $conn->prepare("select * from member where number = ?");
        $stmt->bind_param('s', $create_number);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $rows = mysqli_num_rows($result);

        // echo $rows;

        if ($rows != 0) {
        	echo "account existed";
        // 	header("refresh:1.25; url=./create_member.php");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="./create_member.php";
			    }, 1250);
            </script>
<?php
       	}
        else {
            if ($_SESSION['user_id'] == 5) {
                if (htmlspecialchars($_POST['carrer']) != 1 && 
                    htmlspecialchars($_POST['carrer']) != 2 && 
                    htmlspecialchars($_POST['carrer']) != 3 && 
                    htmlspecialchars($_POST['carrer']) != 4) {
                    $_SESSION['error'] = 13;
                    // header("location: ./connect/error.php");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="./connect/error.php";
			    }, 0);
            </script>
<?php
                }
            }
            else if ($_SESSION['user_id']== 4) {
                if (htmlspecialchars($_POST['carrer']) != 1 && 
                    htmlspecialchars($_POST['carrer']) != 2 && 
                    htmlspecialchars($_POST['carrer']) != 3) {
                    $_SESSION['error'] = 13;
                    // header("location: ./connect/error.php");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="./connect/error.php";
			    }, 0);
            </script>
<?php
                }
            }

            $create_name = (string) htmlspecialchars($_POST['create_name']);
    		$password = 'a'. htmlspecialchars($_POST['pass']);
            $encrypt ='a'. hash('md5',hash('sha256',$password));
    		$authentication = htmlspecialchars($_POST['carrer']);
    		$team = htmlspecialchars($_POST['team']);
    		$time = htmlspecialchars(date("Y-m-d H:i:s"));
    		$stmt = $conn->prepare("insert into member(name,number,password,authentication,team,created_time) values(?,?,?,?,?,?)");
    		$stmt->bind_param('sssiss',$create_name,$create_number,$encrypt,$authentication,$team,$time);
    		$stmt->execute();
    		$stmt->close();
			echo '新增成功';
// 			header("refresh:1.5; url=./create_member.php");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="./create_member.php";
			    }, 1500);
            </script>
<?php
    	}
	}
}
?>