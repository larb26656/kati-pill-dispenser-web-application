<?php
	define('||', 'OR');
	
	include '../../connect.php';

	if(isset($_GET['member_id'])) 
	{
		$member_id = $_GET['member_id'];

		$sql = "UPDATE member SET Member_visiblestatus = '1' WHERE Member_id='$member_id';";
		$data = mysqli_query($conn,$sql);
	}
	else
	{
		echo "Error 404 - page not found!";
	}
?>