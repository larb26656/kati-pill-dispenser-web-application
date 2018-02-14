<?php
	define('||', 'OR');
	
	include '../../connect.php';

	if(isset($_GET['slot_num'])) 
	{
		$slot_num = $_GET['slot_num'];

		$sql = "UPDATE slot SET Slot_visiblestatus = '0' WHERE Slot_num='$slot_num';";
		$data = mysqli_query($conn,$sql);
	}
	else
	{
		echo "Error 404 - page not found!";
	}
?>