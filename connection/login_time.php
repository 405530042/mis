<?php 
include('./connect/session.php');
require('./template/header.php');

if ($user_id != 4) {
	echo '權限不足';
	header("refresh:2; url=./view.php");
}
else {
    $stmt = $conn->prepare("select * from login_time");
    $stmt->execute();
    $query = $stmt->get_result();
    $stmt->close();
    $rows = mysqli_num_rows($query);

    if($row === 0) {
?>
    <li> 尚無資料 </li>
<?php
    }
    else {
?>
    <table>
    	<tr>
			<td> 姓名 </td>
			<td> 登入時間 </td>
		</tr>
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
            echo $name
?>
            </td>
            <td>
<?php
            echo $time
?>
            </td>
        </tr>
<?php
        }
?>
    </table>
<?php
    }
}
?>
    <a href="view.php" class="button"> 返回 </a>
<?php
require('./template/footer.php');
?>
	