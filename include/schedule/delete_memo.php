<?php
	define('||', 'OR');
	
	include '../../connect.php';

	if(isset($_GET['Memo_id'])) 
	{
		$Memo_id = $_GET['Memo_id'];
		$sql ="UPDATE memo SET Memo_visiblestatus = '0' WHERE Memo_id='$Memo_id'";
		$data = mysqli_query($conn,$sql);
	}
	else
	{
		echo "Error 404 - page not found!";
	}
?>