 <?php 
session_start();
include("../../lang_check.php");
include("../../connect.php");
$slot_num = $_POST['slot_id'];
$sql = "SELECT * FROM slot INNER JOIN pill ON slot.Pill_id=pill.Pill_id WHERE slot_num='$slot_num' AND Slot_visiblestatus = '1'";
$result = mysqli_query($conn, $sql);
$row=$result->fetch_assoc();?>
 <div class="row">
    <div class="col-sm-3"><b><?php echo $strPillcommonnamelabel;?></b></div>
    <div class="col-sm-9" id="pill_commonname"><?php echo $row['Pill_commonname_'.$strEtclanglabel];?>
    </div>
    </div>
     <div class="row">
    <div class="col-sm-3"><b><?php echo $strPillbrandnamelabel;?></b></div>
    <div class="col-sm-9" id="pill_brandname"><?php echo $row['Pill_brandname_'.$strEtclanglabel];?>
    </div>
    </div>
      <div class="row">
    <div class="col-sm-3"><b><?php echo $strPillpropertieslabel;?></b></div>
    <div class="col-sm-9" id="pill_properties"><?php echo $row['Pill_properties_'.$strEtclanglabel];?>
    </div>
    </div>
       <div class="row">
    <div class="col-sm-3"><b><?php echo $strPillmethodlabel;?></b></div>
    <div class="col-sm-9" id="pill_method_to_take"><?php echo $strPilldurationtakelabel." ".unit_convert($row['Pill_dispenseramount'],$strPillunit)." ".${"strPillduration".$row['Pill_duration']."label"};?>
    </div>
    </div>
     <div class="row">
     <div class="col-sm-3"><b><?php echo $strPillamount;?></b></div>
    <div class="col-sm-9" id="pill_amount"><?php echo unit_convert($row['Pill_left'],$strPillunit);?>
    </div>
    </div>
     <div class="row">
     <div class="col-sm-3"><b><?php echo $strPillexpirydatelabel;?></b></div>
    <div class="col-sm-9" id="pill_expiry_date"><?php echo $row['Pill_expiry_date'];?>
    </div>
    </div>