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
<script type="text/javascript">
   $(document).ready(function () {
        $('.report').addClass('active');
        $('.display').addClass('active');
        $("#page-wrapper").fadeIn(200);
  $('#filter_date').submit(function() {
          var startDate = $("#date").data('daterangepicker').startDate.format('YYYY-MM-DD');
          var endDate =  $("#date").data('daterangepicker').endDate.format('YYYY-MM-DD');
 window.location.href = 'report_behavior.php?startdate='+startDate+'&enddate='+endDate;
 return false;
  });
    });
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
$filename = "log/".$_GET['log_date'];
function get_log_type_tag($log_type) {
  if($log_type=="[CRITICAL]:"){
    return '<span class="label log-critical">'.'<i class="fa fa-heartbeat" aria-hidden="true"></i> Critical'.'</span>';
  }
  else if($log_type=="[ERROR]:"){
    return '<span class="label log-error">'.'<i class="fa fa-times-circle" aria-hidden="true"></i> Error'.'</span>';
  }
  else if($log_type=="[WARNING]:"){
    return '<span class="label log-warning">'.'<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Warning'.'</span>';
  }
  else if($log_type=="[INFO]:"){
    return '<span class="label log-info">'.'<i class="fa fa-info-circle" aria-hidden="true"></i> Info'.'</span>';
  }
  else if($log_type=="[DEBUG]:"){
    return '<span class="label log-debug">'.'<i class="fa fa-life-ring" aria-hidden="true"></i> Debug'.'</span>';
  }
  else if($log_type=="[NOTSET]:"){
    return '<span class="label log-notset">'.'<i class="fa fa-question-circle" aria-hidden="true"></i> Not set'.'</span>';
  }
  else{
    return '<span class="label log-notset">'.'<i class="fa fa-question-circle" aria-hidden="true"></i> Unknown'.'</span>';
  }
}
?>
 <div id="wrapper">
      <?php include("menu.php"); ?>
     <div id="page-wrapper">
       <div class="container-fluid">
      <ul class="sub_menu">

  <li class="brand"><?php echo $strReport;?></li>
  <li><a href="report_log.php" class="log" ><i class="fa fa-line-chart" aria-hidden="true"></i> <?php echo $strSubmenuloginformation;?></a></li>
<li><a href="#" class="display"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $strSubmenudisplayinformation;?></a></li>
</ul>
      </div>
      <div class="col-md-12">
<div class="container-fluid">
    <table class="fixed_header">
      <thead>
        <tr>
          <th><?php echo $strlogreporttimelabel; ?></th>
          <th><?php echo $strlogreportlevellabel; ?></th>
          <th><?php echo $strlogreportmessagelabel; ?></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $fh = fopen($filename,'r');
        while ($line = fgets($fh)) {
        $data = explode("*,*",$line);
        ?>
        <tr>
          <td><?php echo $data[0];?></td>
          <td><?php echo get_log_type_tag($data[1]);?></td>
          <td><?php echo $data[2];?></td>
        </tr>
      <?php
        }
        fclose($fh);
        ?>
      </tbody>
    </table>
</div>
  </div>
</div>

</div>
</body>
<script>

 </script>
</html>
