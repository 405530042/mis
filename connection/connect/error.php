<?php
include('../connect/session.php');
switch ($error) {
	case 1:
		echo "帳號或密碼錯誤，請重新登入";
		session_destroy();
		header("refresh:1.25; url=../login.html");
	break;

	case 2:
		echo "修改成功請重新登入";
		session_destroy();
		header("refresh:1.25; url=../login.html");
	break;

	case 3:
		echo "舊密碼錯誤";
	header("refresh:1.25; url=../change_password.php");
	break;

	case 4:
		echo "新密碼與確認密碼不一致";
		header("refresh:1.25; url=../change_password.php");
	break;

	case 5:
		echo "上傳成功";
		header("refresh:1.25; url=../profile.php");
	break;

	case 6:
		echo "請上傳PDF格式.";
		header("refresh:1.25; url=../update.php");
	break;

	case 7:
		echo "無此資料夾";
		header("refresh:1.25; url=../update.php");
	break;

	 case 8:
        echo '上傳成功';
        header("refresh:1.25; url=../view.php");
    break;

    case 9:
        $status = '檔名重複';
        echo $status;
        header("refresh:1.25; url=../update.php");
    break;	
    
       case 10:
    $status = '發生錯誤，請再試一次';
    echo $status;
    header("refresh:1.25; url=../update.php");
    break;

	default:
	echo "發生錯誤請重新登入";
		session_destroy();
	header("refresh:1.25; url=../login.html");
	break;
}


?>
