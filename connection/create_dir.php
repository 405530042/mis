<?php
require('./connect/connect.php');
require('./template/header.php');
require('./template/nav.php');
require('timer.php');
?>
<?php

if ($_SESSION['user_id'] != 5) {
	echo '權限不足';
	header("refresh:2; url=./index.php");
}
	else{
?>

	<div class="pre-container">
		<div class="container">
			<div class="info-box">
				<div class="info-title"> 新增作品資料夾 </div>

				<div class="info-content">
                    <div class="info-content-form">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label> 資料夾名稱 </label>
                                <input type="text" name="create_dir" required>
                            </div>

                            <div class="form-group">
                                <label for="meeting"> 繳交期限 </label>
                                <input name="deadline" type="datetime-local" id="bookdate" value="<?php echo date(" Y-m-d\TH:i "); ?>" min="<?php echo date(" Y-m-d\TH:i "); ?>">
                            </div>

                            <div class="form-group submit-area">
                                <button name="create_direction" type="submit">
                                    送出
                                </button>
                                <a href="index.php" class="btn back">
                                    回上一頁
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="info-box">
                <div class="info-title"> 已存在資料夾 </div>

                <div class="info-content">
                    <div class="info-content-table">
                        <table>
                            <thead>
                                <tr>
                                    <th> 進行中的資料夾 </th>
                                    <th> 繳交期限 </th>
                                    <th> 刪除路徑</th>
                                </tr>
                            </thead>

                            <tbody>
<?php
		$stmt = $conn->prepare("select * from direction where status = 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $rows = mysqli_num_rows($result);

        if ($rows === 0) {
        	echo '<tr><td> 尚無資料夾 </td><td></td></tr>';
       	}
       	else {
       		for ($i = 0; $i < $rows; $i++){
       			$file_dir=mysqli_fetch_assoc($result);
       			echo '<tr>
       					<td>' . $file_dir['dir_name'] . '</td>
       					<td class="td-center">' . $file_dir['deadline'] . '</td>
						<td class="td-center">
						   	<form action="" method="POST" onsubmit="return delete_double_check()">
       							<button name="delete_dir" 
       									type="submit" 
       									value="' . $file_dir['id'] . '">
       								刪除
								</button>
							</form>
       					</td>
       				</tr>';
       		}
       	}
?>
							</tbody>
						</table>
                    </div>
                </div>

                <div class="info-content">
                    <div class="info-content-table">
                        <table>
                            <thead>
                                <tr>
                                    <th> 已過繳交日期的資料夾 </th>
                                    <th> 繳交日期</th>
                                </tr>
                            </thead>

                            <tbody>
<?php
		$stmt = $conn->prepare("select * from direction where status = 0");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $rows = mysqli_num_rows($result);

        if ($rows === 0) {
        	echo '<tr><td> 尚無資料夾 </td><td></td></tr>';
       	}
       	else {
       		for ($i = 0; $i < $rows; $i++){
       			$file_dir=mysqli_fetch_assoc($result);
       			echo '<tr>
       					<td>' . $file_dir['dir_name'] . '</td>
       					<td class="td-center">' . $file_dir['deadline'] . '</td>
       				</tr>';
       		}
       	}
?>
							</tbody>
						</table>
                    </div>
                </div>
            </div>
		</div>
	</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST['create_direction'])){
		if (!isset($_POST['create_dir']) || trim($_POST['create_dir']) == '') {
			echo 'dir_name_empty';
			header("refresh:1.5; url=./create_member.php");
		}
		else {
			$deadline = htmlspecialchars($_POST['deadline']);
			$create_dir = htmlspecialchars($_POST['create_dir']);
			$path_pdf = './update/' . $create_dir;
			$path_img = './update/img/' . $create_dir;

			if (!file_exists($path_pdf)&&!file_exists($path_img)) {
				mkdir($path_pdf);
				mkdir($path_img);

				$stmt = $conn->prepare("insert into direction (dir_name,deadline) values (?,?)");
				$stmt->bind_param('ss', $create_dir,$deadline);
				$stmt->execute();
				$stmt->close();

				echo '資料夾新增成功';
				header("refresh:1.5; url=./create_dir.php");
			}
			else {
				echo '資料夾已經存在';
				header("refresh:1.5; url=./create_dir.php");
			}
		}
	}
	else if(isset($_POST['delete_dir'])) {
		$id = htmlspecialchars($_POST['delete_dir']);
		$stmt = $conn->prepare("update direction set status = 0 where id = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->close();
		header("refresh:0;");
	}
}
}
?>

<script>
	function delete_double_check() {
		return (confirm('是否確定刪除這個資料夾？')) ? true : false;
	}
</script>

<?php
require('./template/footer.php');
?>