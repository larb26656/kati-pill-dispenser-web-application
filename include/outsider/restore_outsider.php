<?php
	define('||', 'OR');
	
	include '../../connect.php';

	if(isset($_GET['outsider_id'])) 
	{
		$outsider_id = $_GET['outsider_id'];

		$sql = "UPDATE outsider SET Outsider_visiblestatus = '1' WHERE Outsider_id='$outsider_id';";
		$data = mysqli_query($conn,$sql);
	}
	else
	{
		echo "Error 404 - page not found!";
	}
?>