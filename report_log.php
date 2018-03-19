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
<script src="DataTables-1.10.15/media/js/jquery.dataTables.min.js"></script>
<script src="DataTables-1.10.15/media/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="DataTables-1.10.15/media/css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" type="text/css" media="all" href="bootstrap-daterangepicker-master/daterangepicker.css" />
<script type="text/javascript" src="bootstrap-daterangepicker-master/moment.js"></script>
<script type="text/javascript" src="bootstrap-daterangepicker-master/daterangepicker.js"></script>
<script src="sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">
<script type="text/javascript">
   $(document).ready(function () {
        $('.report').addClass('active');
        $('.log').addClass('active');
        $("#page-wrapper").fadeIn(200);
  $('#filter_date').submit(function() {
          var startDate = $("#date").data('daterangepicker').startDate.format('YYYY-MM-DD');
          var endDate =  $("#date").data('daterangepicker').endDate.format('YYYY-MM-DD');
 window.location.href = 'report_behavior.php?startdate='+startDate+'&enddate='+endDate;
 return false;
  });

    });
    function display_log(log_date)
   {
    var info = '?log_date=' + log_date;
     window.location.href = "display_report_log.php" + info;
   }
</script>
<style>
.fixed_header{
    width: 100%;
    table-layout: fixed;
    border-collapse: collapse;
}

.fixed_header tbody{
  display:block;
  width: 100%;
  overflow: auto;
  height: 380px;
}

.fixed_header thead tr {
   display: block;
}

.fixed_header thead {
  background: black;
  color:#fff;
}

.fixed_header th, .fixed_header td {
  padding: 5px;
  text-align: left;
  width: 200px;
}

.log-critical {
  background-color: #F24334;
}
.log-error {
  background-color: #FF5D24;
}
.log-warning {
  background-color: #FD9203;
}
.log-info {
  background-color: #1C75D1;
}
.log-debug {
  background-color: #8ECBFA;
}
.log-notset {
  background-color: #8A8A8A;
}

</style>
</head>
<body>
<?php
include("connect.php");
function get_log_type_tag($log_type) {
  if($log_type=="[CRITICAL]:"){
    return '<span class="label log-critical">'.'Critical'.'</span>';
  }
  else if($log_type=="[ERROR]:"){
    return '<span class="label log-error">'.'Error'.'</span>';
  }
  else if($log_type=="[WARNING]:"){
    return '<span class="label log-warning">'.'Warning'.'</span>';
  }
  else if($log_type=="[INFO]:"){
    return '<span class="label log-info">'.'Info'.'</span>';
  }
  else if($log_type=="[DEBUG]:"){
    return '<span class="label log-debug">'.'Debug'.'</span>';
  }
  else if($log_type=="[NOTSET]:"){
    return '<span class="label log-notset">'.'Not set'.'</span>';
  }
  else{
    return '<span class="label log-notset">'.'Unknown'.'</span>';
  }
}
?>
 <div id="wrapper">
      <?php include("menu.php"); ?>
     <div id="page-wrapper">
       <div class="container-fluid">
      <ul class="sub_menu">

  <li class="brand"><?php echo $strReport;?></li>
  <li><a href="report_behavior.php" class="behavior"><i class="fa fa-line-chart" aria-hidden="true"></i> <?php echo $strSubmenubehaviorinformation;?></a></li>
    <li><a href="report_pill.php" class="drugs" ><i class="fa fa-line-chart" aria-hidden="true"></i> <?php echo $strSubmenupillinformation;?></a></li>
    <li><a href="#" class="log" ><i class="fa fa-line-chart" aria-hidden="true"></i> <?php echo $strSubmenuloginformation;?></a></li>
</ul>
      </div>
      <div class="col-md-12">
<div class="container-fluid">
  <table class="fixed_header">
    <thead>
      <tr>
        <th><?php echo $strlogreportdatelabel; ?></th>
        <th><?php echo $strlogreportmanagelabel; ?></th>
      </tr>
    </thead>
    <tbody>
<?php
$dir = "log/";
$i = 1;
// Open a directory, and read its contents
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
      if($i<=2){
       $i++;
      }
      else{
      ?>
      <tr>
        <td><?php echo str_replace(".log","",$file);?></td>
        <td><button type="button" class="btn btn-primary btn-xs"  onClick="display_log('<?= $file; ?>')"><?php echo $strTableviewbutton;?></button></td>
      </tr>
      <?php
      }
    }
    ?>
  </tbody>
</table>
    <?php
    closedir($dh);
  }
}
?>
</div>
  </div>
</div>

</div>
</body>
<script>

 </script>
</html>
