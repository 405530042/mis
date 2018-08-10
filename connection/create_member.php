<?php 
include('./connect/session.php');

if($user_id!=4){
	echo '權限不足';
	header("refresh:2;url=./view.php");
	}
	else{
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<title></title>
		</head>
		<body>
		<table>
		<tr>
			<td>姓名</td>
			<td>學號(帳號)</td>
			<td>密碼</td>
			<td>職稱</td>
			<td>組別</td>
		</tr>
		<form action="" method="post">
			<tr>
				<td><input name="name" /> </td>
				<td><input name="number" /></td>
				<td><input name="password" /></td>
				<td><select name="carrer">
					<option value="1">學生(一般)</option>
					<option value="2">學生(組長)</option>
					<option value="3">老師</option>
				</select></td>
				<td><input name="team" /></td>
				<td><button type="submit">新增</button></td>
			</tr>
			</table>
		</form>
		<table>
			<tr>現有帳號
				<td>姓名</td>
				<td>職稱</td>
				<td>學號(帳號)</td>
				<td>密碼</td>
				<td>組別</td>
			</tr>
			
			<?php 
				$account = mysqli_query($conn,"select * from member where authentication != 4");
				$rows = mysqli_num_rows($account);
				if($rows==0){
					?>
					<h3>目前無帳號</h3>
					<?php
				}
				else{
					for($i=0;$i<mysqli_num_rows($account);$i++)
					{
						$account_content = mysqli_fetch_assoc($account);
						$name= $account_content['name'];
						$authentication= $account_content['authentication'];
						$number= $account_content['number'];
						$password= $account_content['password'];
						$team= $account_content['team'];

			?>
			<tr>
				<td><?php echo $name ?></td>
				<td><?php 
				switch ($authentication) {
					case 3:
						echo "學生";
						break;
					
					default:
						# code...
						break;
				}

				?></td>
				<td><?php echo $number ?></td>
				<td><?php echo $password ?></td>
				<td><?php echo $team ?></td>
			</tr>
			<?php 
			}
				
			}
			?>
			</tr>
		</table>
		<a href="view.php" class="button">返回</a>
			<?php
	}
	?>
		</body>
		</html>