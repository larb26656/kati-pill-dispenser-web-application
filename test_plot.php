
<script type="text/javascript" src="bootstrap/js/jquery-2.2.0.min.js"></script>
<script src="bootstrap/js/plotly-latest.min.js"></script>
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
<img id="jpg-export"></img>
</center>
</div>
</div>
<script type="text/javascript">
var d3 = Plotly.d3;
var img_jpg= d3.select('#jpg-export');

// Ploting the Graph

var trace={x:[3,9,8,10,4,6,5],y:[5,7,6,7,8,9,8],type:"scatter"};
var trace1={x:[3,4,1,6,8,9,5],y:[4,2,5,2,1,7,3],type:"scatter"};
var data = [trace,trace1];
var layout = {title : "Simple Javascript Graph"};
Plotly.plot(
  'plotly_div',
   data,
   layout)

// static image in jpg format

.then(
    function(gd)
     {
      Plotly.toImage(gd,{height:300,width:300})
         .then(
            function(url)
         {
             img_jpg.attr("src", url);
             return Plotly.toImage(gd,{format:'jpeg',height:400,width:400});
         }
         )
    });
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
</html>
