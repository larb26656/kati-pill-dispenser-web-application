<?php
	include '../../../connect.php';

		$robot_lang = $_POST['robot_lang'];
		$provinces_id = $_POST['provinces_id'];
		$sql = "UPDATE config SET Config_value = '$robot_lang' WHERE Config_name = 'Robot_lang';";
		$sql2 = "UPDATE config SET Config_value = '$provinces_id' WHERE Config_name = 'Robot_provinces_id';";
		$data = mysqli_query($conn,$sql);
		$data2 = mysqli_query($conn,$sql2);
?>
