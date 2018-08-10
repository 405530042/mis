<?php 
include('../connect/session.php');

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
	
	<?php
	$id=$_SESSION['article_id'];
	$article=mysqli_query($conn,"select * from update_data where id like '$id'");
	$rows=mysqli_num_rows($article);
	if($rows===0){
		echo "<h3>尚無簡介</h3>";
	}
	else{
		$content=mysqli_fetch_assoc($article);
		$intro=$content['intro'];
		?>
		<form action="" method="post">
		<textarea name="edited"><?php echo $intro ?></textarea>
		<button type="submit" name="article_id" value="<?php echo $id ?>">修改內容</button>
		</form>
		<?php
	}
}
?>
	</body>
	</html>