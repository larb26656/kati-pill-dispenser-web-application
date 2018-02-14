<?php
	define('||', 'OR');
	
	include '../../connect.php';
		$slot_id_temp_array= explode(",", $_POST['slot_id_temp']);
		$Schedule_time = $_POST['hours'].":".$_POST['minutes'].":"."00";
		$sql = "INSERT INTO schedule (Schedule_time, Schedule_visiblestatus)
VALUES ('$Schedule_time','1');";
		$result = mysqli_query($conn,$sql);
		$sql2 = "SELECT * FROM schedule ORDER BY Schedule_id DESC LIMIT 1";
		$result2 = mysqli_query($conn,$sql2);
		$row=$result2->fetch_assoc();
		foreach($slot_id_temp_array as $key => $value) {
		$schedule_id=$row['Schedule_id'];
		$slot_id_temp=$slot_id_temp_array[$key];
		$sql3 = "INSERT INTO dispenser (Schedule_id,Slot_id) VALUES ('$schedule_id','$slot_id_temp');";
		$result3 = mysqli_query($conn,$sql3);
		}
?>