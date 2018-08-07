<?php 
require('session.php');
if($user_id!=3){
	echo '權限不足';
	header("refresh:2;url=./login.html");
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
檔案名稱:<br /> <input type="text" name="name" value="" /><br />
<br /> <input type="file" id="file" name="file" accept=".pdf"  value="" /><br />
<textarea name="intro"></textarea>
  <input type="submit" name="submit" value="Submit Notes" />
</form>
</body>
</html>
<?php }?>

