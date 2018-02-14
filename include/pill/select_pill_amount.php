<?php
$Pill_dispenseramount=$_GET['pill_dispenseramount'];
for ($i = $Pill_dispenseramount; $i <= 15; $i++) {
    if($i%$Pill_dispenseramount==0){
    	echo "<option value='$i'>".$i."</option>";
    }
    else{

    }
}
?>