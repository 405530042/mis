<?php 
require('./connect/session.php');
if($user_id!=3){
	echo '權限不足';
	header("refresh:2;url=./view.php");
	session_destroy();
}
else{
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="up.php" enctype="multipart/form-data" method="post">
檔案名稱:<br /> <input type="text" name="name" value="" required /><br />
<br /> <input type="file" id="file" name="file" accept=".pdf"  value=""  required /><br />
<textarea name="intro"></textarea>
  <input type="submit" name="submit" value="送出" />
</form>
</body>
</html>
<?php }?>

