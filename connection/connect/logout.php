<?php
session_start();

if (session_destroy()) {
	ob_start();
	echo "已登出";
    header("refresh:0.75; url=../index.php");
    ob_end_flush();
}
?>
