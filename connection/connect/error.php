<?php
session_start();
	if(isset($_SESSION['error'])){
switch ($_SESSION['error']) {
	case 1:
	ob_start();
		echo "帳號或密碼錯誤，請重新登入";
		session_destroy();
		header("refresh:1.25; url=../login.html");
		ob_end_flush();
	break;

	case 2:
	ob_start();
		echo "修改成功請重新登入";
		session_destroy();
		header("refresh:1.25; url=../login.html");
		ob_end_flush();
	break;

	case 3:
	ob_start();
		echo "舊密碼錯誤";
	header("refresh:1.25; url=../change_password.php");
	ob_end_flush();
	break;

	case 4:
	ob_start();
		echo "新密碼與確認密碼不一致";
		header("refresh:1.25; url=../change_password.php");
		ob_end_flush();
	break;

	case 5:
	ob_start();
		echo "上傳成功";
		header("refresh:1.25; url=../profile.php");
		ob_end_flush();
	break;

	case 6:
	ob_start();
		echo "請上傳正確格式.";
		header("refresh:1.25; url=../update.php");
	break;

	case 7:
	ob_start();
		echo "無此資料夾";
		header("refresh:1.25; url=../update.php");
		ob_end_flush();
	break;

	case 8:
        echo '上傳成功';
        header("refresh:1.25; url=../index.php");
    break;

    case 9:
    ob_start();
        echo '檔名重複';
        header("refresh:1.25; url=../update.php");
        ob_end_flush();
    break;	
    
    case 10:
    ob_start();
	    echo '發生錯誤，請再試一次';
	    header("refresh:1.25; url=../update.php");
	    ob_end_flush();
    break;

	case 11:
	ob_start();
	    echo '所有資料夾已關閉';
	    header("refresh:1.25; url=../update.php");
	    ob_end_flush();
	break;

	case 12:
	    echo '新密碼過長';
		header("refresh:1.25; url=../change_password.php");
	break;

	case 13:

	    echo '無此權限';
		header("refresh:1.25; url=../create_member.php");
		ob_end_flush();
	break;

	 case 20:
	    echo '發生錯誤，請再試一次';
	    header("refresh:1.25; url=../edit/edit_image.php");
    break;

	default:
		echo "發生錯誤請重新登入";
		echo $error;
		session_destroy();
		header("refresh:1.25; url=../login.html");
	break;
}
}
else{
	echo "發生錯誤請重新登入";
		echo $error;
		session_destroy();
		header("refresh:1.25; url=../login.html");
}

?>
