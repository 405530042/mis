<?php
session_start();

if (session_destroy()) {
	echo "已登出";
    header("refresh:0.75; url=../view.php");
}
?>
