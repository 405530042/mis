<?php 
include('./connect/connect.php');
require('./template/header.php');
require('./template/nav.php');
session_start();
if ($_SESSION['user_id']!= 4 && $_SESSION['user_id'] != 5) {
	echo '權限不足';
// 	header("refresh:2; url=./index.php");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="./index.php";
			    }, 2000);
            </script>
<?php
}
else {
?>

<div class="pre-container">
    <header> 黏仔雲端 </header>
    <div class="page-hint">
        <div> 設定登入人員名單 </div>
        <div>
            <a href="./index.php">
                回上一頁
                <img src="./img/back.png" alt="back">
            </a>
        </div>
    </div>
    <div class="hr"></div>
    
    <div class="container">
        <div class="info-box">
            <div class="info-title"> 新增帳號 </div>

            <div class="info-content">
                <div class="info-content-form">
                    <form action="create_account.php" method="post">
                        <div class="form-group">
                            <label> 姓名 </label>
                            <input type="text" name="create_name" required>
                        </div>

                        <div class="form-group">
                            <label> 學號 (帳號) </label>
                            <input type="text" name="create_number" required>
                        </div>

                        <div class="form-group">
                            <label> 密碼 </label>
                            <input type="text" name="pass" required>
                        </div>

                        <div class="form-group">
                            <label> 職稱 </label>
                            <select name="carrer">
                                <option value="2"> 學生(一般) </option>
                                <option value="3"> 學生(組長) </option>
                                <option value="1"> 老師 </option>
<?php if ($_SESSION['user_id'] == 5) { ?>
                                <option value="4"> 管理員 </option>
<?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> 組別 </label>
                            <input type="text" name="team">
                        </div>

                        <div class="form-group submit-area">
                            <button type="submit">
                                送出
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="info-box">
            <div class="info-title"> 現有帳號 </div>

            <div class="info-content">
                <div class="info-content-table">
<table>
    <thead>
        <tr>
            <th> 姓名 </th>
            <th> 職稱 </th>
            <th> 學號(帳號) </th>
            <th> 組別 </th>
            <th></th>
        </tr>
    </thead>

    <tbody>
	
<?php
	if ($_SESSION['user_id']== 5) {
		$stmt = $conn->prepare("select * from member where authentication != ?");
		$auth5 = 5;
		$stmt->bind_param('i', $auth5);
	}
	else if ($_SESSION['user_id'] == 4) {
		$stmt = $conn->prepare("select * from member where authentication != ? and authentication != ?");
		$auth1 = 4;
		$auth2 = 5;
		$stmt->bind_param('ii', $auth1, $auth2);
	}

	$stmt->execute();
	$account = $stmt->get_result();
	$stmt->close();
	$rows = mysqli_num_rows($account);

	if ($rows == 0) {
?>
		<h3> 目前無帳號 </h3>
<?php
	}
	else {
		for ($i = 0; $i < mysqli_num_rows($account); $i++) {
			$account_content = mysqli_fetch_assoc($account);
			$name = $account_content['name'];
			$authentication = $account_content['authentication'];
			$number = $account_content['number'];
			$password = $account_content['password'];
			$team = $account_content['team'];
?>
		<tr>
			<td>
<?php
			echo $name
?>
			</td>
			<td class="td-center">
<?php 
			switch ($authentication) {
				case 4:
					echo "管理員";
					break;
				case 3:
					echo "學生(組長)";
					break;
				case 2:
					echo "學生(一般)";
					break;
				case 1:
					echo "老師";
					break;
				default:
					# code...
					break;
			}
?>
			</td>
			<td class="td-center">
<?php
			echo $number
?>
			</td>
			<td class="td-center">
<?php
			echo $team
?>
			</td>
			<td class="td-center">
                <form action="" method="post" onsubmit="return delete_double_check()">
                    <button type="submit" name="delete_account" value="<?php echo $number ?>">
                        刪除
                    </button>
                </form>
			</td>
		</tr>
<?php
		}
		if (isset($_POST['delete_account'])) {
	 		$delete_name = htmlspecialchars($_POST['delete_account']);
	 		$stmt = $conn->prepare("delete from member where number =?");
			$params = $delete_name;
			$stmt->bind_param('i', $params);
			$stmt->execute();
			$stmt->close();
?>
		
    <div class="full-page">
        <div class="full-page-msg">
            <p>
<?php
                echo "即將刪除帳號：$delete_name ......";
?>
            </p>
        </div>
    </div>
    
	<script type="text/javascript">
	   setTimeout(() => {
	        window.location ="./create_member.php";
	    }, 2000);
    </script>
<?php
		} 
	}
?>
	</tbody>
</table>

        	    </div>
        	</div>
    	</div>
	</div>
</div>
<?php
}
?>

<script>
	function delete_double_check() {
		return (confirm('是否確定刪除此帳號？')) ? true : false;
	}
</script>

<?php
require('./template/footer.php');
?>
