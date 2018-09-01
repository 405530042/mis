<?php
include('./connect/connect.php');
session_start();
if(isset($_POST['change_password'])){
    if(empty($_POST['old'])||empty($_POST['new'])||empty($_POST['check'])){
        $errorchange="欄位為空";
    }
    else if(empty($_POST['new'])==empty($_POST['check'])){
        $pd = htmlspecialchars($_POST['old']);
        $password = htmlspecialchars($_POST['new']);
        $user_id = $row['id'];
        $old_pd = $row['password'];
        if($old_pd == $pd){
            $stmt = $conn->prepare("update member set password = ? where id = ?");
            $stmt->bind_param('si', $password, $user_id);
            $stmt->execute();
            $stmt->close();
            $_SESSION['error'] = 2;
            // header("Location: ./connect/error.php");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="./connect/error.php";
			    }, 0);
            </script>
<?php
        }
        else {
            $_SESSION['error'] = 3;
            // header("Location: ./connect/error.php");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="./connect/error.php";
			    }, 0);
            </script>
<?php
        }
    }
    else {
              $_SESSION['error'] =4;
            //   header("Location: ./connect/error.php");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="./connect/error.php";
			    }, 0);
            </script>
<?php
    }
}
?>