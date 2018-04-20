<?php
include("lang_check.php");
include("../../../connect.php");
$sql = "SELECT * FROM `provinces`";
$result=$conn->query($sql);
$sql2 = "SELECT Config_value FROM `config` WHERE Config_name = 'Robot_provinces_id' AND Config_visiblestatus = '1'";
$result2=$conn->query($sql2);
$row2=$result2->fetch_assoc();
while($row=$result->fetch_assoc()){
	$provinces_id=$row['Provinces_id'];
  	echo "<option value='$provinces_id'"; if($row['Provinces_id']==$row2['Config_value']){echo 'selected="selected"';} echo ">".$row['Provinces_name_'.$strEtclanglabel]."</option>";
	}
?>
