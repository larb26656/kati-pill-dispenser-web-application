<?php
if(isset($_POST["Memo_desc"]) AND isset($_POST["Memo_notification_date"]) AND isset($_POST["Memo_notification_time"])){
	include("../connect.php");
	$Memo_desc = $_POST["Memo_desc"];
	$Memo_notification_date = $_POST["Memo_notification_date"];
	$Memo_notification_time = $_POST["Memo_notification_time"];
	$sql = "INSERT INTO memo (Memo_desc, Memo_notification_date, Memo_notification_time,Memo_notification_day,Memo_visiblestatus)
VALUES ('$Memo_desc','$Memo_notification_date','$Memo_notification_time','','1');";
	$data = mysqli_query($conn,$sql);
}
else{
	echo"404 page not found.";
}
?>