<?php
 define ("filesplace","./");

 if (is_uploaded_file($_FILES['file']['tmp_name'])) {

 if ($_FILES['file']['type'] != "application/pdf") {
 echo "<p>請上傳PDF格式.</p>";
 } else {
 $name = $_POST['name'];
 $gg = 'test_';
 $result = move_uploaded_file($_FILES['file']['tmp_name'], 'update'."/$gg$name.pdf");
 if ($result == 1){ 
 	$introduction= $_POST['intro'];
 	echo '<p>上傳成功</p>';
 	header("refresh:1.5;url=./view.php");
 }
 else echo "<p>發生錯誤，請再試一次 </p>";
} #endIF
 } #endIF
?>