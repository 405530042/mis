<?php 
include('./connect/session.php');
require('./template/header.php');
require('./template/nav.php');

if ($user_id != 3 && $user_id != 2) {
    echo '權限不足';
    header("refresh:2; url=./index.php");
}
else {
    $query_teamname = $conn->prepare("select * from member where team = ?");
    $params = $team;
    $query_teamname->bind_param('s', $params);
    $query_teamname->execute();
    $result = $query_teamname->get_result();
    $query_teamname->close();

    $query = $conn->prepare("select * from update_data where team = ?");
    $params = $team;
    $query->bind_param('s',$params);
    $query->execute();
    $result2 = $query->get_result();
    $query->close();

    $team = mysqli_fetch_array($result);
    $rows = mysqli_num_rows($result2);
    $has_data = false;
    $update_time = '無';

    if ($rows == 0) {
        $has_data = false;
        $update_time = '無';
    }
    else {
        $has_data = true;
        $profile = mysqli_fetch_array($result2);
        $update_time = $profile['time'];
    }
?>
    <div id="page">
        <div id="profile-box">
            <div id="profile-title"> PROFILE </div>

            <div id="profile-content">
                <div id="header">
                    <h1 id="team-name">
                       組別: <?php echo $team['team']; ?>
                    </h1>
                    <h5 id="update-date">
                        <?php echo '#最後修改日期：' . $update_time; ?>
                    </h5>
                </div>

                <div class="hr"></div>
<?php
    if ($has_data) {
?>
                <div id="text">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label> 作品名稱 </label>
                            <label class="detail">
                                <?php echo $profile['file_name']; ?>
                            </label>
                        </div>

                        <div class="form-group">
                            <label> 作品簡介 </label>
                            <label class="detail">
                                <?php echo $profile['intro']; ?>
                            </label>
                        </div>
                        <div class="form-group">
                            <label >作品瀏覽</label>
                            <label class="detal">
                                <iframe style="pointer-events: none; user-select: none;" type="application/pdf" name="myiframe" id="myiframe" src="update/<?php echo $profile['file_name'] . '.pdf' ;?>"></iframe>
                            </label>
                        </div>
<?php
        if ($user_id == 3) {
?> 
                        <div class="form-group">
                            <button type="submit" name="edit" method="post" value="<?php echo $profile['id'] ?>">
                                更改內容
                            </button>
                            <button class="back"><a href="index.php">回上一頁</a></button>
                        </div>
                    </form>
                </div>
<?php
        }
        else {
?>
                <div class="form-group">
                    <button class="back"><a href="index.php">回上一頁</a> </button>
                </div>
<?php
        }
    }
    else {
?>
                <div id="text">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label> 尚無檔案上傳。 </label>
                        </div>

                        <div class="form-group">
                            <button class="back"><a href="index.php"> 回上一頁 </a></button>
                        </div>
                    </form>
                </div>
<?php
    }
?>
            </div>
        </div>
    </div>

<?php
}

require('./template/footer.php');
?>
