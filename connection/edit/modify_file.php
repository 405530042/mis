<?php 
require('../connect/session.php');
require('../template/header.php');

if ($user_id != 3) {
	echo '權限不足';
	header("refresh:2; url=./view.php");
}
else {
	$query = $conn->prepare("select * from update_data where team = ?");
    $params = $team;
    $query->bind_param('s',$params);
    $query->execute();
    $result2 = $query->get_result();
    $query->close();
    $profile = mysqli_fetch_array($result2);
    $file_name=$profile['file_name'];
?>
	<form action= "" enctype="multipart/form-data" method="post">
		修改檔案名稱:
		<br />
		<input type="text" name="name" value="<?php echo $file_name ?>" required />
		<br />
		<br />
		<input type="file" id="file" name="file" accept=".pdf" value="" required />
		<br />
		<br />
		<input type="submit" name="modify_file2" value="重新上傳" />
	</form>
<?php
}

require('../template/footer.php');
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['modify_file2'])) {
    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
        if ($_FILES['file']['type'] != "application/pdf") {
            echo "<p>請上傳PDF格式.</p>";
            header("refresh:1.5");
        }
        else {
            if (!isset($_FILES['file']['tmp_name']) || trim($_FILES['file']['tmp_name']) == '') {
                echo "<p>請上傳PDF格式.</p>";
                header("refresh:1.5");
            }
            else{
                $file_url="../update/$file_name.pdf";
             if(file_exists($file_url)){
                 $new_name=htmlspecialchars($_POST['name']);
                 $result = move_uploaded_file($_FILES['file']['tmp_name'], '../update'."/$new_name.pdf");
                 	if($result==1){
                 		 unlink($file_url);
		                 $time = date("Y-m-d h:i:sa");
		                 $team=$profile['team'];
		                 $stmt = $conn->prepare("update update_data set file_name =? ,time =? where team =?");
		                 $params = $name;
		                 $stmt->bind_param('sss', $new_name, $time ,$team);
		                 $stmt->execute();
		                 $stmt->close();
		                   $_SESSION['error'] = 5;
            			header("Location: ../connect/error.php");
            		 }
	             else{
	             	echo "上傳失敗請再試一次";
	             }
             }
             else{
                 echo "找不到路徑";
                 echo $file_url;
             }
            }
        }
    }
}
	 
}
?>