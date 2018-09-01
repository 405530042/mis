<?php
require('./connect/connect.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (!isset($_SESSION['user_id']) || trim($_SESSION['user_id']) == '') {
		echo '權限不足';
// 		header("refresh:2; url=./index.php");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="./index.php";
			    }, 2000);
            </script>
<?php
	}
	else {
		if (!isset($_POST['comment']) || trim($_POST['comment']) == '') {
			$article_id = htmlspecialchars($_POST['submit']);
			$url = "?article_id=$article_id";
// 			header("location: ./index.php$url");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="./index.php<?php $url ?>";
			    }, 0);
            </script>
<?php
		}
		else {
			$content = htmlspecialchars($_POST['comment']); // xss_clean($_POST['comment']);
			$article_id = htmlspecialchars($_POST['submit']);
			$time = date("Y-m-d H:i:s");
			$stmt = $conn->prepare("insert into comment (name, content, article_id, time) values (?,?,?,?)");
			$stmt->bind_param('ssis', $_SESSION['name'], $content, $article_id, $time);
			$stmt->execute();
			$stmt->close();
		 	$url = "?article_id=$article_id";
// 			header("location: ./index.php$url");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="./index.php<?php $url ?>";
			    }, 0);
            </script>
<?php
		}
	}
}
?>