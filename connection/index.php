<?php
require('./connect/connect.php');
require('./template/header.php');
require('./template/nav.php');
require('timer.php');
?>

    <div class="pre-container">
        <div class="msg-container">
            <header> 黏仔雲端 </header>
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
            <div class="hr"></div>
            <h1><center> 查無此資料 </center></h1>
<?php
    }
    else {
        $content = mysqli_fetch_assoc($article);
        $intro = $content['intro'];
        $file_name = $content['file_name'];
        $direction =$content['direction'];
        $team_number = $content['team'];
?>
            <div class="page-hint">
                <div> 作品瀏覽 > <?php echo $file_name . '.pdf'; ?> </div>
                <div>
                    <a href="./index.php">
                        回上一頁
                        <img src="./img/back.png" alt="back">
                    </a>
                </div>
            </div>
            
            <div class="hr"></div>
            
            <div class="msg-comment-title">
<?php
        $teammate = mysqli_query($conn, "select * from member where team like '$team_number'");
        $rows = mysqli_num_rows($teammate);
?>
                <li>隊伍成員：
<?php
        $mate = mysqli_fetch_assoc($teammate);
        echo $mate['name'];
        for ($i = 1; $i < $rows; $i++) {
            $mate = mysqli_fetch_assoc($teammate);
            echo '、' . $mate['name'];
        }
?>
                </li>
            </div>

            <div class="msg-comment-content">
                <div class="scroller">
                    <iframe style="pointer-events: none; user-select: none;" type="application/pdf" name="myiframe" id="myiframe" src="update/<?php echo $direction . '/' . $file_name . '.pdf' ;?>"></iframe>
                </div>
                <div class="comment-area">
                    <div class="commemt-title">
                        留&nbsp;&nbsp;&nbsp;&nbsp;言
                    </div>
                    <div class="comment">
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
                        <h3><center> 尚無留言 </center></h3>
<?php
        }
        else {
?>
                        <ul>
<?php

            for ($i = 0; $i < $rows; $i++) {
                $show_comment = mysqli_fetch_assoc($query);
                $comment_name = $show_comment['name'];
                $comment = $show_comment['content'];
                $time = $show_comment['time'];

                $stmt2 = $conn->prepare("select authentication, name from member where name = ?");
                $params2 = $comment_name;
                $stmt2->bind_param('s', $params2);
                $stmt2->execute();
                $query2 = $stmt2->get_result();
                $stmt2->close();
                $get_authentication_to_show_img = mysqli_fetch_assoc($query2);
?>
                            <li>
                                <div class="photo">
                                    <div style="background-image: url('./img/<?php echo $get_authentication_to_show_img['authentication'] ?>.png');"></div>
                                </div>
                                <div class="detail">
                                    <div class="name">
                                        <?php echo $comment_name ?>
                                    </div>
                                    <div class="content">
                                        <?php echo $comment ?>
                                    </div>
                                    <div class="date">
                                        <?php echo $time ?>
                                    </div>
                                </div>
                            </li>
<?php
            }
?>
                        </ul>
                    </div>
<?php
    if (!isset($_SESSION['user_id'] ) || trim($_SESSION['user_id'] ) == '') {
?>
                    <div class="comment-block">
                        <a href="login.html">
                            登入後才可發言。
                        </a>
                    </div>
<?php
    }
?>
                    <div class="comment-leave">
                        <form action="create_comment.php" method="post">
<?php
    if (!isset($_SESSION['user_id'] ) || trim($_SESSION['user_id'] ) == '') {
?>
                            <div class="user">
                                <div style="background-image: url('./img/2.png');"></div>
                                <div class="name"></div>
                            </div>
<?php
    }
    else {
?>
                            <div class="user">
                                <div style="background-image: url('./img/<?php echo $_SESSION['auth'] ?>.png');"></div>
                                <div class="name">
                                    <?php echo $_SESSION['name']; ?>
                                </div>
                            </div>
<?php
    }
?>
                            
                            <div class="msg">
                                <input tpye="text" name="comment" placeholder=". . . . . ." autocomplete="off" required />
                                
                                <div class="comment-submit">
                                    <button type="submit" name="submit" value="<?php echo $article_id ?>">
                                        送出
                                    </button>
                                    <a href="index.php" class="btn back">
                                        回上一頁
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<?php
        }
    }
}
else {
?>
            <div class="page-hint">
                <div> 首頁 </div>
                <div></div>
            </div>
            
            <div class="hr"></div>

            <div class="profile-area">
<?php
    $query = mysqli_query($conn, 'select * from update_data order by id desc');
    $rows = mysqli_num_rows($query);
    if ($rows === 0) {
?>
                <h1><center> 尚無資料 </center></h1>
<?php
    }
    else {
?>
                <header>
                    <span>
                        檔案
                    </span>
                </header>

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
<?php 
            echo '<a href="index.php?article_id=', $id,'"><div class="cover" style="background-image: url(\'', $url, '\');"></div></a>';
?>
                    
                        <div class="title">
<?php
            echo '<span>' . $name . '</span>';
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
