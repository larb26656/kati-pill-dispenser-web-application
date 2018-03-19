<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<body>
<?php
	require_once('PHPMailer-5.2-stable/class.phpmailer.php');
	$mail = new PHPMailer();
	$mail->IsHTML(true);
	$mail->IsSMTP();
	$mail->SMTPAuth = true; // enable SMTP authentication
	$mail->SMTPSecure = "ssl"; // sets the prefix to the servier
	$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
	$mail->Port = 465; // set the SMTP port for the GMAIL server
	$mail->Username = "katiservice01@gmail.com"; // GMAIL username
	$mail->Password = "kati1234"; // GMAIL password
	$mail->From = "test@aaaa.com"; // "name@yourdomain.com";
	//$mail->AddReplyTo = "support@thaicreate.com"; // Reply
	$mail->FromName = "Mr.Weerachai Nukitram";  // set from Name
	$mail->Subject = "Test sending mail.";
	$mail->Body = "My Body & <b>My Description</b>";

	$mail->AddAddress("larb26656@gmail.com", "Mr.Adisorn Boonsong"); // to Address

	$mail->Subject = "Test sending mail.";
	$mail->Body = "My Body & <b>My Description</b>";

	$mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low

	$mail->Send();
?>
</body>
</html>
