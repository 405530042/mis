<?php
require('connect/session.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['create_name']) || trim($_POST['create_name']) == '') {
        echo 'name_empty';
        header("refresh:1.5; url=./create_member.php");
    }
    else if (!isset($_POST['create_number']) || trim($_POST['create_number']) == '') {
        echo 'school_number_empty';
        header("refresh:1.5; url=./create_member.php");
    }
    else if (!isset($_POST['pass']) || trim($_POST['pass']) == '') {
        echo 'password_empty';
        header("refresh:1.5; url=./create_member.php");
    }
	else {
		$create_number=htmlspecialchars($_POST['create_number']);
		$stmt = $conn->prepare("select * from member where number = ?");
        $stmt->bind_param('s', $create_number);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $rows = mysqli_num_rows($result);

        echo $rows;

        if ($rows != 0) {
        	echo "account existed";
        	header("refresh:1.25; url=./create_member.php");
       	}
        else {
            $create_name = htmlspecialchars($_POST['create_name']);
    		$password = htmlspecialchars($_POST['pass']);
    		$authentication = htmlspecialchars($_POST['carrer']);
    		$team = htmlspecialchars($_POST['team']);
    		$time = htmlspecialchars(date("Y-m-d H:i:s"));
    		$stmt = $conn->prepare("insert into member(name,number,password,authentication,team,created_time) values(?,?,?,?,?,?)");
    		$stmt->bind_param('sssiss',$create_name,$create_number,$password,$authentication,$team,$time);
    		$stmt->execute();
    		$stmt->close();
			echo '新增成功';
			header("refresh:1.5; url=./create_member.php");
    	}
	}
}
?>