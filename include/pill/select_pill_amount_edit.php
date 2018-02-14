<?php
$Pill_dispenseramount=$_GET['pill_dispenseramount'];
$Pill_amount=$_GET['pill_amount'];
for ($i = $Pill_dispenseramount; $i <= 15; $i++) {
    if($i%$Pill_dispenseramount==0){
    	echo "<option value='$i'";if($i==$Pill_amount){echo 'selected="selected"';} echo ">".$i."</option>";
    }
    else{

    }
}
?>