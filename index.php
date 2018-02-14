<?php session_start();
include("lang_check.php");?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $strTitle?></title>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet"/>
<script type="text/javascript" src="bootstrap/js/jquery-2.2.0.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Mitr|Athiti" rel="stylesheet">
<link href="bootstrap/css/custom.css" rel="stylesheet"/>
<script src="sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">
<script type="text/javascript">
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('text_clock').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
   $(document).ready(function () {
    var select_slot_var
    var modal_status=0; 
    select_slot_var = setInterval(select_slot, 500);
        $('.dashboard').addClass('active');
         $("#page-wrapper").fadeIn(200);
        startTime();

     $("#dispaly_slots").on('mouseenter', '.hover_able', function( event ) {
      clearInterval(select_slot_var);
      }).on('mouseleave', '.hover_able', function( event ) {
        if(modal_status===0){
          select_slot_var = setInterval(select_slot, 500);
        }
        else{

        }
      });
     $("#dispaly_slots").on('shown.bs.modal', '#pill_detail', function( event ){
      clearInterval(select_slot_var);
      modal_status=1;
      });
     $("#dispaly_slots").on('hidden.bs.modal', '#pill_detail', function( event ){
      clearInterval(select_slot_var);
      modal_status=0;
      select_slot_var = setInterval(select_slot, 500);
      });
    });
   function select_slot(){
    $.ajax({
      type:"POST",
      url:"include/slot/select_slot.php",
      success:function(data){
        $("#dispaly_slots").html(data);
      }
    });
  }
   function select_next_notification(){
    $.ajax({
      type:"POST",
      url:"include/schedule/select_next_notification.php",
      success:function(data){
        $("#text_next_notification").html(data);
      }
    });
  }
    function select_forgot_take_pill(){
    $.ajax({
      type:"POST",
      url:"include/schedule/select_forgot_take_pill.php",
      success:function(data){
        $("#text_forgot_take_pill").html(data);
      }
    });
  }
    select_slot();
    select_next_notification();
    select_forgot_take_pill();
    setInterval(select_next_notification, 500);
    setInterval(select_forgot_take_pill, 500);
</script>
<style type="text/css">
  body{
    background-color: #fafafa;
}
</style>
</head>
<body>
<?php 
include("connect.php");
?>

<div id="wrapper">  
      <?php include("menu.php"); ?>
     <div id="page-wrapper">
      <div class="container-fluid">
      <div class="row">
       <div class="col-md-4">
     <div class="panel panel-default">
  <div class="panel-heading dashboard_header"><?php echo $strCurrenttime;?></div>
   <div class="panel-body dashboard_info">
   <center><h2 id="text_clock"></h2></center>
  </div>
</div>

  </div>
  
    
       <div class="col-md-4">
      <div class="panel panel-default">
  <div class="panel-heading dashboard_header"><?php echo $strNextNotification;?></div>
  <div class="panel-body dashboard_info">
     <center><h2 id="text_next_notification"></h2></center>
  </div>
</div>

      </div>
       <div class="col-md-4">
     <div class="panel panel-default">
  <div class="panel-heading dashboard_header"><?php echo $strNumofpatientforgottotakepill;?></div>
  <div class="panel-body dashboard_info">
    <center><h2 id="text_forgot_take_pill"></h2></center>
  </div>
</div>

      </div>
      </div>
      <div class="row">
          <div class="col-md-12">
       <div id="dispaly_slots">
  
  </div>
  </div>
</div>
      </div>
     </div>
     </div>
     <script type="text/javascript">
         $(document).ready(function () {
    
            });
     </script>
  

</body>
</html>