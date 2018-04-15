<?php
session_start();
include("../../lang_check.php"); ?>
<script type="text/javascript">
   $(document).ready(function () {
        $('.display').addClass('active');
    });
</script>
<ul class="sub_menu">

  <li class="brand">
  <?php echo $strSchedule;?>
  </li>
  <li>
  <a href="#" class="display"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $strSubmenudisplayinformation;?></a>
  </li>
  </ul>
<?php
include("../../connect.php");
?>
<div class="row">
    <div class="col-md-10"><h4><?php echo $strScheduledailypillnotificationtitle;?></h4></div>
    <div class="col-md-2"><a href="insert_schedule_form.php" class="btn btn-success btn-xs" role="button"><?php echo $strTableinsertbutton;?></a></div>
  </div>
<div class="row">
<dำiv class="col-md-12">
<?php
$sql = "SELECT * FROM `schedule` WHERE Schedule_visiblestatus ='1' ORDER BY Schedule_time";
$result=$conn->query($sql);
$num_row = mysqli_num_rows($result);
if($num_row >= 1){
  ?>
<div class="table-responsive">
<table class="table table-bordered">
   <thead>
      <tr>
        <th><?php echo $strScheduletimelabel;?></th>
        <th><?php echo $strSchedulepillhavetodispenserlabel;?></th>
        <th><?php echo $strTableedit;?></th>
        <th><?php echo $strTablemanage;?></th>


      </tr>
    </thead>
    <tbody>
    <?php while($row=$result->fetch_assoc()){
      $sql2 = "SELECT * FROM `dispenser` INNER JOIN slot ON dispenser.Slot_id = slot.Slot_id INNER JOIN pill ON slot.Pill_id = pill.Pill_id WHERE Schedule_id = '".$row['Schedule_id']."'";
$result2 = $conn->query($sql2);
$num_row2 = mysqli_num_rows($result2);
     ?>
      <tr>
        <td><?php echo $row['Schedule_time'];?></td>
        <td><p><?php while($row2=$result2->fetch_assoc()){ echo "<a href='edit_pill_form.php?pill_id=".$row2['Pill_id']."'>".$row2['Pill_commonname_'.$strEtclanglabel]." ".unit_convert($row2['Pill_dispenseramount'],$strPillunit)."</a>"; if($row2['Pill_left'] == 0){ echo " <span class='label label-danger'>".$strSchedulepilloutofstock."</span>";} else if($row2['Pill_left'] < 5){ echo " <span class='label label-warning'>".$strSchedulepillalmostoutofstock."</span>";} ?></p> <?php } ?> </td>
<td>
<button type="button" class="btn btn-warning btn-xs" onClick="edit_schedule(<?= $row['Schedule_id'] ?>)"><?php echo $strTableeditbutton;?></button>
</td>
<td>
<button type="button" class="btn btn-danger btn-xs" onClick="delete_schedule(<?= $row['Schedule_id'] ?>)"><?php echo $strTabledeletebutton;?></button>
</td>
      </tr>
     <?php } ?>
    </tbody>
  </table>
  </div>
<?php
}
else{?>
    <div class="alert alert-warning">
  <strong><?php echo $stralertwarningtitle;?></strong> <?php echo $stralertnotfoundinformationwarning;?>
</div>
<?php } ?>
</div>
</div>
<?php
if($_POST['day']<=9){
        $day = '0'.$_POST['day'];
        }
        else{
        $day = $_POST['day'];
        }
if($_POST['month']<=9){
        $month = '0'.$_POST['month'];
        }
        else{
        $month = $_POST['month'];
        }
$year=$_POST['year'];
$date=$year."-".$month."-".$day;
?>
<div class="row">
    <div class="col-md-10"><h4><?php echo $strScheduleespeciallydaymessagenotificationtitle;?></h4></div>
    <div class="col-md-2"><a href="insert_memo_by_day_form.php?date=<?php echo $date?>" class="btn btn-success btn-xs" role="button"><?php echo $strTableinsertbutton;?></a></div>
  </div>
<div class="row">
<div class="col-md-12">
<?php
$sql2 = "SELECT * FROM `memo` WHERE `Memo_notification_day` ='' AND Memo_notification_date='$date' AND Memo_visiblestatus ='1' ORDER BY Memo_notification_time";
$result2 = mysqli_query($conn, $sql2);
$num_row2 = mysqli_num_rows($result2);
if($num_row2 >= 1){
?>
<div class="table-responsive">
<table class="table table-bordered">
   <thead>
      <tr>
        <th><?php echo $strScheduletimelabel;?></th>
        <th><?php echo $strScheduledatelabel;?></th>
        <th><?php echo $strSchedulemessagetextlabel;?></th>
        <th><?php echo $strTableedit;?></th>
        <th><?php echo $strTablemanage;?></th>


      </tr>
    </thead>
    <tbody>
    <?php while($row2=$result2->fetch_assoc()){
     ?>
      <tr>
        <td><?php echo $row2['Memo_notification_time'];?></td>
        <td><?php echo $row2['Memo_notification_date'];?></td>
         <td><?php echo $row2['Memo_desc'];?></td>
<td>
<button type="button" class="btn btn-warning btn-xs" onClick="edit_memo_by_day(<?= $row2['Memo_id'] ?>)"><?php echo $strTableeditbutton;?></button>
</td>
<td>
<button type="button" class="btn btn-danger btn-xs" onClick="delete_memo(<?= $row2['Memo_id'] ?>)"><?php echo $strTabledeletebutton;?></button>
</td>
      </tr>
     <?php } ?>
    </tbody>
  </table>
  </div>
<?php
}
else{?>
    <div class="alert alert-warning">
  <strong><?php echo $stralertwarningtitle;?></strong> <?php echo $stralertnotfoundinformationwarning;?>
</div>
<?php } ?>
</div>
</div>
<div class="row">
    <div class="col-md-10"><h4><?php echo $strScheduledailymessagenotificationtitle;?></h4></div>
    <div class="col-md-2"><a href="insert_memo_form.php" class="btn btn-success btn-xs" role="button"><?php echo $strTableinsertbutton;?></a></div>
  </div>
  <div class="row">
<div class="col-md-12">
<?php
$date_cal = explode("-",$date);
$jd=cal_to_jd(CAL_GREGORIAN,$date_cal[1],$date_cal[2],$date_cal[0]); //2011-01-29
$day_text=jddayofweek($jd,1);
if($day_text=='Sunday'){
  $day_location='1';
}
elseif($day_text=='Monday'){
 $day_location='2';
}
elseif($day_text=='Tuesday'){
   $day_location='3';
}
elseif($day_text=='Wednesday'){
   $day_location='4';
}
elseif($day_text=='Thursday'){
   $day_location='5';
}
elseif($day_text=='Friday'){
   $day_location='6';
}
else{
   $day_location='7';
}
$sql3 = "SELECT * FROM `memo` WHERE SUBSTR(Memo_notification_day,$day_location,1)='1'  AND Memo_notification_date ='0000-00-00' AND Memo_visiblestatus ='1' ORDER BY `Memo_notification_time`";
$result3 = mysqli_query($conn, $sql3);
$num_row3 = mysqli_num_rows($result3);
if($num_row3 >= 1){
?>
<div class="table-responsive">
<table class="table table-bordered">
   <thead>
      <tr>
        <th><?php echo $strScheduletimelabel;?></th>
        <th><?php echo $strSchedulemessagetextlabel;?></th>
        <th><?php echo $strTableedit;?></th>
        <th><?php echo $strTablemanage;?></th>


      </tr>
    </thead>
    <tbody>
    <?php while($row3=$result3->fetch_assoc()){
     ?>
      <tr>
        <td><?php echo $row3['Memo_notification_time'];?></td>
         <td><?php echo $row3['Memo_desc'];?></td>
<td>
<button type="button" class="btn btn-warning btn-xs" onClick="edit_memo(<?= $row3['Memo_id'] ?>)"><?php echo $strTableeditbutton;?></button>
</td>
<td>
<button type="button" class="btn btn-danger btn-xs" onClick="delete_memo(<?= $row3['Memo_id'] ?>)"><?php echo $strTabledeletebutton;?></button>
</td>
      </tr>
     <?php } ?>
    </tbody>
  </table>
  </div>
<?php
}
else{?>
    <div class="alert alert-warning">
  <strong><?php echo $stralertwarningtitle;?></strong> <?php echo $stralertnotfoundinformationwarning;?>
</div>
<?php }

 ?>
</div>
</div>
