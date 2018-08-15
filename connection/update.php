<?php 
require('./connect/session.php');
require('./template/header.php');

if ($user_id != 3) {
	echo '權限不足';
	header("refresh:0.75; url=./view.php");
}
else if($check==1){
	echo '該隊伍已上傳檔案';
	header("refresh:0.75; url=./view.php");
}
else {
	$stmt = $conn->prepare("select * from direction");
	$stmt->execute();
	$result = $stmt->get_result();
	
	$stmt->close();
?>
	<form action="up.php" enctype="multipart/form-data" method="post">
		檔案名稱:
		<br />
		<input type="text" name="name" value="" required />
		<br />
		<br />
		<input type="file" id="file" name="file" accept=".pdf" value="" required />
		<br />
		<br>
		<br><label for="direction">選擇資料夾:	
			<select name="direction" id="">
			<?php for($i=0;$i<mysqli_num_rows($result);$i++){
				$rows=mysqli_fetch_assoc($result);
				$items=$rows['dir_name'];
				echo "<option value=$items>$items</option>";
			
			}  ?>
		</select>
		</label>
			<br>
				<br>
		<textarea name="intro"></textarea>
		<input type="submit" name="submit" value="送出" />
	</form>
<?php
}

require('./template/footer.php');
?>
