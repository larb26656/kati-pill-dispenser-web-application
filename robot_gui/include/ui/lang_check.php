<?php
include("../../../connect.php");
$sql = "SELECT * FROM `robot_setting`";
$result=$conn->query($sql); 
$row=$result->fetch_assoc();
if($row['Robot_lang']=="thai"){
	$lang='../../../lang/th.php';
	
}
elseif($row['Robot_lang']=="english"){
	$lang='../../../lang/en.php';
}
include($lang);
?>