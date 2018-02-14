<?php
	define('||', 'OR');
	
	include '../../connect.php';

	if(isset($_GET['Schedule_id'])) 
	{
		$Schedule_id = $_GET['Schedule_id'];
		$sql ="UPDATE schedule SET Schedule_visiblestatus = '0' WHERE Schedule_id='$Schedule_id'";
		$data = mysqli_query($conn,$sql);
	}
	else
	{
		echo "Error 404 - page not found!";
	}
?>