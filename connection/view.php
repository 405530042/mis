<?php
require('./connect/session.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
 if(isset($_GET['article_id'])){
    $article_id = $_GET['article_id'];
    $article = mysqli_query($conn,"select * from update_data where id like '$article_id'");
    if(mysqli_num_rows($article) == 0) {
        ?>
        <h1>查無此資料</h1>
        <?php
    }
    else {
        $content = mysqli_fetch_assoc($article);
        $intro=$content['intro'];
    ?>
     <p><?php echo $intro; }?></p>
     <a href="view.php" class="button">返回</a>
<?php
}
else{
    ?>
    <div class="nav">
<ul>
	<li><a href="profile.php">隊伍檔案</a></li>
	<li><a href="update.php">上傳檔案</a></li>
	<li></li>
</ul>
</div>
<?php
$query=mysqli_query($conn,'select * from update_data');
$rows=mysqli_num_rows($query);
if($row===0){
    ?>
    <li>尚無資料</li>
    <?php
}
    else{
        for($i=1;$i<=mysqli_num_rows($query);$i++){
            $article_content = mysqli_fetch_assoc($query);
            $id=$article_content['id'];
            $name=$article_content['file_name'];
            ?>
            <li><?php echo '<a href="view.php?article_id=',$id,'">',$name, '</a>'; ?></li>
            <?php
    }
    }
}
// if ($handle = opendir('./update/')) {  //開啟現在的資料夾
//       while (false !== ($file = readdir($handle))) {
// //避免搜尋到的資料夾名稱是false,像是0
//           if ($file != "." && $file != "..") {
// //去除掉..跟.
//               echo "<a href='view.php?article_id=<?php echo >$file</a><br>";             
//           }
//       }
//       closedir($handle);
//   }
?>
</body>
</html>
