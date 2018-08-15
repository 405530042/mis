<?php 
include('./connect/session.php');
require('./template/header.php');

if ($user_id != 4) {
	echo '權限不足';
	header("refresh:2; url=./view.php");
}
else {
?>

	<table>
		<tr>
			<td> 姓名 </td>
			<td> 學號(帳號) </td>
			<td> 密碼 </td>
			<td> 職稱 </td>
			<td> 組別 </td>
		</tr>

		<tr>
			<form action="create_account.php" method="post">
				<td>
					<input name="create_name" />
				</td>
				<td>
					<input name="create_number" />
				</td>
				<td>
					<input name="pass" />
				</td>
				<td>
					<select name="carrer">
						<option value="2"> 學生(一般) </option>
						<option value="3"> 學生(組長) </option>
						<option value="1"> 老師 </option>
					</select>
				</td>
				<td>
					<input name="team" />
				</td>
				<td>
					<button type="submit"> 新增 </button>
				</td>
			</form>
		</tr>
	</table>

	<table>
		<tr> 現有帳號
			<td> 姓名 </td>
			<td> 職稱 </td>
			<td> 學號(帳號) </td>
			<td> 組別 </td>
		</tr>
	
<?php 
	$stmt = $conn->prepare("select * from member where authentication != ?");
	$params = 4;
	$stmt->bind_param('i', $params);
	$stmt->execute();
	$account = $stmt->get_result();
	$stmt->close();
	$account = mysqli_query($conn, "select * from member where authentication != 4 and authentication !=5");
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
			<td>
<?php 
			switch ($authentication) {
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
			<td>
<?php
			echo $number
?>
			</td>
			<td>
<?php
			echo $team
?>
			</td>
			<td>
				<form action="" method="post">
					<button type="submit" name="delete_account" value="<?php echo $number ?>"> 刪除 </button>
				</form>
			</td>
		</tr>
<?php
		}
		if (isset($_POST['delete_account'])) {
	 		$delete_name=xss_clean($_POST['delete_account']);
	 		$stmt = $conn->prepare("delete from member where number =?");
			$params = $delete_name;
			$stmt->bind_param('i', $params);
			$stmt->execute();
			$stmt->close();
?>
		<h3>
<?php
			echo "刪除帳號'$delete_name'";
?>
		</h3>
<?php
		 	header("Refresh:1");
		} 
	}
?>
	</table>

	<a href="view.php" class="button"> 返回 </a>
<?php
}

require('./template/footer.php');
?>
