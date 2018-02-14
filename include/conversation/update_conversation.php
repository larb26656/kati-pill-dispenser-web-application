<?php
	define('||', 'OR');
	
	include '../../connect.php';

		$Conversation_id = $_POST['Conversation_id'];
		$Conversation_quiz = $_POST['Conversation_quiz'];
		$Conversation_type = $_POST['Conversation_type'];
		$Conversation_language = $_POST['Conversation_language'];
		$Pill_id = $_POST['Pill_id'];
		if($Conversation_type == "pill_dispenser"){
		$sql = "UPDATE conversation
SET Conversation_quiz = '$Conversation_quiz', Conversation_type = '$Conversation_type' , Conversation_language = '$Conversation_language', Pill_id = '$Pill_id'
WHERE Conversation_id = '$Conversation_id';";
		$data = mysqli_query($conn,$sql);
	}
	else{
		$sql = "UPDATE conversation
SET Conversation_quiz = '$Conversation_quiz', Conversation_type = '$Conversation_type' , Conversation_language = '$Conversation_language', Pill_id = '0'
WHERE Conversation_id = '$Conversation_id';";
		$data = mysqli_query($conn,$sql);
	}
	
?>