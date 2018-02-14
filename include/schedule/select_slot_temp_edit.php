<?php
session_start();
include("../../lang_check.php");
 include("../../connect.php");
if($_POST['slot_id_temp']==""){

}
else{
	$slot_id_temp_array= explode(",", $_POST['slot_id_temp']);
foreach($slot_id_temp_array as $key => $value) {
	$slot_id_temp=$slot_id_temp_array[$key];
	$sql = "SELECT * FROM `slot` INNER JOIN pill ON slot.Pill_id = pill.Pill_id WHERE slot.Slot_id = '$slot_id_temp'";
	$result=$conn->query($sql); 
	$row=$result->fetch_assoc();
   echo "<p>".$row['Pill_commonname_'.$strEtclanglabel].' <button type="button" class="btn btn-danger btn-xs" onClick="remove_slot_temp('.$key.')">'.$strTabledeletebutton.'</button></p>';
}

}


echo '<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#insert_slot_temp">'.$strTableinsertbutton.'</button></p>';
?>