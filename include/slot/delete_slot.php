<?php
	define('||', 'OR');

	include '../../connect.php';

	if(isset($_GET['slot_num']))
	{
		$slot_num = $_GET['slot_num'];
		$sql = "SELECT * FROM slot WHERE Slot_num='$slot_num' AND Slot_visiblestatus = '1';";
		$result=$conn->query($sql);
		$num_row = mysqli_num_rows($result);
		if($num_row > 0){
			$row=$result->fetch_assoc();
			$slot_id_old = $row['Slot_id'];
			$sql2 = "UPDATE `schedule` INNER JOIN dispenser ON `schedule`.`Schedule_id` = dispenser.`Schedule_id` SET Schedule_visiblestatus = '0' WHERE Slot_id = '$slot_id_old';";
			$data2 = mysqli_query($conn,$sql2);
		}
		$sql = "UPDATE slot SET Slot_visiblestatus = '0' WHERE Slot_num='$slot_num';";
		$data = mysqli_query($conn,$sql);
	}
	else
	{
		echo "Error 404 - page not found!";
	}
?>
