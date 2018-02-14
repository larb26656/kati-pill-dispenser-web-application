<?php 
require 'PHPMailer-5.2-stable/PHPMailerAutoload.php';
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "katiservice01@gmail.com";
$mail->Password = "kati1234";
$mail->SetFrom("katiservice01@gmail.com");
$mail->Subject = "Test";
$mail->Body = "ทดสอบๆ";
$mail->AddAddress("larb26656@gmail.com");

 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    echo "Message has been sent";
 }
?>