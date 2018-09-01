<?php
session_start();

if (session_destroy()) {
	echo "已登出";
    // header("refresh:0.75; url=../index.php");
?>
			<script type="text/javascript">
			    setTimeout(() => {
			        window.location ="../index.php";
			    }, 750);
            </script>
<?php
}
?>
