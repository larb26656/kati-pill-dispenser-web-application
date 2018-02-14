<?php
	define('||', 'OR');
	
	include '../../connect.php';

		$Pill_commonname_thai = $_POST['Pill_commonname_thai'];
		$Pill_commonname_english = $_POST['Pill_commonname_english'];
		$Pill_brandname_thai = $_POST['Pill_brandname_thai'];
		$Pill_brandname_english = $_POST['Pill_brandname_english'];
		$Pill_properties_thai = $_POST['Pill_properties_thai'];
		$Pill_properties_english = $_POST['Pill_properties_english'];
		$Pill_duration = $_POST['Pill_duration'];
		$Pill_dispenseramount = $_POST['Pill_dispenseramount'];
		$Pill_amount = $_POST['Pill_amount'];
		$Pill_expiry_date = $_POST['Pill_expiry_date'];
		echo $Pill_expiry_date;


		$sql = "INSERT INTO pill (Pill_commonname_thai,Pill_commonname_english, Pill_brandname_thai,Pill_brandname_english,Pill_properties_thai,Pill_properties_english,Pill_duration,Pill_dispenseramount,Pill_left,Pill_expiry_date,Pill_visiblestatus)
VALUES ('$Pill_commonname_thai','$Pill_commonname_english','$Pill_brandname_thai ','$Pill_brandname_english ','$Pill_properties_thai','$Pill_properties_english','$Pill_duration','$Pill_dispenseramount','$Pill_amount','$Pill_expiry_date','1');";
	   echo $sql;
		$data = mysqli_query($conn,$sql);

?>