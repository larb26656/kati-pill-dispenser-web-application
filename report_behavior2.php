<?php session_start();
include("session_check.php");?>
<!DOCTYPE html>
<html>
<head>
<title>ความสุขของกะทิ</title>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet"/>
<script type="text/javascript" src="bootstrap/js/jquery-2.2.0.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Mitr|Athiti" rel="stylesheet">
<link href="bootstrap/css/custom.css" rel="stylesheet"/>
<script src="bootstrap/js/plotly-latest.min.js"></script>
<script src="DataTables-1.10.15/media/js/jquery.dataTables.min.js"></script>  
<script src="DataTables-1.10.15/media/js/dataTables.bootstrap.min.js"></script>     
<link rel="stylesheet" href="DataTables-1.10.15/media/css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" type="text/css" media="all" href="bootstrap-daterangepicker-master/daterangepicker.css" />
 <script type="text/javascript" src="bootstrap-daterangepicker-master/moment.js"></script>
      <script type="text/javascript" src="bootstrap-daterangepicker-master/daterangepicker.js"></script>
<script type="text/javascript">
   $(document).ready(function () {
        $('.report').addClass('active');
        $('.behavior').addClass('active');
        $("#page-wrapper").fadeIn(200);
  $('#filter_date').submit(function() {
          var startDate = $("#date").data('daterangepicker').startDate.format('YYYY-MM-DD');
          var endDate =  $("#date").data('daterangepicker').endDate.format('YYYY-MM-DD');
 window.location.href = 'report_behavior.php?startdate='+startDate+'&enddate='+endDate;
 return false;
  });
    });
</script>
</head>
<body>
<?php
include("connect.php");
  if(isset($_GET['startdate'])){
  $startdate = $_GET['startdate'];
  $enddate = $_GET['enddate'];
  }
  else{
 $startdate = date("Y-m-d");
 $enddate = date("Y-m-d");
}
?>
 <div id="wrapper">  
      <?php include("menu.php"); ?>
     <div id="page-wrapper">
       <div class="container-fluid">
      <ul class="sub_menu">
     
  <li class="brand">รายงาน</li>
  <li><a href="#" class="behavior"><i class="fa fa-line-chart" aria-hidden="true"></i> ข้อมูลพฤติกรรมผู้ป่วย</a></li>
    <li><a href="report_pill.php" class="drugs"><i class="fa fa-line-chart" aria-hidden="true"></i> ข้อมูลยา</a></li>
</ul>
      </div>
      <div class="col-md-12">
<div class="container-fluid">
<form class="form-inline" action="" method="get" id="filter_date" name="filter_date">
  <div class="form-group">
   <label for="date">วันที่:</label>
    <input type="text" class="form-control" id="date" name="date">
  </div>
<button type="submit" class="btn btn-default">ค้นหา</button>
</form>
<?php
   $sql = "SELECT * FROM `behavior` WHERE SUBSTR(Behavior_datetime, 1,10) >= '$startdate' AND SUBSTR(Behavior_datetime, 1,10) <='$enddate';";
   $result=$conn->query($sql);
    $num_row = mysqli_num_rows($result);
   if($num_row > 0){
 $normal_pill_name = array();
$normal_number_of_pill = array();
$forgot_pill_name = array();
$forgot_number_of_pill = array();
$sql2 = "SELECT `Behavior_type`,Pill_name,COUNT(slot.Pill_id) AS Number_of_pill FROM `behavior`INNER JOIN `schedule` ON behavior.Schedule_id=`schedule`.Schedule_id INNER JOIN dispenser ON `schedule`.`Schedule_id` = dispenser.`Schedule_id` INNER JOIN slot ON dispenser.Slot_id = slot.Slot_id INNER JOIN pill ON slot.Pill_id = pill.Pill_id WHERE `Behavior_type` = 'รับประทานยา' AND SUBSTR(Behavior_datetime, 1,10) >= '$startdate' AND SUBSTR(Behavior_datetime, 1,10) <='$enddate' GROUP BY slot.Pill_id,`Behavior_type`";
   $result2=$conn->query($sql2);
    $num_row2 = mysqli_num_rows($result2);
      while($row2=$result2->fetch_assoc())
      {
    $normal_pill_name[] = $row2['Pill_name'];
    $normal_number_of_pill[] = $row2['Number_of_pill'];
      }
$sql3 = "SELECT `Behavior_type`,Pill_name,COUNT(slot.Pill_id) AS Number_of_pill FROM `behavior`INNER JOIN `schedule` ON behavior.Schedule_id=`schedule`.Schedule_id INNER JOIN dispenser ON `schedule`.`Schedule_id` = dispenser.`Schedule_id` INNER JOIN slot ON dispenser.Slot_id = slot.Slot_id INNER JOIN pill ON slot.Pill_id = pill.Pill_id WHERE `Behavior_type` = 'ลืมรับประทานยา' AND SUBSTR(Behavior_datetime, 1,10) >= '$startdate' AND SUBSTR(Behavior_datetime, 1,10) <='$enddate' GROUP BY slot.Pill_id,`Behavior_type`";
   $result3=$conn->query($sql3);
    $num_row3 = mysqli_num_rows($result3);
      while($row3=$result3->fetch_assoc())
      {
    $forgot_pill_name[] = $row3['Pill_name'];
    $forgot_number_of_pill[] = $row3['Number_of_pill'];
      }
    ?>

<center>
<?php if ($startdate == $enddate){
?>
<h1 style=" font-family: 'Athiti', serif;">รายงานพฤติกรรมของผู้ป่วยประจำวันที่ <?php echo $startdate; ?></h1>
<?php }
else { ?>
<h1 style=" font-family: 'Athiti', serif;">รายงานพฤติกรรมของผู้ป่วยระหว่างวันที่ <?php echo $startdate; ?> ถึงวันที่ <?php echo $enddate; ?></h1>
<?php } ?>
</center>
<div class ="row">
<div class ="col-md-12" >
<center> 
<div id="myDiv"></div>
</center>
</div>
</div>
<script type="text/javascript">
var trace1 = {
  x: <?php echo json_encode($normal_pill_name); ?>,
  y: <?php echo json_encode($normal_number_of_pill); ?>,
  name: 'รับประทานยา',
  type: 'bar',
};

var trace2 = {
   x: <?php echo json_encode($forgot_pill_name); ?>,
  y: <?php echo json_encode($forgot_number_of_pill); ?>,
  name: 'ลืมรับประทานยา',
  type: 'bar',
};

var data = [trace1, trace2];

var layout = {barmode: 'stack'};

Plotly.newPlot('myDiv', data, layout);
</script>
<div class="row">
<div class="col-md-12">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>วันที่</th>
        <th>เวลา</th>
        <th>ยาที่ต้องรับประทานในเวลานั้น</th>
        <th>สถานะการรับประทานยา</th>
      </tr>
    </thead>
    <tbody>
     <?php while($row=$result->fetch_assoc()){
      $schedule_id=$row['Schedule_id'];
      $sql2 = "SELECT * FROM `schedule` INNER JOIN dispenser ON schedule.Schedule_id=dispenser.Schedule_id INNER JOIN slot ON dispenser.Slot_id=slot.Slot_id INNER JOIN pill ON slot.Pill_id=pill.Pill_id WHERE dispenser.Schedule_id = '$schedule_id';";
   $result2=$conn->query($sql2);
      ?>
      <tr>
        <td><?php echo substr($row['Behavior_datetime'],0,9);?></td>
        <td><?php echo substr($row['Behavior_datetime'],10,10);?></td>
        <td><?php while($row2=$result2->fetch_assoc()){
          echo "<p>".$row2['Pill_name']."</p>";
          }?></td>
         <td><?php echo $row['Behavior_type'];?></td>
      </tr>
      <?php 
      }?>
    </tbody>
  </table>
  <?php }
  else{ ?>
  <p>
  <div class="alert alert-warning">
  <strong>คำอธิบาย!</strong> ไม่พบข้อมูล
</div>
</p>
  <?php } ?> 
  </div>
  </div>
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
            "lengthMenu": "แสดง _MENU_ เรคคอร์ดต่อหนึ่งหน้า",
            "zeroRecords": "ไม่พบการค้นหา",
            "info": "หน้าที่ _PAGE_ จาก _PAGES_",
            "infoEmpty": "ไม่พบข้อมูล",
            "infoFiltered": "(กรองจาก _MAX_  เรคคอร์ด)",
            "paginate": {
            "first":      "หน้าแรก",
            "last":       "หน้าสุดท้าย",
            "next":       "ถัดไป",
            "previous":   "ก่อนหน้า"
    },
            "search":         "ค้นหา:"
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