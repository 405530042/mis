<?php
    require('session.php');

        if(!isset($account)){
    mysqli_close($conn);
    header("location: ./error.php");
}
	$status='';
    switch ($user_id) {
    	case 3:
    		$status= $name.'同學登入成功';
    		echo $status;
    		header("refresh:2;url=../view.php");
    		break;
    	case 4:
    		$status= $name.'管理員登入成功';
    		echo $status;
    		header("refresh:2;url=../view.php");
    }
?>