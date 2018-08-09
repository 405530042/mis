<?php
session_start();
if(session_destroy()){
	echo "已登出";
    header("refresh:2;url=../view.php");
	}
?>