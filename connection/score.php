<?php 

include('./connect/connect.php');

require('./template/header.php');

require('./template/nav.php');

require('./connect/function.php');

if ($_SESSION['user_id']!= 1) {

    echo '權限不足';

    // header("refresh:2; url=./index.php");

?>

			<script type="text/javascript">

			    setTimeout(() => {

			        window.location ="./index.php";

			    }, 2000);

            </script>

<?php

}

else {
?>
	<div id="direction">
		<h1>選擇項目評分:</h1>
<?php 
    $stmt = $conn->prepare("SELECT * FROM direction WHERE status =0");
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    	for($i=0;$i<mysqli_num_rows($result);$i++)
    	{
   			$row = mysqli_fetch_assoc($result);
?>
   			<button onclick="li2(`<?php echo $row['dir_name'] ?>`)"><?php echo $row['dir_name'] ?> </button>
<?php
    	}

?>
		<table id="data"></table>
	</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"
 integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous">
  	// 'use strict';
const li2 = (id) =>{
   $.ajax({
      url:"score_table.php",				
      method:"POST",
      data:{
         id:id
      },					
      success:function(res){					
          $('#data').html(res);
      }
   })//end ajax
}

 function aaaa() {
 	alert()
 }
  </script>


<?php } 

require('./template/footer.php');

?>