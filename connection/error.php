<?php
	echo "帳號或密碼錯誤，2秒後返回";
	header("refresh:2;url=./login.html");
	die();
?>