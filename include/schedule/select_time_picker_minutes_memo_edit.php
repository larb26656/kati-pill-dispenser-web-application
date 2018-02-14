<?php
session_start();
include("../../lang_check.php");
include("../../connect.php");
$memo_id = $_GET['memo_id'];
$hours=$_GET['hours'];
$day_pattern=$_GET['day_pattern'];
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
function get_time_list_from_memo_database($hours,$day_pattern){
	global $conn,$memo_id;
	$x = 0;
	$sql = "SELECT `Memo_notification_time` AS range_1,ADDTIME(`Memo_notification_time`, SEC_TO_TIME(4*60)) AS range_2 FROM `memo` WHERE `Memo_visiblestatus` = 1 AND SUBSTR(ADDTIME(`Memo_notification_time`, SEC_TO_TIME(4*60)) ,1,2) = '$hours' ".get_memo_sql_condition($day_pattern)." AND not Memo_id = '$memo_id' ORDER BY range_1";
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
function get_all_time_list($hours,$day_pattern){
	$time_list=(array_merge(get_time_list_from_schedule_database($hours),get_time_list_from_memo_database($hours,$day_pattern)));
	array_sort_by_column($time_list,"range_1");
	return array_values(super_unique($time_list));
}
function get_all_minute_list($hours,$day_pattern){
	$x=0;
	$time_list=[];
	foreach (get_minute_list($hours) as $key => $value) {
		$result="";
		foreach (get_all_time_list($hours,$day_pattern) as $key){
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
function get_list_day_pattern($day_pattern){
	$day_list = [];
	for($x = 0;$x < 7;$x++){
		if(substr($day_pattern,$x,1)=="1"){
			$day_list[$x] = $x+1;
		}
		else{

		}
	}
	return array_values($day_list);
	}
function get_memo_sql_condition($day_pattern){
	if(sizeOf(get_list_day_pattern($day_pattern))==0){
		return "AND  (SUBSTR(Memo_notification_day,1,1) = ".substr($day_pattern,0,1);
	}
	else if(sizeOf(get_list_day_pattern($day_pattern))==1){
		return "AND (SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[0].",1) = 1 OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[0].")";
	}
	else if(sizeOf(get_list_day_pattern($day_pattern))==2){
		return "AND (SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[0].",1) = 1 OR SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[1].",1) = 1 OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[0]." OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[1].")"; 
	}
	else if(sizeOf(get_list_day_pattern($day_pattern))==3){
		return "AND (SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[0].",1) = 1 OR SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[1].",1) = 1 OR SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[2].",1) = 1 OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[0]." OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[1]." OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[2].")"; 
	}
	else if(sizeOf(get_list_day_pattern($day_pattern))==4){
		return "AND (SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[0].",1) = 1 OR SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[1].",1) = 1 OR SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[2].",1) = 1 OR SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[3].",1) = 1 OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[0]." OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[1]." OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[2]." OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[3].")"; 
	}
	else if(sizeOf(get_list_day_pattern($day_pattern))==5){
		return "AND (SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[0].",1) = 1 OR SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[1].",1) = 1 OR SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[2].",1) = 1 OR SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[3].",1) = 1 OR SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[4].",1) = 1 OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[0]." OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[1]." OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[2]." OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[3]." OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[4].")"; 
	}
	else if(sizeOf(get_list_day_pattern($day_pattern))==6){
		return "AND (SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[0].",1) = 1 OR SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[1].",1) = 1 OR SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[2].",1) = 1 OR SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[3].",1) = 1 OR SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[4].",1) = 1 OR SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[5].",1) = 1 OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[0]." OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[1]." OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[2]." OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[3]." OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[4]." OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[5].")"; 
	}
	else if(sizeOf(get_list_day_pattern($day_pattern))==7){
		return "AND (SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[0].",1) = 1 OR SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[1].",1) = 1 OR SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[2].",1) = 1 OR SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[3].",1) = 1 OR SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[4].",1) = 1 OR SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[5].",1) = 1 OR SUBSTR(Memo_notification_day,".get_list_day_pattern($day_pattern)[6].",1) = 1 OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[0]." OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[1]." OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[2]." OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[3]." OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[4]." OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[5]." OR DAYOFWEEK(Memo_notification_date) = ".get_list_day_pattern($day_pattern)[6].")"; 
	}
	else{
		return "";
	}
}
$sql5 = "SELECT SUBSTR(`Memo_notification_time`,4,2) AS minute FROM `memo` WHERE memo_id = '".$memo_id."'";
$result5=$conn->query($sql5);
$row5=$result5->fetch_assoc();
$minute_default=$row5['minute']; 
	echo "<option value=''>".$strFormminutesblanklabel."</option>";
foreach (get_all_minute_list($hours,$day_pattern) as $key => $value) {
	$selected ='';
	if($value==$minute_default){$selected ='selected="selected"';}
	echo "<option value='$value'".$selected.">".$value."</option>";
	}
?>