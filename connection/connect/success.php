<?php
require('connect.php');
session_start();
if (!isset($_SESSION['account'])) {
    mysqli_close($conn);
    header("location: ./error.php");
}
if(isset($_SESSION['login_user'])){
        $account=$conn->prepare("select * from member where id = ?");
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
$stmt = $conn->prepare("insert into login_time(name,time,auth) values(?,?,?)");
if(isset($_SESSION['user_id'])){
    $name=$_SESSION['name'];
    $user_id=$_SESSION['user_id'];
        switch ($_SESSION['user_id']) {
            case 5:
                $time = date("Y-m-d H:i:s");
                $stmt->bind_param('ssi',$name,$time,$user_id);
                $stmt->execute();
                $stmt->close();
                $status = $name . '登入成功';
                echo $status;
                header("refresh:1; url=../index.php");
                break;
        	case 3:
                $time = date("Y-m-d H:i:s");
                $stmt->bind_param('ssi',$name,$time,$user_id);
                $stmt->execute();
                $stmt->close();
        		$status = $name . '同學(組長)登入成功';
        		echo $status;
        		header("refresh:1; url=../index.php");
        		break;
        	case 4:
                $time = date("Y-m-d H:i:s");
                $stmt->bind_param('ssi',$name,$time,$user_id);
                $stmt->execute();
                $stmt->close();
        		$status = $name . '管理員登入成功';
        		echo $status;
        		header("refresh:1; url=../index.php");
                break;
            case 2:
                $time = date("Y-m-d H:i:s");
                $query = mysqli_query($conn,"insert into login_time(name,time) values('$name','$time')");
                $status = $name . '同學登入成功';
                echo $status;
                header("refresh:1; url=../index.php");
                break;
            case 1:
                $time = date("Y-m-d H:i:s");
                $query = mysqli_query($conn,"insert into login_time(name,time) values('$name','$time')");
                $status = $name . '登入成功';
                echo $status;
                header("refresh:1; url=../index.php");
                break;

            }
}
?>
