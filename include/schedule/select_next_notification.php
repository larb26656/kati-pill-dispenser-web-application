<?php 
session_start();
include("../../lang_check.php"); 
include '../../connect.php';
$sql = "SELECT Schedule_id,Schedule_time,FLOOR(TIME_TO_SEC(TIMEDIFF(CURTIME(),Schedule_time))/ 60) AS Timediff FROM schedule WHERE FLOOR(TIME_TO_SEC(TIMEDIFF(CURTIME(),Schedule_time))/ 60) < 0 AND Schedule_visiblestatus = '1' ORDER BY FLOOR(TIME_TO_SEC(TIMEDIFF(CURTIME(),Schedule_time))/ 60) DESC LIMIT 1";
$result=$conn->query($sql); 
$num_row = mysqli_num_rows($result);
if($num_row == '0'){
$sql = "SELECT Schedule_id,Schedule_time,FLOOR(TIME_TO_SEC(TIMEDIFF(CURTIME(),Schedule_time))/ 60) AS Timediff FROM schedule WHERE FLOOR(TIME_TO_SEC(TIMEDIFF(CURTIME(),Schedule_time))/ 60) >= 0 AND Schedule_visiblestatus = '1' ORDER BY FLOOR(TIME_TO_SEC(TIMEDIFF(CURTIME(),Schedule_time))/ 60) DESC LIMIT 1";
$result=$conn->query($sql);
$num_row = mysqli_num_rows($result);
if($num_row == '0'){
echo $strNoNextNotification;
}
else{
while($row=$result->fetch_assoc()){
echo $row['Schedule_time'];
}
}
}
else{
while($row=$result->fetch_assoc()){
echo $row['Schedule_time'];
}
}

?>