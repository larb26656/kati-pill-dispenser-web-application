<?php
	define('||', 'OR');
	
	include '../../connect.php';


		$Outsider_firstname = $_POST['Outsider_firstname'];
		$Outsider_surname = $_POST['Outsider_surname'];
		$Outsider_level = $_POST['Outsider_level'];
		$Outsider_token = $_POST['Outsider_token'];

		$sql = "INSERT INTO outsider (Outsider_firstname, Outsider_surname, Outsider_level,Outsider_token,Outsider_visiblestatus)
VALUES ('$Outsider_firstname','$Outsider_surname','$Outsider_level','$Outsider_token','1');";
		$data = mysqli_query($conn,$sql);
		
?>