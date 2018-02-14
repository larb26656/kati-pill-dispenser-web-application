<?php
	include '../../../connect.php';

		$robot_lang = $_POST['robot_lang'];
		$provinces_id = $_POST['provinces_id'];

		$sql = "UPDATE robot_setting
SET Robot_lang = '$robot_lang' , Provinces_id = '$provinces_id'  WHERE robot_setting_id = '1';";
echo $sql;
		$data = mysqli_query($conn,$sql);

?>