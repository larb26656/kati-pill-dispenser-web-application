<?php
	define('||', 'OR');
	
	include '../../connect.php';

	if(isset($_GET['slot_num']) && isset($_GET['pill_id'])) 
	{
		$slot_num = $_GET['slot_num'];
		$pill_id = $_GET['pill_id'];

		$sql = "UPDATE slot SET Slot_visiblestatus = '0' WHERE Slot_num='$slot_num';";
		$data = mysqli_query($conn,$sql);

		$sql2 = "INSERT INTO slot (Slot_num, Pill_id,Slot_visiblestatus) VALUES ('$slot_num','$pill_id','1');";
		$data2 = mysqli_query($conn,$sql2);
	}
	else
	{
		echo "Error 404 - page not found!";
	}
?>