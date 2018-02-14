<?php $detail = $_GET['detail']; 
$pills = $_GET['pills'];?>
<script type="text/javascript" src="../bootstrap/js/jquery-2.2.0.min.js"></script>
<script type="text/javascript">
	    function sent(detail,pills,token){
 var info = 'detail=' + detail+'&pills='+pills+'&token='+token;
     $.ajax({
        type: "GET",
        url: "sent_noti_behavior.php",
        data: info,
         success: function(data) {
         	alert(data);
   }
     });
}
</script>
<?php require_once '../connect.php';
$sql = "SELECT * FROM `outsider` WHERE `Outsider_visiblestatus` = '1'";
$result = mysqli_query($conn, $sql);
while($row=$result->fetch_assoc())
{ 		?>
	<script>sent(<?php echo '"'.$detail.'"'?>,<?php echo '"'.$pills.'"'?>,<?php echo '"'.$row['Outsider_token'].'"'?>)</script>
	<?php
			
}	?>