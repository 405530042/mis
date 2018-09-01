

<?php

require('../connect/session.php');  

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(isset($_POST['image'])){

		if (is_uploaded_file($_FILES['file']['tmp_name'])) {

				  if ($_FILES['file']['type'] != "image/jpeg" && $_FILES['file']['type'] != "image/jpge" && $_FILES['file']['type'] != "image/JPG" && $_FILES['file']['type'] != "image/png") {

				  		  $_SESSION['error']=6;

				  		  $_SESSION['type']= $_FILES['file']['type'];

                            //  header("location: ../connect/error.php");

?>

			<script type="text/javascript">

			    setTimeout(() => {

			        window.location ="../connect/error.php";

			    }, 0);

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

                    // header("location: ../connect/error.php");

?>

			<script type="text/javascript">

			    setTimeout(() => {

			        window.location ="../connect/error.php";

			    }, 0);

            </script>

<?php

                }

                  else {

                    $name = $id;

                    $result = move_uploaded_file($_FILES['file']['tmp_name'], "../update/img/$direction/$name.jpg");



                    if ($result == 1) { 

                    	$artiecle_id =$_SESSION['article_id'];

                    	$stmt = $conn->prepare("INSERT INTO update_data(image) VALUES(?) WHERE id =? ");

		                $params =$name;

		                $stmt->bind_param('s', $params);

		                $stmt->execute();

		                $result = $stmt->get_result();

		                $stmt->close();

                        $_SESSION['error']=8;

                        // header("location: ../connect/error.php");

?>

			<script type="text/javascript">

			    setTimeout(() => {

			        window.location ="../connect/error.php";

			    }, 0);

            </script>

<?php

                    }

                    else {

                        $_SESSION['error']=20;

                        // header("location: ../connect/error.php");

?>

			<script type="text/javascript">

			    setTimeout(() => {

			        window.location ="../connect/error.php";

			    }, 0);

            </script>

<?php

                    }

                }

            }

        	}

		}

	}

	else{

        $_SESSION['error']=20;

        // header("location: ../connect/error.php");

?>

			<script type="text/javascript">

			    setTimeout(() => {

			        window.location ="../connect/error.php";

			    }, 0);

            </script>

<?php

	}

}

}

?>