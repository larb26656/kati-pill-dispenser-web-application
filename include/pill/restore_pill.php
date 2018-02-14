<?php
	define('||', 'OR');
	
	include '../../connect.php';

	if(isset($_GET['pill_id'])) 
	{
		$pill_id = $_GET['pill_id'];

		$sql = "UPDATE pill SET Pill_visiblestatus = '1' WHERE Pill_id='$pill_id';";
		$data = mysqli_query($conn,$sql);
	}
	else
	{
		echo "Error 404 - page not found!";
	}
?>