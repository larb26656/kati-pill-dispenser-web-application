<?php 
$text = $_GET['text'];
if ($text == "เวลา"){
	echo "ขณะนี้เวลา".date("h:i:sa");
}
else if ($text == "วันที่"){
	echo "วันนี้วันที่".date("d-m-Y");
}
else{
	echo "ไม่เข้าใจ";
}
?>