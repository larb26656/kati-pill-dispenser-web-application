<?php session_start();
include("lang_check.php");
include("session_check.php");?>
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
   $(document).ready(function () {
        $('.slot').addClass('active');
        $('.display').addClass('active');
        $("#page-wrapper").fadeIn(200);
    });
   function select_slot(){
    $.ajax({
      type:"POST",
      url:"include/slot/select_slot_edit.php",
      success:function(data){
        $("#dispaly_slots").html(data);
      }
    });
  }
    select_slot();
</script>
</head>
<body>
<?php 
include("connect.php");
$sql = "SELECT * FROM slot INNER JOIN drug ON slot.Drug_id = drug.Drug_id";
$result=$conn->query($sql); 
?>
<div id="wrapper">  
      <?php include("menu.php"); ?>
     <div id="page-wrapper">
       <div class="container-fluid">
       <div class="row">
       <div class="col-md-12">
      <ul class="sub_menu">
     
  <li class="brand"><?php echo $strSlot;?></li>
  <li><a href="#" class="display"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $strSubmenudisplayinformation;?></a></li>
</ul>
</div>
</div>
     

<div id="dispaly_slots">
</div>
  </div>
  </div>
</div>


</body>
</html>