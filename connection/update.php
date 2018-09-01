<?php 
require('./connect/connect.php');
session_start();
require('./template/header.php');
require('./template/nav.php');
require('timer.php');
?>

<div class="pre-container">
    <header> 黏仔雲端 </header>
    <div class="page-hint">
        <div> 上傳檔案 </div>
        <div>
            <a href="./index.php">
                回上一頁
                <img src="./img/back.png" alt="back">
            </a>
        </div>
    </div>
    <div class="hr"></div>
            
    <div class="container">
        
<?php
if ($_SESSION['user_id']  != 3) {
	echo '<h1><center> 權限不足 </center></h1>';
// 	header("refresh:0.75; url=./index.php");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="./index.php";
			    }, 750);
            </script>
<?php
}
else if($_SESSION['check'] == 1) {
	echo '<h1><center> 隊伍已上傳檔案。 </center></h1>';
// 	header("refresh:0.75; url=./index.php");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="./index.php";
			    }, 750);
            </script>
<?php
}
else {
	$stmt = $conn->prepare("select * from direction where status = 1");
	$stmt->execute();
	$result = $stmt->get_result();
	
	$stmt->close();
?>

        <div class="info-box">
            <div class="info-title"> 上傳檔案 </div>

            <div class="info-content">
                <div class="info-content-form">
                	<form action="up.php" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                		    <label> 檔案名稱 </label>
                		    <input type="text" name="name" value="" required />
                		</div>
                		
                        <div class="form-group">
                            <label> 上傳檔案 </label>
                		    <input type="file" id="file" name="file" accept=".pdf" value="" required />
                		</div>
                		
                        <div class="form-group">
                            <label for="direction"> 選擇資料夾 </label>
                			<select name="direction" id="">
<?php
                    			for($i=0;$i<mysqli_num_rows($result);$i++){
                    				$rows=mysqli_fetch_assoc($result);
                    				$items=$rows['dir_name'];
                    				echo "<option value=$items>$items</option>";
                    			
                    			}
?>
                		    </select>
                		</div>
                		
                		
                        <div class="form-group">
                            <label> 簡介 </label>
                		    <textarea name="intro" rows="4" required></textarea>
                		</div>
                		
                		<div class="form-group submit-area">
                            <button type="submit" name="submit">
                                確認
                            </button>
                        </div>
                	</form>
                </div>
            </div>
        </div>
<?php } ?>
    </div>
</div>
<?php
require('./template/footer.php');
?>
