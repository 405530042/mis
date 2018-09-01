<?php
session_start();
if(isset($_SESSION['error'])){
    switch ($_SESSION['error']) {
    	case 1:
    		echo "帳號或密碼錯誤，請重新登入";
    		session_destroy();
    // 		header("refresh:1.25; url=../login.html");
    ?>
    			<script type="text/javascript">
    			    setTimeout(() => {
    			        window.location ="../login.html";
    			    }, 1250);
                </script>
    <?php
    	break;
    
    	case 2:
    		echo "修改成功請重新登入";
    		session_destroy();
    // 		header("refresh:1.25; url=../login.html");
    ?>
    			<script type="text/javascript">
    			    setTimeout(() => {
    			        window.location ="../login.html";
    			    }, 1250);
                </script>
    <?php
    	break;
    
    	case 3:
    		echo "舊密碼錯誤";
    	   // header("refresh:1.25; url=../change_password.php");
    ?>
    			<script type="text/javascript">
    			    setTimeout(() => {
    			        window.location ="../change_password.php";
    			    }, 1250);
                </script>
    <?php
    	break;
    
    	case 4:
    		echo "新密碼與確認密碼不一致";
    // 		header("refresh:1.25; url=../change_password.php");
    ?>
    			<script type="text/javascript">
    			    setTimeout(() => {
    			        window.location ="../change_password.php";
    			    }, 1250);
                </script>
    <?php
    	break;
    
    	case 5:
    		echo "上傳成功";
    // 		header("refresh:1.25; url=../profile.php");
    ?>
    			<script type="text/javascript">
    			    setTimeout(() => {
    			        window.location ="../profile.php";
    			    }, 1250);
                </script>
    <?php
    	break;
    
    	case 6:
    		echo "請上傳正確格式.";
    // 		header("refresh:1.25; url=../update.php");
    ?>
    			<script type="text/javascript">
    			    setTimeout(() => {
    			        window.location ="../update.php";
    			    }, 1250);
                </script>
    <?php
    	break;
    
    	case 7:
    		echo "無此資料夾";
    // 		header("refresh:1.25; url=../update.php");
    ?>
    			<script type="text/javascript">
    			    setTimeout(() => {
    			        window.location ="../update.php";
    			    }, 1250);
                </script>
    <?php
    	break;
    
    	case 8:
            echo '上傳成功';
            // header("refresh:1.25; url=../index.php");
    ?>
    			<script type="text/javascript">
    			    setTimeout(() => {
    			        window.location ="../index.php";
    			    }, 1250);
                </script>
    <?php
        break;
    
        case 9:
            echo '檔名重複';
            // header("refresh:1.25; url=../update.php");
    ?>
    			<script type="text/javascript">
    			    setTimeout(() => {
    			        window.location ="../update.php";
    			    }, 1250);
                </script>
    <?php
        break;	
        
        case 10:
    	    echo '發生錯誤，請再試一次';
    	   // header("refresh:1.25; url=../update.php");
    ?>
    			<script type="text/javascript">
    			    setTimeout(() => {
    			        window.location ="../update.php";
    			    }, 1250);
                </script>
    <?php
        break;
    
    	case 11:
    	    echo '所有資料夾已關閉';
    	   // header("refresh:1.25; url=../update.php");
    ?>
    			<script type="text/javascript">
    			    setTimeout(() => {
    			        window.location ="../update.php";
    			    }, 1250);
                </script>
    <?php
    	break;
    
    	case 12:
    	    echo '新密碼過長';
    // 		header("refresh:1.25; url=../change_password.php");
    ?>
    			<script type="text/javascript">
    			    setTimeout(() => {
    			        window.location ="../change_password.php";
    			    }, 1250);
                </script>
    <?php
    	break;
    
    	case 13:
    	    echo '無此權限';
    // 		header("refresh:1.25; url=../create_member.php");
    ?>
    			<script type="text/javascript">
    			    setTimeout(() => {
    			        window.location ="../create_member.php";
    			    }, 1250);
                </script>
    <?php
    	break;
    
    	 case 20:
    	    echo '發生錯誤，請再試一次';
    	   // header("refresh:1.25; url=../edit/edit_image.php");
    ?>
    			<script type="text/javascript">
    			    setTimeout(() => {
    			        window.location ="../edit/edit_image.php";
    			    }, 1250);
                </script>
    <?php
        break;
    
    	default:
    		echo "發生錯誤請重新登入";
    		echo $error;
    		session_destroy();
    // 		header("refresh:1.25; url=../login.html");
    ?>
    			<script type="text/javascript">
    			    setTimeout(() => {
    			        window.location ="../login.html";
    			    }, 1250);
                </script>
    <?php
    	break;
    }
}
else{
	echo "發生錯誤請重新登入";
	echo $error;
	session_destroy();
// 	header("refresh:1.25; url=../login.html");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="../login.html";
			    }, 1250);
            </script>
<?php
}
?>
