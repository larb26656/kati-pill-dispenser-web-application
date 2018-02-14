<?php
	define('||', 'OR');
	
	include '../../connect.php';


		$Conversation_quiz = $_POST['Conversation_quiz'];
		$Conversation_type = $_POST['Conversation_type'];
		$Conversation_language = $_POST['Conversation_language'];
		$Pill_id = $_POST['Pill_id'];
		if($Conversation_type == "pill_dispenser"){

		$sql = "INSERT INTO conversation (Conversation_quiz, Conversation_type,Conversation_language,Pill_id,Conversation_visiblestatus)
VALUES ('$Conversation_quiz','$Conversation_type','$Conversation_language','$Pill_id','1');";
		$data = mysqli_query($conn,$sql);
		}
		else{
		$sql = "INSERT INTO conversation (Conversation_quiz, Conversation_type,Conversation_language,Pill_id,Conversation_visiblestatus)
VALUES ('$Conversation_quiz','$Conversation_type','$Conversation_language','0','1');";
		$data = mysqli_query($conn,$sql);
		}

	
?>