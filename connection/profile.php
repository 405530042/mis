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
require('./connect/session.php');
$query=mysqli_query($conn,"select * from update_data where team like $team");
$rows=mysqli_num_rows($query);
?>
<table>
<tr>
    <td>檔案名稱</td>
    <td>簡介</td>
    <td>上傳日期</td>
<?php
while($profile=mysqli_fetch_array($query))
{
    ?>
<tr>
   <td><?php echo $profile['file_name'];?></td>
   <td><?php echo $profile['intro']; ?></td>
   <td><?php echo $profile['time']; ?></td>
   </tr>
 <?php } ?>
 </table>
</body>
</html>
