<?php
	define('||', 'OR');
	
	include '../../connect.php';

		$Pill_id = $_POST['Pill_id'];
		$Pill_commonname_thai = $_POST['Pill_commonname_thai'];
		$Pill_commonname_english = $_POST['Pill_commonname_english'];
		$Pill_brandname_thai = $_POST['Pill_brandname_thai'];
		$Pill_brandname_english = $_POST['Pill_brandname_english'];
		$Pill_properties_thai = $_POST['Pill_properties_thai'];
		$Pill_properties_english = $_POST['Pill_properties_english'];
		$Pill_duration = $_POST['Pill_duration'];
		$Pill_dispenseramount = $_POST['Pill_dispenseramount'];
		$Pill_left = $_POST['Pill_left'];
		$Pill_expiry_date = $_POST['Pill_expiry_date'];


		$sql = "UPDATE pill
		SET Pill_commonname_thai = '$Pill_commonname_thai', Pill_commonname_english = '$Pill_commonname_english', Pill_brandname_thai = '$Pill_brandname_thai', Pill_brandname_english = '$Pill_brandname_english',Pill_properties_thai = '$Pill_properties_thai',Pill_properties_english = '$Pill_properties_english',Pill_duration = '$Pill_duration' , Pill_dispenseramount = '$Pill_dispenseramount', Pill_left = '$Pill_left', Pill_expiry_date = '$Pill_expiry_date'
		WHERE Pill_id = '$Pill_id';";
		$data = mysqli_query($conn,$sql);
?>