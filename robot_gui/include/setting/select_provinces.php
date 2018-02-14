<?php 
include("lang_check.php");
include("../../../connect.php");
$sql = "SELECT * FROM `provinces`";
$result=$conn->query($sql); 
$sql2 = "SELECT * FROM `robot_setting`";
$result2=$conn->query($sql2); 
$row2=$result2->fetch_assoc();
while($row=$result->fetch_assoc()){
	$provinces_id=$row['Provinces_id'];
  	echo "<option value='$provinces_id'"; if($row['Provinces_id']==$row2['Provinces_id']){echo 'selected="selected"';} echo ">".$row['Provinces_name_'.$strEtclanglabel]."</option>";
	}
?>