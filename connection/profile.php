<?php
require('./connect/session.php');
if($user_id!=3){
  echo '權限不足';
  header("refresh:2;url=./view.php");
  session_destroy();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php
$query=mysqli_query($conn,"select * from update_data where team like $team");
$rows=mysqli_num_rows($query);
if($rows==0){
  echo "尚無檔案上傳";
}
else{
?>
<table>
<tr>
    <td>檔案名稱</td>
    <td>簡介</td>
    <td>上傳日期</td>
    </tr>
<?php
while($profile=mysqli_fetch_array($query))
{   $id=$profile['id'];
    ?>
<tr>
   <td><?php echo $profile['file_name']; ?></td>
   <td><?php echo $profile['intro']; ?></td>
   <td><?php echo $profile['time']; ?></td>
   <form action="" method="post">
   <td><button type="submit"  name="edit" method="post" value="<?php echo $id ?>">更改內容</button></td>
   </form>
   </tr>
 <?php 
 }
  }
  ?>
 </table>
</body>
</html>
