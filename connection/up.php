<?php
require('./connect/session.php');
define("filesplace", "./");

if (is_uploaded_file($_FILES['file']['tmp_name'])) {
    if ($_FILES['file']['type'] != "application/pdf") {
        echo "<p>請上傳PDF格式.</p>";
    }
    else {
        if (!isset($_FILES['file']['tmp_name']) || trim($_FILES['file']['tmp_name']) == '') {
            echo "<p>請上傳PDF格式.</p>";
            header("refresh:1.5;url=./update.php");
        }
        else {
            $name = htmlspecialchars($_POST['name']);
            $result = move_uploaded_file($_FILES['file']['tmp_name'], 'update'."/$name.pdf");

            if ($result == 1) { 
         		$introduction = htmlspecialchars($_POST['intro']);
         		$stmt = $conn->prepare("select * from update_data where file_name = ?");
                $params = $name;
                $stmt->bind_param('s', $params);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                $rows = mysqli_num_rows($result);

     			if ($rows == 0) {
    				$time = date("Y-m-d h:i:sa");
    				$stmt = $conn->prepare("insert into update_data(file_name,intro,team,time) values(?,?,?,?)");
            		$params = $name;
            		$stmt->bind_param('ssss', $name, $introduction, $team, $time);
            		$stmt->execute();
            		$stmt->close();
                    $check =$conn->prepare("update member set update_check ? where team = ?");
                    $check->bind_param('is',1,$team);
                    $stmt->execute();
                    $stmt->close();
     				echo '<p>上傳成功</p>';
     				header("refresh:1.5; url=./view.php");
                }
                else {
                    echo '檔案名稱已有重複';
                    header("refresh:1.5; url=./update.php");
                }
            }
            else {
                echo "<p>發生錯誤，請再試一次 </p>";
            }
        }
    }
}
?>
