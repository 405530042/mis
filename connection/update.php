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
?>
	<form action="up.php" enctype="multipart/form-data" method="post">
		檔案名稱:
		<br />
		<input type="text" name="name" value="" required />
		<br />
		<br />
		<input type="file" id="file" name="file" accept=".pdf" value="" required />
		<br />
		<textarea name="intro"></textarea>
		<input type="submit" name="submit" value="送出" />
	</form>
<?php
}

require('./template/footer.php');
?>
