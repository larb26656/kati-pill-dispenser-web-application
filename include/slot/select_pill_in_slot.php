<?php session_start();
include("../../lang_check.php");
$current_slot_id=$_POST['slot_id'];?>
 <div class="table-responsive">  
  <table id="pill_data" class="table table-condensed">
    <thead>
      <tr>
        <th><?php echo $strPillcommonnamelabel ;?></th>
        <th><?php echo $strPillbrandnamelabel ;?></th>
        <th><?php echo $strPillpropertieslabel ;?></th>
        <th><?php echo $strPillmethodlabel ;?></th>
        <th><?php echo $strPillamount ;?></th>
        <th><?php echo $strPillexpirydatelabel ;?></th>
        <th><?php echo $strTablemanage ;?></th>
      </tr>
    </thead>
    <tbody>
<?php require_once '../../connect.php';
$sql = "SELECT * FROM `pill` WHERE Pill_visiblestatus='1'";
$result = mysqli_query($conn, $sql);
while($row=$result->fetch_assoc())
{
$pill_id = $row['Pill_id'];
$sql2 = "SELECT * FROM `slot` WHERE Pill_id ='$pill_id' AND Slot_visiblestatus = '1' ORDER BY Slot_id DESC LIMIT 1";
$result2 = mysqli_query($conn, $sql2);
$row2=$result2->fetch_assoc();
$num_row = mysqli_num_rows($result2);
if( $num_row == 1 ) {

if($row2['Slot_num'] === $current_slot_id)
{
  ?>
  <tr class="success">
        <td><?php echo $row['Pill_commonname_'.$strEtclanglabel];?></td>
        <td><?php echo $row['Pill_brandname_'.$strEtclanglabel];?></td>
        <td><?php echo $row['Pill_properties_'.$strEtclanglabel];?></td>
           <td><?php echo $strPilldurationtakelabel." ".$row['Pill_dispenseramount']." ".$strPillunit." ".${"strPillduration".$row['Pill_duration']."label"};?></td>
        <td><?php echo $row['Pill_left']."/15";?></td>
           <td><?php echo $row['Pill_expiry_date'];?></td>
        <td><button type="button" class="btn btn-danger btn-xs" onClick="delete_pill(<?= $current_slot_id.""; ?>)"><?php echo $strTableremovebutton; ?></button></td>
      </tr>
  <?php
}
else
{
?>
 <tr class="success">
        <td><?php echo $row['Pill_commonname_'.$strEtclanglabel];?></td>
        <td><?php echo $row['Pill_brandname_'.$strEtclanglabel];?></td>
        <td><?php echo $row['Pill_properties_'.$strEtclanglabel];?></td>
          <td><?php echo $strPilldurationtakelabel." ".$row['Pill_dispenseramount']." ".$strPillunit." ".${"strPillduration".$row['Pill_duration']."label"};?></td>
        <td><?php echo $row['Pill_left']."/15";?></td>
           <td><?php echo $row['Pill_expiry_date'];?></td>
        <td><button type="button" class="btn btn-primary btn-xs" disabled><?php echo $strTablechoosebutton;?></button></td>
      </tr>
<?php
}

}
else{
?>
 <tr>
        <td><?php echo $row['Pill_commonname_'.$strEtclanglabel];?></td>
        <td><?php echo $row['Pill_brandname_'.$strEtclanglabel]?></td>
        <td><?php echo $row['Pill_properties_'.$strEtclanglabel];?></td>
          <td><?php echo $strPilldurationtakelabel." ".$row['Pill_dispenseramount']." ".$strPillunit." ".${"strPillduration".$row['Pill_duration']."label"};?></td>
        <td><?php echo $row['Pill_left']."/15";?></td>
           <td><?php echo $row['Pill_expiry_date'];?></td>
        <td><button type="button" class="btn btn-primary btn-xs" onClick="update_pill(<?= $current_slot_id.",".$row['Pill_id']; ?>)"><?php echo $strTablechoosebutton;?></button></td>
      </tr>
<?php }

}?>
</tbody>
</table>
</div>
<script>  
 $(document).ready(function(){  
      $('#pill_data').DataTable({
        ordering: false,
               "language": {
            "lengthMenu": "<?php echo $strTablelengthmenu;?>",
            "zeroRecords": "<?php echo $strTablezerorecords;?>",
            "info": "<?php echo $strTableinfo;?>",
            "infoEmpty": "<?php echo $strTableinfoempty;?>",
            "infoFiltered": "(<?php echo $strTableinfofiltered;?>)",
            "paginate": {
            "first":      "<?php echo $strTablefirst;?>",
            "last":       "<?php echo $strTablelast;?>",
            "next":       "<?php echo $strTablenext;?>",
            "previous":   "<?php echo $strTableprevious;?>"
    },
            "search":         "<?php echo $strTablesearch;?>"
        }
    } );
} ); 
 </script>  