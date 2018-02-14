<?php
	define('||', 'OR');
	
	include '../../connect.php';

	if(isset($_GET['conversation_id'])) 
	{
		$conversation_id = $_GET['conversation_id'];

		$sql = "UPDATE conversation SET Conversation_visiblestatus = '1' WHERE Conversation_id='$conversation_id';";
		$data = mysqli_query($conn,$sql);
	}
	else
	{
		echo "Error 404 - page not found!";
	}
?>