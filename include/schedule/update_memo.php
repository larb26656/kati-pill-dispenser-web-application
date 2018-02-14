<?php 
	include '../../connect.php';
$Memo_id = $_POST['Memo_id'];
$Memo_desc = $_POST['Memo_desc'];
$Memo_notification_time = $_POST['hours'].":".$_POST['minutes'].":"."00";
$Memo_notification_day = $_POST['Memo_notification_day'];


$sql = "UPDATE memo SET Memo_desc = '$Memo_desc', Memo_notification_time = '$Memo_notification_time',Memo_notification_day = '$Memo_notification_day' WHERE Memo_id = '$Memo_id'";
		$data = mysqli_query($conn,$sql);
?>