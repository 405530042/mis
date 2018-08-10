<?php
require('./connect/session.php');
 define ("filesplace","./");

 if (is_uploaded_file($_FILES['file']['tmp_name'])) {

 if ($_FILES['file']['type'] != "application/pdf") {
 echo "<p>請上傳PDF格式.</p>";
 } else {
 $name = $_POST['name'];
 $result = move_uploaded_file($_FILES['file']['tmp_name'], 'update'."/$name.pdf");
 if ($result == 1){ 
 		$introduction= $_POST['intro'];
 		$query =mysqli_query($conn,"select * from update_data where file_name like '$name'");
 		  $rows=mysqli_num_rows($query);
 			if($rows==0){
				 $time=date("Y-m-d h:i:sa");
 				$query =mysqli_query($conn,"insert into update_data(file_name,intro,team,time) values('$name','$introduction','$team','$time')"); 
 				echo '<p>上傳成功</p>';
 				header("refresh:1.5;url=./view.php");
 				
     }
     else{
		 echo '檔案名稱已有重複';
		 header("refresh:1.5;url=./update.php");
 
     }
 }
 else echo "<p>發生錯誤，請再試一次 </p>";
} #endIF
 } #endIF
?>