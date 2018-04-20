<?php
include("../connect.php");
$sql = "SELECT Config_value FROM `config` WHERE Config_name = 'Robot_lang' AND Config_visiblestatus = '1'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
if($row['Config_value']=="thai"){
	$lang='../lang/th.php';

}
elseif($row['Config_value']=="english"){
	$lang='../lang/en.php';
}
include($lang);
?>
