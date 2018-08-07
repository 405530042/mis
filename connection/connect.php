<?php
$connection = mysql_connect("localhost:8000", "mis", "mis@ccu");
$db=mysql_select_db("display", $connection);
mysql_query("set names utf8");
?>