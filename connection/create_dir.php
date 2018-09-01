<?php
require('./connect/connect.php');
require('./template/header.php');
require('./template/nav.php');
require('timer.php');
?>
<?php

if ($_SESSION['user_id'] != 5) {
	echo '權限不足';
// 	header("refresh:2; url=./index.php");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="./index.php";
			    }, 2000);
            </script>
<?php
}
	else{
?>

	<div class="pre-container">
        <header> 黏仔雲端 </header>
        <div class="page-hint">
            <div> 新增作品資料夾 </div>
            <div>
                <a href="./index.php">
                    回上一頁
                    <img src="./img/back.png" alt="back">
                </a>
            </div>
        </div>
        <div class="hr"></div>
            
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
						   	    <input name="delete_dir_name" type="hidden" value="' . $file_dir['dir_name'] . '" />
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
// 			header("refresh:1.5; url=./create_member.php");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="./create_member.php";
			    }, 1500);
            </script>
<?php
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
				?>
				<!--header("Location:./create_dir.php");-->
				<script type="text/javascript"> 
                   window.location ="./create_dir.php";
                </script>
				<?php
			}
			else {
				echo '資料夾已經存在';
				// header("refresh:1.25; url=./create_dir.php");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="./create_dir.php";
			    }, 1250);
            </script>
<?php
			}
		}
	}
	else if(isset($_POST['delete_dir'])) {
		$id = htmlspecialchars($_POST['delete_dir']);
		$dir_name = htmlspecialchars($_POST['delete_dir_name']);
		$stmt = $conn->prepare("update direction set status = 0 where id = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->close();
// 		header("refresh:0;");
?>
    <div class="full-page">
        <div class="full-page-msg">
            <p>
<?php
                echo "即將刪除資料夾：$dir_name ......";
?>
            </p>
        </div>
    </div>

	<script type="text/javascript">
	   setTimeout(() => {
	        window.location ="./create_dir.php";
	    }, 1000);
    </script>
<?php
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