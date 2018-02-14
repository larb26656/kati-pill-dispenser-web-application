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
<link rel="stylesheet" type="text/css" media="all" href="bootstrap-daterangepicker-master/daterangepicker.css" />
 <script type="text/javascript" src="bootstrap-daterangepicker-master/moment.js"></script>
      <script type="text/javascript" src="bootstrap-daterangepicker-master/daterangepicker.js"></script>
<script type="text/javascript">
   $(document).ready(function () {
        $('.report').addClass('active');
         $('.pill_log').addClass('active');
        $("#page-wrapper").fadeIn(200);
    $('#filter_date').submit(function() {
          var startDate = $("#date").data('daterangepicker').startDate.format('YYYY-MM-DD');
          var endDate =  $("#date").data('daterangepicker').endDate.format('YYYY-MM-DD');
 window.location.href = 'report_pill.php?startdate='+startDate+'&enddate='+endDate;
 return false;
  });
    });
</script>
</head>
<body>
<?php 
include("connect.php"); ?>
<div id="wrapper">  
      <?php include("menu.php"); ?>
     <div id="page-wrapper">
       <div class="container-fluid">
      <ul class="sub_menu">
     
  <li class="brand"><?php echo $strReport;?></li>
  <li><a href="report_behavior.php" class="behavior"><i class="fa fa-line-chart" aria-hidden="true"></i> <?php echo $strSubmenubehaviorinformation;?></a></li>
    <li><a href="#" class="pill_log"><i class="fa fa-line-chart" aria-hidden="true"></i> <?php echo $strSubmenupillinformation;?></a></li>
</ul>
     </div>
      <div class="col-md-12">
<div class="container-fluid">
<form class="form-inline" action="" method="get" id="filter_date" name="filter_date">
  <div class="form-group">
   <label for="date"><?php echo $strdatepickerdatelabel;?></label>
    <input type="text" class="form-control" id="date" name="date">
  </div>
<button type="submit" class="btn btn-default"><?php echo $strdatepickersearchbutton;?></button>
</form>
<?php  if(isset($_GET['startdate'])){
  $startdate = $_GET['startdate'];
  $enddate = $_GET['enddate'];
  }
  else{
 $startdate = date("Y-m-d");
 $enddate = date("Y-m-d");
}
      $sql = "SELECT * FROM `pill_log` INNER JOIN pill ON pill_log.Pill_id=pill.Pill_id WHERE SUBSTR(Pill_log_datetime, 1,10) >= '$startdate' AND SUBSTR(Pill_log_datetime, 1,10) <='$enddate';";
   $result=$conn->query($sql);
   $num_row = mysqli_num_rows($result);
   if($num_row > 0){?>
<br>
<div class="row">
<div class="col-md-12">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th><?php echo $strpillreportdatelabel;?></th>
        <th><?php echo $strpillreporttimelabel;?></th>
        <th><?php echo $strpillreportmessagelabel;?></th>
      </tr>
    </thead>
    <tbody>
      <?php while($row=$result->fetch_assoc()){?>
       <tr<?php if($row['Pill_log_type']=="almostoutofstock"){ echo " class='warning'"; }
      else{ echo " class='danger'";}?>>
        <td><?php echo substr($row['Pill_log_datetime'],0,10);?></td>
        <td><?php echo substr($row['Pill_log_datetime'],10,10);?></td>
        <td><?php echo pill_format_convert($row['Pill_log_type'],"<a href='edit_pill_form.php?pill_id=".$row['Pill_id']."'>".$row['Pill_commonname_'.$strEtclanglabel]."</a>");?></td>
      </tr>
      <?php }?>
    </tbody>
  </table>
  </div>
  </div>
  <?php } 

else{
  ?>
  <p>
    <div class="alert alert-warning">
 <strong><?php echo $stralertwarningtitle;?></strong> <?php echo $stralertnotfoundinformationwarning;?>
</div>
</p>
  <?php
  }?>
</div>
  </div>
</div>

</div>
</body>
<script>  
 $(document).ready(function(){  
      $('.table').DataTable({
        ordering: false,
 "language": {
            "lengthMenu": "<?php echo $strTablelengthmenu;?>",
            "zeroRecords": "<?php echo $strTablezerorecords;?>",
            "info": "<?php echo $strTableinfo;?>",
            "infoEmpty": "<?php echo $strTableinfoempty;?>",
            "infoFiltered": "(<?php echo $strTableinfofiltered;?>)",
            "paginate": {
            "first":      "<?php echo $strTablefirst;?>",
            "last":       "<?php echo $strTablelast;?>",
            "next":       "<?php echo $strTablenext;?>",
            "previous":   "<?php echo $strTableprevious;?>"
    },
            "search":         "<?php echo $strTablesearch;?>"
        }
    } );
  $('#date').daterangepicker({
    "startDate": "<?php echo date("m/d/Y", strtotime($startdate))?>",
    "endDate": "<?php echo date("m/d/Y", strtotime($enddate))?>"
}, function(start, end, label) {
  console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
});
      
} ); 

 </script>  
</html>