<?php
if(isset($_GET['schedule_id'])){
	$Schedule_id = $_GET['schedule_id'];
	include ('../../connect.php');
	$sql = "SELECT * FROM `schedule` WHERE Schedule_id='$Schedule_id'";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	$sql2 = "SELECT * FROM `dispenser` INNER JOIN slot ON dispenser.Slot_id = slot.Slot_id INNER JOIN pill ON slot.Pill_id = pill.Pill_id WHERE Schedule_id = '$Schedule_id'";
	$result2=$conn->query($sql2);
	$slot_list = array();
	$index_of_slot_list = 0 ;
	while($row2=$result2->fetch_assoc()){
		$slot_list[$index_of_slot_list] = $row2['Slot_id'];
		$index_of_slot_list++;
	}
	$resultJSON = json_encode($slot_list);
	echo $resultJSON;
}
else{
	echo "[]";
}

?>