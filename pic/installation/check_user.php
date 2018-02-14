<?php  require_once '../connect.php';

$sql = "SELECT * FROM member WHERE  Member_visiblestatus='1' AND Admin_permission='1'";
$result = mysqli_query($conn, $sql);
$num_row = mysqli_num_rows($result);
$row=$result->fetch_assoc();
if( $num_row >= 1 ) {
	echo 'true';
	}
else {
	echo 'false';
}

?>