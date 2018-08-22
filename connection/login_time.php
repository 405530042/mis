<?php 
include('./connect/connect.php');
require('./template/header.php');
require('./template/nav.php');
?>

    <div class="pre-container">
        <div class="container">

<?php
if ($_SESSION['user_id'] != 4 && $_SESSION['user_id']!= 5) {
	echo '權限不足';
	header("refresh:2; url=./index.php");
}
else {
    $stmt = $conn->prepare("select * from login_time");
    $stmt->execute();
    $query = $stmt->get_result();
    $stmt->close();
    $rows = mysqli_num_rows($query);

    if($rows === 0) {
?>
            <li> 尚無資料 </li>
<?php
    }
    else {
?>
        <table border=1>
            <tr>
                <th> 姓名 </th>
                <th> 登入時間 </th>
            </tr>
<?php
        if ($_SESSION['user_id']== 4) {
            $stmt = $conn->prepare("select * from login_time where auth !=? and auth !=? and auth !=? ");
            $auth5 = 5;
            $auth4 = 4;
            $auth1 = 1;
            $stmt->bind_param('iii',$auth5,$auth4,$auth1);
            $stmt->execute();
            $query = $stmt->get_result();
            $stmt->close();
            // $rows = mysqli_num_rows($query);
?>
<?php
            for ($i = 1; $i <= mysqli_num_rows($query); $i++) {
?>
        <tr>
<?php
                $login_content = mysqli_fetch_assoc($query);
                $name = $login_content['name'];
                $time = $login_content['time'];
?>
            <td>
<?php
                echo $name;
?>
            </td>
            <td>
<?php
                echo $time;
?>
            </td>
        </tr>
<?php
            }
        }
        else if ($_SESSION['user_id'] == 5) {//this
            $stmt = $conn->prepare("select * from login_time where auth =? or auth =? ");
            $auth4 = 4;
            $auth1 = 1;
            $stmt->bind_param('ii',$auth4,$auth1);
            $stmt->execute();
            $query = $stmt->get_result();
            $stmt->close();
            // $rows = mysqli_num_rows($query);

            for ($i = 1; $i <= mysqli_num_rows($query); $i++) {
?>
            <tr>
<?php
                $login_content = mysqli_fetch_assoc($query);
                $name = $login_content['name'];
                $time = $login_content['time'];
?>
                <td>
<?php
                echo $name;
?>
                </td>
                <td>
<?php
                echo $time;
?>
                </td>
            </tr>
<?php
            }
        }
?>
            </table>
<?php
    }
}
?>
            <a href="index.php" class="button"> 返回 </a>
        </div>
    </div>
<?php
require('./template/footer.php');
?>