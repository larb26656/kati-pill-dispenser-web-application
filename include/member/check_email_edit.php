<?php

header('Content-type: application/json');


$conn = new mysqli("localhost","root","","kati");
if ($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}
$conn->query("SET NAMES UTF8");

$email = $_POST['Member_email'];
$member_id = $_POST['Member_id'];
$sql = "SELECT * FROM member WHERE Member_email = '".$email."' AND NOT Member_id = '".$member_id."'";
$result = mysqli_query($conn, $sql);
$num_row = mysqli_num_rows($result);
$row=$result->fetch_assoc();
if( $num_row == 1 ) {
echo "false";
}
else{
echo "true";	
}

?>