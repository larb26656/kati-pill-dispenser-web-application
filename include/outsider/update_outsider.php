<?php
	define('||', 'OR');
	
	include '../../connect.php';

		$Outsider_id = $_POST['Outsider_id'];
		$Outsider_firstname = $_POST['Outsider_firstname'];
		$Outsider_surname = $_POST['Outsider_surname'];
		$Outsider_level = $_POST['Outsider_level'];
		$Outsider_token = $_POST['Outsider_token'];

		$sql = "UPDATE outsider
SET Outsider_firstname = '$Outsider_firstname', Outsider_surname = '$Outsider_surname', Outsider_level = '$Outsider_level' , Outsider_token = '$Outsider_token'
WHERE Outsider_id = '$Outsider_id';";
		$data = mysqli_query($conn,$sql);
		echo "true";
?>