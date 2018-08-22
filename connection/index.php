<?php
require('./connect/connect.php');
require('./template/header.php');
require('./template/nav.php');
require('timer.php');
?>

    <div class="pre-container">
        <div class="container">
<?php
if (isset($_GET['article_id'])) {
    $article_id = intval(htmlspecialchars($_GET['article_id']));
    $stmt = $conn->prepare("select * from update_data where id =?");
    $params = $article_id;
    $stmt->bind_param('s',$params);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = mysqli_fetch_assoc($result);
    $stmt->close();

    $article = mysqli_query($conn, "select * from update_data where id like '$article_id'");

    if (mysqli_num_rows($result) == 0) {
?>
            <h1> 查無此資料 </h1>
<?php
    }
    else {
        $content = mysqli_fetch_assoc($article);
        $intro = $content['intro'];
        $file_name = $content['file_name'];
        $direction =$content['direction'];
        $team_number = $content['team'];
?>
            <p>
<?php
        echo $file_name;
?>
                <br>
                <br>    
<?php
        $teammate = mysqli_query($conn, "select * from member where team like '$team_number'");
        $rows = mysqli_num_rows($teammate);
?>
                <li>隊伍成員: 
<?php
        for ($i = 0; $i < $rows; $i++) {
            $mate = mysqli_fetch_assoc($teammate);
            echo $mate['name'] . '、';
        }
?>
                </li>

                <div id="scroller">
                    <iframe style="pointer-events: none; user-select: none;" type="application/pdf" name="myiframe" id="myiframe" src="update/<?php echo $direction . '/' . $file_name . '.pdf' ;?>"></iframe>
                </div>
<?php
        echo $intro;
    }
?>
            </p>
<?php
    if (!isset($_SESSION['user_id'] ) || trim($_SESSION['user_id'] ) == '') {
         $stmt = $conn->prepare("select * from comment where article_id = ?");
        $params = $article_id;
        $stmt->bind_param('s', $params);
        $stmt->execute();
        $query = $stmt->get_result();
        $stmt->close();
        $rows = mysqli_num_rows($query);
          if ($rows == 0) {
?>
            <p>---留言區---</p>
            <h3>尚無留言</h3>
            <a href="index.php" class="button">返回</a>
<?php
}
else{
    ?>
    <p>---留言區---</p>
      <table>
                    <tr>
                        <td> 姓名 </td>
                        <td> 留言 </td>
                        <td> 時間 </td>
                    </tr>
<?php

            for ($i = 0; $i < $rows; $i++) {
                $show_comment = mysqli_fetch_assoc($query);
                $comment_name = $show_comment['name'];
                $comment = $show_comment['content'];
                $time = $show_comment['time'];
    ?>
      <tr>
                        <td> <?php echo $comment_name ?> </td>
                        <td> <?php echo $comment ?> </td>
                        <td> <?php echo $time ?> </td>
                    </tr>
                    <?php
                    }
                    ?>
                    </table>
                     <a href="index.php" class="button">返回</a>
                    <?php

}
    }
    else {
?>
            <div>
                <p>---留言區---</p>
<?php   
        $stmt = $conn->prepare("select * from comment where article_id = ?");
        $params = $article_id;
        $stmt->bind_param('s', $params);
        $stmt->execute();
        $query = $stmt->get_result();
        $stmt->close();
        $rows = mysqli_num_rows($query);

        if ($rows == 0) {
?>
                <span>寫些什麼吧</span>
                <form action="create_comment.php" method="post">
                    <input tpye="text" name="comment" autocomplete="off"/>
                    <button type="submit" name="submit" value="<?php echo $article_id ?>"> 送出 </button>
                </form>
<?php
        }
        else {
?>
                <table>
                    <tr>
                        <td> 姓名 </td>
                        <td> 留言 </td>
                        <td> 時間 </td>
                    </tr>
<?php
            for ($i = 0; $i < $rows; $i++) {
                $show_comment = mysqli_fetch_assoc($query);
                $comment_name = $show_comment['name'];
                $comment = $show_comment['content'];
                $time = $show_comment['time'];
?>
                    <tr>
                        <td> <?php echo $comment_name ?> </td>
                        <td> <?php echo $comment ?> </td>
                        <td> <?php echo $time ?> </td>
                    </tr>
<?php
            }
?>
                </table>

                <form action="create_comment.php" method="post">
                    <input tpye="text" name="comment"/>
                    <button type="submit" name="submit" value="<?php echo $article_id ?>"> 送出 </button>
                </form>
<?php
        }
?>
            </div>
            <a href="index.php" class="button">返回</a>
<?php
    }
}
else {
?>
            <div id="profile-area">
<?php
    $query = mysqli_query($conn, 'select * from update_data order by id desc');
    $rows = mysqli_num_rows($query);
    if ($rows === 0) {
?>
                <h1>尚無資料</h1>
<?php
    }
    else {
?>
                <ul>
<?php
        for ($i = 1; $i <= mysqli_num_rows($query); $i++) {
            $article_content = mysqli_fetch_assoc($query);
            $id = $article_content['id'];
            $name = $article_content['file_name'];
            $direction= $article_content['direction'];
            $image= $article_content['image'];
            // profile 圖片的 url
            $url = "./update/img/$direction/$image.jpg"; // $article_content['url'];
?>
                    <!-- <li><?php echo '<a href="index.php?article_id=',$id,'">',$name, '</a>'; ?></li> -->
                    <li class="profile-box">
                        <div class="cover">
<?php 
            echo '<a href="index.php?article_id=', $id,'" style="background-image: url(\'', $url, '\');"></a>';
?>
                        </div>
                    
                        <div class="title">
<?php
            echo '<a href="index.php?article_id=',htmlentities(urlencode($id)), '">', $name, '</a>';
?>
                        </div>
                    </li>
<?php
        }
    }
?>
                </ul>
            </div>
<?php
}
// if ($handle = opendir('./update/')) {  //開啟現在的資料夾
//       while (false !== ($file = readdir($handle))) {
// //避免搜尋到的資料夾名稱是false,像是0
//           if ($file != "." && $file != "..") {
// //去除掉..跟.
//               echo "<a href='index.php?article_id=<?php echo >$file</a><br>";             
//           }
//       }
//       closedir($handle);
//   }
?>
        </div>
    </div>

<?php
require('./template/footer.php');
?>
