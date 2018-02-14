<?php 
 include '../../connect.php';

  session_start();
include("../../lang_check.php");

 function get_timeago($datetime,$full = false) {
     $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => $GLOBALS['strnotificationyearunit'],
        'm' => $GLOBALS['strnotificationmonthunit'],
        'w' => $GLOBALS['strnotificationweekunit'],
        'd' => $GLOBALS['strnotificationdayunit'],
        'h' => $GLOBALS['strnotificationhourunit'],
        'i' => $GLOBALS['strnotificationminuteunit'],
        's' => $GLOBALS['strnotificationsecondunit'],
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' '.$GLOBALS['strnotificationagounit'] : 'just now';
 }
 ?>
<ul class="nav nav-tabs">
 <li class="active"><a data-toggle="tab" href="#behavior"><?php echo $strSubmenubehaviorinformation;?></a></li>
  <li><a data-toggle="tab" href="#pill_log"><?php echo $strSubmenupillinformation;?></a></li>
 
</ul>

<div class="tab-content">
  <div id="behavior" class="tab-pane fade in active">
   <ul class="nav notification-list"> 
   <?php 

$sql = "SELECT * FROM `behavior_notification` INNER JOIN behavior ON behavior_notification.Behavior_id=behavior.Behavior_id WHERE Member_id=".$_SESSION['Member_id']." ORDER BY Behavior_datetime DESC LIMIT 5";
$result=$conn->query($sql); 
while($row=$result->fetch_assoc()){
  if($row['Msg_status']=='1'){
    echo "<li style=\"background-color:#EEEEEE;\">";
    }
  else{
    echo "<li>";
    }
  if($row['Behavior_type']=="comebutnotakepill"){
    ?>
      <a href="report_behavior.php?startdate=<?php echo substr($row['Behavior_datetime'],0, 10);?>&enddate=<?php echo substr($row['Behavior_datetime'],0, 10);?>">    
    <div class="pull-right"> 
                     <img src="pic/slot/behavior.png" weight="40px" height="40px" style="background-color: #777777;">
                    </div>
                  <h6 class="list-group-item-text">  
                 <b><?php echo $strbehaviorreportstatuscomebutnotakepilllabel;?></b>
                 </h6>
                  <small>
                <?php echo get_timeago($row['Behavior_datetime']); ?>
                  </small></a></li>
  <?php
  }
  else{
  if($row['Schedule_id']!=0 and $row['Pill_id']==0){
  $pills="";
   $sql2 = "SELECT * FROM `schedule` INNER JOIN dispenser ON schedule.Schedule_id=dispenser.Schedule_id INNER JOIN slot ON dispenser.Slot_id=slot.Slot_id INNER JOIN pill ON slot.Pill_id=pill.Pill_id WHERE dispenser.Schedule_id = ".$row['Schedule_id'].";";
   $result2=$conn->query($sql2);
  while($row2=$result2->fetch_assoc()){ 
    $pills .= $row2['Pill_commonname_'.$strEtclanglabel]." ".unit_convert($row2['Pill_dispenseramount'],$strPillunit)." ";
    }
?>
  <a href="report_behavior.php?startdate=<?php echo substr($row['Behavior_datetime'],0, 10);?>&enddate=<?php echo substr($row['Behavior_datetime'],0, 10);?>">    
    <div class="pull-right"> 
                     <img src="pic/slot/behavior.png" weight="40px" height="40px" style="background-color: #777777;">
                    </div>
                  <h6 class="list-group-item-text">  
                 <b><?php echo behavior_format_convert($row['Behavior_type'],$pills);?></b>
                 </h6>
                  <small>
                <?php echo get_timeago($row['Behavior_datetime']); ?>
                  </small></a></li>
<?php
  }
else{
   $pill="";
   $sql2 = "SELECT * FROM `pill` WHERE Pill_id = ".$row['Pill_id'].";";
   $result2=$conn->query($sql2);
  while($row2=$result2->fetch_assoc()){ 
    $pill .= $row2['Pill_commonname_'.$strEtclanglabel]." ".unit_convert($row2['Pill_dispenseramount'],$strPillunit)." ";
    }
?>
  <a href="report_behavior.php?startdate=<?php echo substr($row['Behavior_datetime'],0, 10);?>&enddate=<?php echo substr($row['Behavior_datetime'],0, 10);?>">    
    <div class="pull-right"> 
                     <img src="pic/slot/behavior.png" weight="40px" height="40px" style="background-color: #777777;">
                    </div>
                  <h6 class="list-group-item-text">  
                 <b><?php echo behavior_format_convert($row['Behavior_type'],$pill);?></b>
                 </h6>
                  <small>
                <?php echo get_timeago($row['Behavior_datetime']); ?>
                  </small></a></li>
<?php
 }
 } 
} ?>
<li><a href="report_behavior.php"><center><?php echo $strnotificationdisplaytodaynotification;?></center></a></li>
</ul>
  </div>
  <div id="pill_log" class="tab-pane fade">
    <ul class="nav notification-list"> 
   <?php 
$sql = "SELECT * FROM `pill_log_notification` INNER JOIN pill_log ON pill_log_notification.Pill_log_id=pill_log.Pill_log_id INNER JOIN pill ON pill_log.Pill_id=pill.Pill_id WHERE Member_id=".$_SESSION['Member_id']." ORDER BY Pill_log_datetime DESC LIMIT 5";
$result=$conn->query($sql); 
while($row=$result->fetch_assoc()){
    if($row['Msg_status']=='1'){
    echo "<li style=\"background-color:#EEEEEE;\">";
    }
  else{
    echo "<li>";
    }?>
<a href="report_pill.php?startdate=<?php echo substr($row['Pill_log_datetime'],0, 10);?>&enddate=<?php echo substr($row['Pill_log_datetime'],0, 10);?>">    
  	<div class="pull-right"> 
                     <img src="pic/slot/pill.png" weight="40px" height="40px" style="background-color: #777777;">
                    </div>
                  <h6 class="list-group-item-text">  
                 <b><?php echo pill_format_convert($row['Pill_log_type'],$row['Pill_commonname_'.$strEtclanglabel]);?></b>
                 </h6>
                  <small>
                    <?php echo get_timeago($row['Pill_log_datetime']); ?>
                  </small></a></li>

<?php } ?>	
<li><a href="report_pill.php"><center>เรียกดูการแจ้งเตือนวันนี้</center></a></li>
</ul>
  </div>
</div>
