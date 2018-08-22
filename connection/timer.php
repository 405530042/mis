<?php
$stmt = $conn->prepare("select * from direction where status = 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $today= strtotime(date("Y-m-d\TH:i:s"));
     if(mysqli_num_rows($result)!=0){
    for($i=0;$i<mysqli_num_rows($result);$i++){
     $row = mysqli_fetch_assoc($result);
     $deadline=strtotime($row['deadline']);
     if($deadline<=$today){
    $stmt = $conn->prepare("UPDATE direction SET status = 0 where id =?");
    $direction_id=$row['id'];
    $stmt->bind_param('s',$direction_id);
    $stmt->execute();
    $stmt->close();
}
   }
 }
 ?>