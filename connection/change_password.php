<?php 
include('./connect/session.php');
require('./template/header.php');
require('./template/nav.php');

if ($user_id != 3 && $user_id != 2) {
	ob_start();
    echo '權限不足';
    header("refresh:2; url=./index.php");
    ob_end_flush();
}
else{
	?>
<form action="" method="POST">
	<span>舊密碼<input type="password" name="old" required></span>
	<span>新密碼<input type="password" name="new" required></span>
	<span>確認新密碼<input type="password" name="check" required></span>
	<button type="submit" name="change_password">確認</button>
</form>
	<?php
}

?>
<?php
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
// if(isset($_POST['change_password'])){
//     if(empty($_POST['old'])||empty($_POST['new'])||empty($_POST['check'])){
//         $errorchange="欄位為空";
//     }
//     else if(empty($_POST['new'])==empty($_POST['check'])){
//         $pd = htmlspecialchars($_POST['old']);
//         $password = htmlspecialchars($_POST['new']);
//         $user_id = $row['id'];
//         $old_pd = $row['password'];
//         if($old_pd == $pd){
//              $stmt = $conn->prepare("update member set password = ? where id = ?");
//         $stmt->bind_param('si', $password, $user_id);
//         $stmt->execute();
//         $stmt->close();
//             echo '修改成功請重新登入';
//             // header("Location: ./connect/error.php");
//         }
//         else{
//            //  header("Location: ./connect/error.php");
//               echo '3';
//             }
//         }
//          else{

//                         echo '4';
//                // header("Location: ./connect/error.php");
//                     }

// }
// }
?>
