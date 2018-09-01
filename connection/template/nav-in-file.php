<?php session_start(); 
date_default_timezone_set("Asia/Taipei");?>
<div class="nav">
    <ul>
<?php
 if(isset($_SESSION['user_id'] )){
if ($_SESSION['user_id'] == 0) {
?>
        <span></span>
	    <span>
            <li>
                <a href="../login.html">
                    登入
                </a>
            </li>

        </span>
<?php
}
else {
    if ($_SESSION['user_id']== 2) {
?>
        <span>
            <li>
                <a href="../profile.php">
                    隊伍檔案
                </a>
            </li>
        </span>
        <span>
            <li class="li-user-name">
                <a>
                    <?php echo $_SESSION['name'];  ?>
                </a>
            </li>
            <li>
                <a href="../change_password.php">
                    修改密碼
                </a>
            </li>
            <li>
                <a href="../connect/logout.php">
                    登出
                </a>
            </li>
        </span>

<?php
    }
	else if ($_SESSION['user_id'] == 3) {
?>
        <span>
    	    <li>
                <a href="../profile.php">
                    隊伍檔案
                </a>
            </li>
    	    <li>
                <a href="../update.php">
                    上傳檔案
                </a>
            </li>
        </span>
        <span>
            <li class="li-user-name">
                <a>
                   <?php echo $_SESSION['name'];  ?>
                </a>
            </li>
                <li>
                <a href="../change_password.php">
                    修改密碼
                </a>
            </li>
	        <li>
                <a href="../connect/logout.php">
                    登出
                </a>
            </li>
        </span>
<?php
	}
    else if ($_SESSION['user_id'] == 4) {
?>
        <span>
	        <li>
                <a href="../login_time.php">
                    查看登入狀況
                </a>
            </li>
	        <li>
                <a href="../create_member.php">
                    設定登入人員名單
                </a>
            </li>
        </span>
        <span>
            <li class="li-user-name">
                <a>
                     <?php echo $_SESSION['name'];  ?>
                </a>
            </li>
	        <li>
                <a href="../connect/logout.php">
                    登出
                </a>
            </li>
        </span>
<?php
	}
    else if ($_SESSION['user_id']== 1) {
?>
            <span>
            <li>
                <a href="../score.php">
                    評分成績
                </a>
            </li>
        </span>
        <span>
            <li class="li-user-name">
                <a>
                     <?php echo $_SESSION['name'];  ?>
                </a>
            </li>
            <li>
                <a href="../connect/logout.php">
                    登出
                </a>
            </li>
        </span>
<?php
    }
    else if ($_SESSION['user_id'] == 5) {
?>
        <span>
            <li>
                <a href="../login_time.php">
                    查看登入狀況
                </a>
            </li>
            <li>
                <a href="../create_member.php">
                    設定登入人員名單
                </a>
            </li>
            <li>
                <a href="../create_dir.php">
                    新增作品資料夾
                </a>
            </li>
        </span>
        <span>
            <li class="li-user-name">
                <a>
                    <?php echo $_SESSION['name'];  ?>
                </a>
            </li>
            <li>
                <a href="../connect/logout.php">
                    登出
                </a>
            </li>
        </span>
        <?php
    }
}
}
else
{
    ?>
     <span></span>
        <span>
            <li>
                <a href="../login.html">
                    登入
                </a>
            </li>

        </span>
        <?php
}
?>
    </ul>
</div>
