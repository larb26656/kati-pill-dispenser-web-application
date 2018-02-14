<?php 
session_start();
include("../../lang_check.php"); 
include("../../connect.php");
require '../../PHPMailer/PHPMailerAutoload.php';
$email = $_POST['Email'];
$sql = "SELECT * FROM `member` WHERE Member_email = '$email' LIMIT 1";
$result = mysqli_query($conn, $sql);
$num_row = mysqli_num_rows($result);
$row=$result->fetch_assoc();
if( $num_row == 1 ) {
$username = $row['username'];
$password = $row['password'];
$messagebody = $strPasswordrecoveryusernamelabel." ".$username."<br>".$strPasswordrecoverypasswordlabel." ".$password; 
$mail = new PHPMailer(); // create a new object
$mail->CharSet = 'UTF-8';
$mail->IsSMTP(); // enable SMTP
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "katiservice01@gmail.com";
$mail->Password = "kati1234";
$mail->SetFrom("katiservice01@gmail.com");
$mail->Subject = $strPasswordrecoverylabel;
$mail->Body = $messagebody;
$mail->AddAddress($email);
 if(!$mail->Send()) {
    echo $strPasswordrecoveryerrorlabel."<br><a href=\"password_recovery_form.php\">".$strPasswordrecoverytryagianlabel."</a>";
 } else {
    echo $strPasswordrecoverysuccesslabel."<br><a href=\"login.php\">".$strPasswordrecoverygotologinlabel."</a>";
 }
	}
else {
	echo $strPasswordrecoveryemailnotfoundlabel."<br><a href=\"password_recovery_form.php\">".$strPasswordrecoverytryagianlabel."</a>";
}

?>