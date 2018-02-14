<?php 
	include '../../connect.php';
$Memo_desc = $_POST['Memo_desc'];
$Memo_notification_date = $_POST['Memo_notification_date'];
$Memo_notification_time = $_POST['hours'].":".$_POST['minutes'].":"."00";


$sql = "INSERT INTO memo (Memo_desc, Memo_notification_date, Memo_notification_time,Memo_notification_day,Memo_visiblestatus)
VALUES ('$Memo_desc','$Memo_notification_date','$Memo_notification_time','','1');";
		$data = mysqli_query($conn,$sql);
?>