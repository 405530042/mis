<?php
require('./connect/session.php');
require('./template/header.php');
require('./template/nav.php');
?>

	<div class="pre-container">
		<div class="container">
			<form action="" method="POST">
				<input type="text" name="create_dir" placeholder="新增資料夾名稱" required>
				<button type="submit"> 送出 </button>
			</form>
			
			<br>

			<table border=1>
				<thead>
					<tr>
						<th> 已存在資料夾 </th>
					</tr>
				</thead>

				<tbody>
<?php
		$stmt = $conn->prepare("select dir_name from direction");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $rows = mysqli_num_rows($result);

        if ($rows === 0) {
        	echo '<tr><td> 尚無資料夾 </td></tr>';
       	}
       	else {
       		for ($i = 0; $i < $rows; $i++)
       			echo '<tr><td>' . mysqli_fetch_assoc($result)['dir_name'] . '</td></tr>';
       	}
?>
				</tbody>
			</table>

    		<a href="view.php" class="button"> 返回 </a>
		</div>
	</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['create_dir']) || trim($_POST['create_dir']) == '') {
        echo 'dir_name_empty';
        header("refresh:1.5; url=./create_member.php");
    }
	else {
		$create_dir = htmlspecialchars($_POST['create_dir']);
		$path = './update/' . $create_dir;

		if (!file_exists($path)) {
		    mkdir($path);

    		$stmt = $conn->prepare("insert into direction (dir_name) values (?)");
    		$stmt->bind_param('s', $create_dir);
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

require('./template/footer.php');
?>