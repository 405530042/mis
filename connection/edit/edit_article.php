<?php 

include('../connect/connect.php');

require('../template/header-in-file.php');

require('../template/nav.php');

include('../connect/function.php');

session_start();

if ($_SESSION['user_id'] != 3) {

	echo '權限不足';

// 	header("refresh:2; url=../index.php");

?>

			<script type="text/javascript">

			    setTimeout(() => {

			        window.location ="../index.php";

			    }, 2000);

            </script>

<?php

}

else {

	$id = $_SESSION['article_id'];

	$stmt = $conn->prepare("SELECT * FROM update_data WHERE id = ?");

	$params = $id;

	$stmt->bind_param('i', $params);

	$stmt->execute();

	$result = $stmt->get_result();

	$stmt->close();

	$rows = mysqli_num_rows($result);



	if ($rows === 0) {

		echo "<h3>尚無簡介</h3>";

		echo '123'. $_SESSION['article_id'];

	}

	else {

		$content = mysqli_fetch_assoc($result);

		$intro = $content['intro'];

?>

	<form action="" method="post">

		<textarea name="edited"><?php echo $intro ?></textarea>

		<button type="submit" name="modify_intro" value="<?php echo $id ?>"> 修改內容 </button>

		<button type="submit" name="modify_file" value="<?php echo $id ?>"> 重新上傳檔案</button>

	</form>

<?php

	}

}



require('../template/footer.php');

?>

