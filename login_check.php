<?php require_once 'connect.php';

session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$sql = "SELECT * FROM member WHERE username='".$username."' AND password='".$password."' AND Member_visiblestatus='1' AND Admin_permission='1'";
$result = mysqli_query($conn, $sql);
$num_row = mysqli_num_rows($result);
$row=$result->fetch_assoc();
if( $num_row == 1 ) {
	echo 'true';
	$_SESSION['Member_id'] = $row['Member_id'];
	$_SESSION['Member_name'] = $row['Member_firstname']." ".$row['Member_surname'];
	}
else {
	echo 'false';
}
?>