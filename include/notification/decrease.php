<?php
	include '../../connect.php';

		session_start();
	
	$sql = "UPDATE `behavior_notification` SET Msg_status = 0 WHERE Member_id=".$_SESSION['Member_id']."";
	$result = mysqli_query($conn, $sql);
	$sql2 = "UPDATE `pill_log_notification` SET Msg_status = 0 WHERE Member_id=".$_SESSION['Member_id']."";
	$result2 = mysqli_query($conn, $sql2);
	$badge_number = mysqli_num_rows($result)+mysqli_num_rows($result2);
	$data = array(
		'badge_number' => 0
	);
	echo json_encode($data);
?>