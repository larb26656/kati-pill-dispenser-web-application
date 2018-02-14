<?php
	define('||', 'OR');
	include '../../connect.php';
		$schedule_id = $_POST['schedule_id'];
		$slot_id_temp_array = explode(",", $_POST['slot_id_temp']);
		$schedule_time = $_POST['hours'].":".$_POST['minutes'].":"."00";
		$sql = "UPDATE schedule SET Schedule_visiblestatus='0' WHERE Schedule_id='$schedule_id';";
		$result = mysqli_query($conn,$sql);
		$sql2 = "INSERT INTO schedule (Schedule_time, Schedule_visiblestatus) VALUES ('$schedule_time','1');";
		$result2 = mysqli_query($conn,$sql2);
		$sql3 = "SELECT * FROM schedule ORDER BY Schedule_id DESC LIMIT 1";
		$result3 = mysqli_query($conn,$sql3);
		$row3=$result3->fetch_assoc();
		foreach($slot_id_temp_array as $key => $value) {
		$schedule_id=$row3['Schedule_id'];
		$slot_id_temp=$slot_id_temp_array[$key];
		$sql3 = "INSERT INTO dispenser (Schedule_id,Slot_id) VALUES ('$schedule_id','$slot_id_temp');";
		$result3 = mysqli_query($conn,$sql3);
		}
?>