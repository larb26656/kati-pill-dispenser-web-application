<?php
session_start();
include("../../lang_check.php"); 
$slot_id_temp_array= explode(",", $_POST['slot_id_temp']); ?>
<div class="table-responsive">  
  <table id="slot_data" class="table table-condensed">
    <thead>
      <tr>
        <th><?php echo $strSchedulenumofslot;?></th>
        <th><?php echo $strSchedulepillinslot;?></th>
        <th><?php echo $strTablemanage;?></th>
      </tr>
    </thead>
    <tbody>
<?php require_once '../../connect.php';
$sql = "SELECT * FROM `slot` INNER JOIN pill ON slot.Pill_id = pill.Pill_id WHERE  Slot_visiblestatus = '1' ORDER BY Slot_num";
$result = mysqli_query($conn, $sql);
while($row=$result->fetch_assoc())
{ 
  $result_check=null;
  foreach($slot_id_temp_array as $key => $value) {
  if($result_check==1){

  }
  else{
  if($row['Slot_id']==$slot_id_temp_array[$key])
    {
  $result_check=1;
}
else{
  $result_check=0;
}
}
}
 if($result_check==1)
    {?>
  <tr>
        <td><?php echo $row['Slot_num'];?></td>
        <td><?php echo $row['Pill_commonname_'.$strEtclanglabel];?></td>
        <td><button type="button" class="btn btn-success
         btn-xs" onClick="insert_slot_temp(<?php echo $row['Slot_id'];?>)" disabled><?php echo $strTableinsertbutton;?></button></td>
      </tr>

<?php
}
else{
?>
  <tr>
        <td><?php echo $row['Slot_num'];?></td>
        <td><?php echo $row['Pill_commonname_'.$strEtclanglabel];?></td>
        <td><button type="button" class="btn btn-success
         btn-xs" onClick="insert_slot_temp(<?php echo $row['Slot_id'];?>)"><?php echo $strTableinsertbutton;?></button></td>
      </tr>
<?php
}
}
?>
</tbody>
</table>
</div>