<?php 
$Notification_type = 'pill';
$Notification_detail = "aaaaa";
$Notification_pills = "aaaaa";
$Notification_date = date("YmdHis");
$url = 'https://fcm.googleapis.com/fcm/send';

$Token = 'eDMWVXGQkaI:APA91bG6hY4DKkJiCUuW-hNLpEZFFjNcQV8-tjVCpOkHvW4io8NoaJq6QBxeviBTthsEgaQWpj7YVXz3wQeoQXVtMYLwdoG-shbETwIPcOSsSVSoBObQy4oNOBkEfH8m23XB7UICfLCq';
?>
<script src="https://www.gstatic.com/firebasejs/4.5.2/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyBEihoJYWWFkEaiOrqJcN6rcYKHYW1mMXU",
    authDomain: "kati-a04e1.firebaseapp.com",
    databaseURL: "https://kati-a04e1.firebaseio.com",
    projectId: "kati-a04e1",
    storageBucket: "kati-a04e1.appspot.com",
    messagingSenderId: "642042925714"
  };
  firebase.initializeApp(config);
  window.onload=function(){
  	var firebaseRef=firebase.database().ref();
  	firebaseRef.once('value').then(function(dataSnapshot) {
  		console.log(dataSnapshot.val());
  	});
  	insertData();
  	getNumNotification();
  	}
  function insertData(){
  	var firebaseRef=firebase.database().ref(<?php echo '"'.$Notification_type.'"'?>);
  	firebaseRef.push({
  		Notification_detail:<?php echo '"'.$Notification_detail.'"'?>,
  		Notification_pills:<?php echo '"'.$Notification_pills.'"'?>,
  		Notification_date:<?php echo '"'.$Notification_date.'"'?>,
  		Token:<?php echo '"'.$Token.'"'?>,
  		Notification_visible_status:"1",
  		Token_Notification_visible_status:<?php echo '"'.$Token.'_1"'?>,
  		Notification_date_Token:<?php echo '"'.$Notification_date.'_'.$Token.'"'?>
  	});
  	console.log("สำเร็จ");
  }
  function getNumNotification(){
  var firebaseRef=firebase.database().ref("Notification").orderByChild("Notification_visible_status").equalTo("1");
firebaseRef.once("value", function(snapshot) {
  var a = snapshot.numChildren();
  console.log(a);
});
  }
  
</script>
<?php

ignore_user_abort();
ob_start();

$fields = array('to' => $Token ,
'data' => array('body' =>  $Notification_detail.' '.$Notification_pills		, 'title' => $Notification_type));


define('GOOGLE_API_KEY', 'AIzaSyDyZzkLDxupheGiHtz6lAATU28cplq0Tj0');

$headers = array(
      'Authorization:key='.GOOGLE_API_KEY,
      'Content-Type: application/json'
 );

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

$result = curl_exec($ch);
if($result === false)
die('Curl failed ' . curl_error());
curl_close($ch);
return $result;
?>
