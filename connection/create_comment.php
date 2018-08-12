<?php
require('./connect/session.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (!isset($user_id) || trim($user_id) == '') {
		echo '權限不足';
		header("refresh:2; url=./view.php");
	}
	else {
		if (!isset($_POST['comment']) || trim($_POST['comment']) == '') {
			$article_id = htmlspecialchars($_POST['submit']);
			$url = "?article_id=$article_id";
			header("location: ./view.php$url");
		}
		else {
			$content = htmlspecialchars($_POST['comment']); // xss_clean($_POST['comment']);
			$article_id = htmlspecialchars($_POST['submit']);
			$time = date("Y-m-d H:i:s");
			$stmt = $conn->prepare("insert into comment (name, content, article_id, time) values (?,?,?,?)");
			$stmt->bind_param('ssis', $name, $content, $article_id, $time);
			$stmt->execute();
			$stmt->close();
		 	$url = "?article_id=$article_id";
			header("location: ./view.php$url");
		}
	}
}
?>