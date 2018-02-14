<?php session_start();
include("../../lang_check.php");
include '../../connect.php';
$sql = "SELECT * FROM `behavior` WHERE SUBSTR(Behavior_datetime, 1,10) = CURDATE();";
   $result=$conn->query($sql);
    $num_row = mysqli_num_rows($result);
   if($num_row > 0){    
  $sql3 = "SELECT Behavior_type,COUNT(Behavior_type) AS Count_behavior_type FROM `behavior` WHERE SUBSTR(Behavior_datetime, 1,10) = CURDATE() AND Behavior_type = 'forgottakepill' GROUP BY Behavior_type";
  $result3=$conn->query($sql3);
  $num_row3 = mysqli_num_rows($result3);
  if($num_row3 > 0 ){
    while($row3=$result3->fetch_assoc()){
        $behavior_value=$row3['Count_behavior_type'];
      }
  }
  else{
    $behavior_value=0;
  }
}
else{
  $behavior_value=0;
}
 echo unit_convert($behavior_value,$strTimesunit);
  ?>