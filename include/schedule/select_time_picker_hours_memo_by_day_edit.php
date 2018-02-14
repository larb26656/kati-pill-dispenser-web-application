<?php
session_start();
include("../../lang_check.php");
include("../../connect.php");
$memo_id = $_GET['memo_id'];
$dayofweek=get_day_of_week_num($_GET['dayofweek']);
function get_day_of_week_num($date){
	if (date('l', strtotime($date))=="Sunday"){
		return 1;
	}
	else if (date('l', strtotime($date))=="Monday"){
		return 2;
	}
	else if (date('l', strtotime($date))=="Tuesday"){
		return 3;
	}	
	else if (date('l', strtotime($date))=="Wednesday"){
		return 4;
	}	
	else if (date('l', strtotime($date))=="Thursday"){
		return 5;
	}	
	else if (date('l', strtotime($date))=="Friday"){
		return 6;
	}	
	else if (date('l', strtotime($date))=="Saturday"){
		return 7;
	}	
}
function super_unique($array)
{
  $result = array_map("unserialize", array_unique(array_map("serialize", $array)));

  foreach ($result as $key => $value)
  {
    if ( is_array($value) )
    {
      $result[$key] = super_unique($value);
    }
  }

  return $result;
}
function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}
function get_time_is_in_range($current_time,$range_1,$range_2){
	$date1 = DateTime::createFromFormat('H:i:s', $current_time);
	$date2 = DateTime::createFromFormat('H:i:s', $range_1);
	$date3 = DateTime::createFromFormat('H:i:s', $range_2);
	if ($date1 > $date2 && $date1 < $date3){
	   	return true;
	}
	else if($date1==$date2){
		return true;
	}
	else{
		return false;
	}
}
function get_time_range_is_overlap($start_time1,$end_time1,$start_time2,$end_time2)
{
 	if(($end_time1 < $start_time2)){
        return false;
    }
    else if(($start_time1 > $start_time2) && ($start_time1 > $end_time2)) {
        return false;
    }
    else{
        return true;
	}
}
function add_minutes_to_time( $time, $plusMinutes ) {
    $time = DateTime::createFromFormat( 'H:i:s', $time );
    $time->add( new DateInterval( 'PT' . ( (integer) $plusMinutes ) . 'M' ) );
    $newTime = $time->format( 'H:i:s' );
    return $newTime;
}
function get_minute_list($hours){
	$minutes = "0";
	for ($x = 0; $x <= 11; $x++) {
		$time_list[$x] = add_minutes_to_time( $hours.':00:00', $minutes );
		$minutes = $minutes + 5;
	}
	return $time_list;
}
function get_hours_list($dayofweek){
	$hours = "0";
	for ($x = 0; $x <= 23; $x++) {
		if(get_all_minute_list($x,$dayofweek)==[]){
		}
		else{
			$time_list[$x] = str_pad($hours, 2, '0', STR_PAD_LEFT);
		}
		$hours++;
	}

	return array_values($time_list);
}
function get_time_list_from_schedule_database($hours){
	global $conn;
	$x = 0;
	$sql = "SELECT `Schedule_time` AS range_1,ADDTIME(`Schedule_time`, SEC_TO_TIME(29*60)) AS range_2 FROM `schedule` WHERE `Schedule_visiblestatus` = 1 AND SUBSTR(ADDTIME(`Schedule_time`, SEC_TO_TIME(29*60)) ,1,2) = '$hours' ORDER BY range_1";
	$result=$conn->query($sql); 
	$num_row = mysqli_num_rows($result);
	if($num_row >= 1){
		 while($row=$result->fetch_assoc()){
			$time_list[$x]["range_1"]=$row['range_1'];
			$time_list[$x]["range_2"]=$row['range_2'];
			$x++;
		}
	}
	$sql2 = "SELECT `Schedule_time` AS range_1,ADDTIME(`Schedule_time`, SEC_TO_TIME(29*60)) AS range_2 FROM `schedule` WHERE `Schedule_visiblestatus` = 1 AND SUBSTR(`Schedule_time`,1,2) = '$hours' ORDER BY range_1";
	$result2=$conn->query($sql2); 
	$num_row2 = mysqli_num_rows($result2);
		if($num_row2 >= 1){
		 while($row2=$result2->fetch_assoc()){
			$time_list[$x]["range_1"]=$row2['range_1'];
			$time_list[$x]["range_2"]=$row2['range_2'];
			$x++;
		}
	}
	if($num_row <1 && $num_row2 <1){
		$time_list = [];
	}
	return $time_list;
}
function get_time_list_from_memo_database($hours,$dayofweek){
	global $conn,$memo_id;
	$x = 0;
	$sql = "SELECT `Memo_notification_time` AS range_1,ADDTIME(`Memo_notification_time`, SEC_TO_TIME(4*60)) AS range_2 FROM `memo` WHERE `Memo_visiblestatus` = 1 AND SUBSTR(ADDTIME(`Memo_notification_time`, SEC_TO_TIME(4*60)) ,1,2) = '$hours' AND SUBSTR(Memo_notification_day,".$dayofweek.",1) = 1 OR DAYOFWEEK(Memo_notification_date) = ".$dayofweek." AND not Memo_id = '$memo_id' ORDER BY range_1";
	$result=$conn->query($sql); 
	$num_row = mysqli_num_rows($result);
	if($num_row >= 1){
		 while($row=$result->fetch_assoc()){
			$time_list[$x]["range_1"]=$row['range_1'];
			$time_list[$x]["range_2"]=$row['range_2'];
			$x++;
		}
	}
	else{
		$time_list=[];
	}
	return $time_list;
}
function get_all_time_list($hours,$dayofweek){
	$time_list=(array_merge(get_time_list_from_schedule_database($hours),get_time_list_from_memo_database($hours,$dayofweek)));
	array_sort_by_column($time_list,"range_1");
	return array_values(super_unique($time_list));
}
function get_all_minute_list($hours,$dayofweek){
	$x=0;
	$time_list=[];
	foreach (get_minute_list($hours) as $key => $value) {
		$result="";
		foreach (get_all_time_list($hours,$dayofweek) as $key){
			if(get_time_is_in_range($value,$key["range_1"],$key["range_2"])==true || get_time_range_is_overlap($value,add_minutes_to_time($value,4),$key["range_1"],$key["range_2"])==true){
				$result="true";
			}
			else{

			}

		}
		if($result=="true"){
		}
		else{
			$time_list[$x]=substr($value,3,2);
			$x++;
		}
	}
	return $time_list;

}
$sql5 = "SELECT SUBSTR(`Memo_notification_time`,1,2) AS hour FROM `memo` WHERE memo_id = '".$memo_id."'";
$result5=$conn->query($sql5);
$row5=$result5->fetch_assoc();
$hour_default=$row5['hour']; 
	echo "<option value=''>".$strFormhoursblanklabel."</option>";
foreach (get_hours_list($dayofweek) as $key => $value) {
	$selected ='';
	if($value==$hour_default){$selected ='selected="selected"';}
	echo "<option value='$value'".$selected.">".$value."</option>";
	}
?>