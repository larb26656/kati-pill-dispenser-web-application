<?php 
	include '../../connect.php';
$Memo_id = $_POST['Memo_id'];
$Memo_desc = $_POST['Memo_desc'];
$Memo_notification_time = $_POST['hours'].":".$_POST['minutes'].":"."00";
$Memo_notification_date = $_POST['Memo_notification_date'];


$sql = "UPDATE memo SET Memo_desc='$Memo_desc',Memo_notification_date='$Memo_notification_date',Memo_notification_time='$Memo_notification_time' WHERE Memo_id='$Memo_id'";
		$data = mysqli_query($conn,$sql);
?>