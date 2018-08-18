<?php
require('session.php');

if (!isset($account)) {
    mysqli_close($conn);
    header("location: ./error.php");
}

$status = '';
$stmt = $conn->prepare("insert into login_time(name,time,auth) values(?,?,?)");
switch ($user_id) {
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
?>
