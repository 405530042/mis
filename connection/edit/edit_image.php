<?php 

require('../connect/connect.php');

require('../connect/function.php');

require('../template/header.php');

session_start();

if ($_SESSION['user_id'] != 3) {

	echo '權限不足';

// 	header("refresh:0.75; url=../index.php");

?>

			<script type="text/javascript">

			    setTimeout(() => {

			        window.location ="../index.php";

			    }, 750);

            </script>

<?php

}

else {

	$stmt = $conn->prepare("SELECT * FROM direction WHERE status = 1");

	$stmt->execute();

	$result = $stmt->get_result();

	

	$stmt->close();

?>

	<form action="" enctype="multipart/form-data" method="post">

		上傳封面圖片:<?php echo   $_SESSION['article_id']; ?>

		<br />

		<br />

		<br><label for="direction">選擇資料夾:	

			<select name="direction" id="">

			<?php for($i=0;$i<mysqli_num_rows($result);$i++){

				$rows=mysqli_fetch_assoc($result);

				$items=$rows['dir_name'];

				echo "<option value=$items>$items</option>";

			

			}  ?>

		</select>

		</label>

		<br />

		<br />

		<input type="file" id="file" name="file" accept="image/*" value="" required />

		<br />

		<br>

			<br>

		<input type="submit" name="image" value="送出" />

	</form>

<?php

}



require('../template/footer.php');

?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(isset($_POST['image'])){

		if (is_uploaded_file($_FILES['file']['tmp_name'])) {

				  if ($_FILES['file']['type'] != "image/jpeg" && $_FILES['file']['type'] != "image/jpge" && $_FILES['file']['type'] != "image/JPG" && $_FILES['file']['type'] != "image/png") {

				  		  $_SESSION['error']=6;

				  		  $_SESSION['type']= $_FILES['file']['type'];

				  		  ?> 

                <script type="text/javascript"> 

                   window.location ="../connect/error.php";

                </script>

<?php

		}

		else{

			if (!isset($_FILES['file']['tmp_name']) || trim($_FILES['file']['tmp_name']) == '') {

            $_SESSION['error']=6;

            // header("location: ../connect/error.php");

?>

			<script type="text/javascript">

			    setTimeout(() => {

			        window.location ="../connect/error.php";

			    }, 0);

            </script>

<?php

        }

        	else{

        		 $direction = htmlspecialchars($_POST['direction']);

            if( trim($direction) == ''||trim($direction) == NULL){

                $_SESSION['error'] = 11; 

                			  		  ?> 

                <script type="text/javascript"> 

                   window.location ="../connect/error.php";

                </script>

<?php

            }

            else{

            	 $stmt = $conn->prepare("SELECT * FROM direction WHERE dir_name =? AND status = 1");

                $params = $direction;

                $stmt->bind_param('s', $direction);

                $stmt->execute();

                $result = $stmt->get_result();

                $stmt->close();

                echo $_POST['direction'];

                echo $name = htmlspecialchars($_POST['name']);

                if (mysqli_num_rows($result) != 1) {

                    $_SESSION['error']=7;

                           			  		  ?> 

                <script type="text/javascript"> 

                   window.location ="../connect/error.php";

                </script>

<?php

                }

                  else {

                    $name = $id;

                    $result = move_uploaded_file($_FILES['file']['tmp_name'], "../update/img/$direction/$name.jpg");



                    if ($result == 1) { 

                    	$stmt = $conn->prepare("UPDATE update_data SET image = ? WHERE id =? ");

                    	$article_id=$_SESSION['article_id'];

		                $params =$name+".jpg";

		                $stmt->bind_param('si', $params,$article_id);

		                $stmt->execute();

		                $result = $stmt->get_result();

		                $stmt->close();

                        $_SESSION['error']=8;

                         			  		  ?> 

                <script type="text/javascript"> 

                   window.location ="../connect/error.php";

                </script>

<?php

                    }

                    else {

                        $_SESSION['error']=20;

                           			  		  ?> 

                <script type="text/javascript"> 

                   window.location ="../connect/error.php";

                </script>

<?php

                    }

                }

            }

        	}

		}

	}

}

}

?>