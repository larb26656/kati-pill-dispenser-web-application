<?php
include("lang_check.php");
include("../../../connect.php");
$sql = "SELECT Config_value FROM `config` WHERE Config_name = 'Robot_connect_status' AND Config_visiblestatus = '1'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
if($row['Config_value']=='1'){?>
<a href="#"><i class="fa fa-link" aria-hidden="true"></i> <span class="label label-success"><?php echo $strRobotguiconnectlabel;?></span></a>
<?php }
else {?>
<a href="#"><i class="fa fa-chain-broken" aria-hidden="true"></i> <span class="label label-danger"><?php echo $strRobotguilostconnectlabel;?></span></a>
<?php } ?>
