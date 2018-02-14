<?php

header('Content-type: application/json');

$valid = true;
$slot_id_temp_array =  explode(",",$_POST['Slot_id_temp']);
if(count($slot_id_temp_array) > 0) {
$valid = false;
}

echo json_encode(array(
    'valid' => $valid,
));

?>