<?php
	include '../../connect.php';
	
	session_start();
	
	$sql = "SELECT * FROM `behavior_notification` INNER JOIN behavior ON behavior_notification.Behavior_id=behavior.Behavior_id WHERE Msg_status = '1' AND Member_id=".$_SESSION['Member_id']."";
	$result = mysqli_query($conn, $sql);
	$sql2 = "SELECT * FROM `pill_log_notification` INNER JOIN pill_log ON pill_log_notification.Pill_log_id=pill_log.Pill_log_id WHERE Msg_status = '1' AND Member_id=".$_SESSION['Member_id']."";
	$result2 = mysqli_query($conn, $sql2);
	$badge_number = mysqli_num_rows($result)+mysqli_num_rows($result2);
	$data = array(
		'badge_number' => $badge_number
	);
	echo json_encode($data);
?>