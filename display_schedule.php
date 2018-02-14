<?php session_start();
include("lang_check.php");
include("session_check.php");?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $strTitle;?></title>
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
        $('.schedule').addClass('active');
        $("#page-wrapper").fadeIn(200);
        $('[data-toggle="tooltip"]').tooltip(); 
    $(".day").click(function(e) {
    $(".select").removeClass("select");
   $(this).addClass('select');
 
 });
    });
     function select_schedule(day,month,year)
{
      var info = 'day=' + day + '&month=' + month + '&year=' + year;
       $.ajax({
      type:"POST",
      url:"include/schedule/select_schedule.php",
      data:info,
      success:function(data){
        $("#Display_schedule").html(data);
      }
    });
}
select_schedule(<?php echo date("d").','.date("m").','.date("Y"); ?>);
 function edit_schedule(id)
{
 var info = 'Schedule_id=' + id;
       swal({
  title: "<?php echo $strDialogboxtitleareyousure;?>",
  text: "<?php echo $strDialogboxbodyediterror;?>",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "<?php echo $strDialogboxconfirmbutton;?>",
  cancelButtonText: "<?php echo $strDialogboxcancelbutton;?>",
  closeOnConfirm: false
},
function(){
        window.location.href = "edit_schedule_form.php?" + info;
       });
}
 function delete_schedule(id)
{

 var info = 'Schedule_id=' + id;
      swal({
  title: "<?php echo $strDialogboxtitleareyousure;?>",
  text: "<?php echo $strDialogboxbodydeleteerror;?>",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "<?php echo $strDialogboxconfirmbutton;?>",
  cancelButtonText: "<?php echo $strDialogboxcancelbutton;?>",
  closeOnConfirm: false
},
function(){
        var html = $.ajax({
        type: "GET",
        url: "include/schedule/delete_schedule.php",
        data: info,
        async: false ,
         success: function(data) {
          window.location.reload(true);}
        }).responseText;


     });
}
 function edit_memo_by_day(id)
{
 var info = 'Memo_id=' + id;
   swal({
  title: "<?php echo $strDialogboxtitleareyousure;?>",
  text: "<?php echo $strDialogboxbodyediterror;?>",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "<?php echo $strDialogboxconfirmbutton;?>",
  cancelButtonText: "<?php echo $strDialogboxcancelbutton;?>",
  closeOnConfirm: false
},
function(){
        window.location.href = "edit_memo_by_day_form.php?" + info;
       });
}
function edit_memo(id)
{
 var info = 'Memo_id=' + id;
  swal({
  title: "<?php echo $strDialogboxtitleareyousure;?>",
  text: "<?php echo $strDialogboxbodyediterror;?>",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "<?php echo $strDialogboxconfirmbutton;?>",
  cancelButtonText: "<?php echo $strDialogboxcancelbutton;?>",
  closeOnConfirm: false
},
function(){
        window.location.href = "edit_memo_form.php?" + info;
       });
}
 function delete_memo(id)
{

 var info = 'Memo_id=' + id;
      swal({
  title: "<?php echo $strDialogboxtitleareyousure;?>",
  text: "<?php echo $strDialogboxbodydeleteerror;?>",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "<?php echo $strDialogboxconfirmbutton;?>",
  cancelButtonText: "<?php echo $strDialogboxcancelbutton;?>",
  closeOnConfirm: false
},

function(){
        var html = $.ajax({
        type: "GET",
        url: "include/schedule/delete_memo.php",
        data: info,
        async: false ,
         success: function(data) {
          window.location.reload(true);}
        }).responseText;


     });
}
</script>
<style type="text/css">
.right-bar{
background: #00c6ff;
height: 300px;
}
th.day-text{
  background: #00c6ff; color: #ffffff; text-align: center;  font-size : 22px; font-family: 'Athiti', serif;
}
td{
  height: 70px;
}
tr.calendar-row {  }
td.calendar-day { min-height:80px; font-size:11px; position:relative; } * html div.calendar-day { height:80px; }
td.calendar-day-np  {  min-height:80px; } * html div.calendar-day-np { height:80px; }
td.calendar-day-head { background:#ccc; font-weight:bold; text-align:center; width:120px; padding:5px; }
a.day-number    {  display: block;    border-radius: 50%; text-decoration: none; width: 50px; height: 50px; color:#dddddd; font-weight:bold; font-size: 30px;  text-align:center;  font-family: 'Athiti', serif; }
a.alarm    { border: 2px solid #FFCF4B; }
a.day-number:hover    {background:#dddddd; color:#ffffff; border-radius: 50%;}
a.select   {background:#FFCF4B !important; color: #FFFFFF !important; }
a.day-current-number    {  display: block;   text-decoration: none; border-radius: 50%; background:#00c6ff; width: 50px; height: 50px; color:#fff; font-weight:bold; font-size: 30px;  text-align:center;  font-family: 'Athiti', serif;}
/* shared */
td.calendar-day, td.calendar-day-np { width:120px; padding:5px; }
</style>
</head>
<body>
<div id="wrapper">  
      <?php include("menu.php"); ?>
     <div id="page-wrapper">
       <div class="container-fluid">
         
         
  <?php
  if(isset($_GET['month']) && isset($_GET['year'])){
  $month=$_GET['month'];
  $year=$_GET['year'];
  }
  else{
  $month=date("m");
  $year=date("Y");

  }
  
 /* draws a calendar */
function draw_calendar($month,$year){
  include("connect.php");
  $sql = "SELECT * FROM `memo` WHERE SUBSTR(Memo_notification_date,1,4)='$year' AND SUBSTR(Memo_notification_date,6,2)='$month' AND Memo_visiblestatus ='1'";
$result = mysqli_query($conn, $sql);
$num_row = mysqli_num_rows($result);
if($num_row>=1){
while($row=$result->fetch_assoc()){
  $memo_temp []=substr($row['Memo_notification_date'],8,2);
}
sort($memo_temp);
}
else{

}
$memo_day_temp = array();
$sql2 = "SELECT SUM(SUBSTR(Memo_notification_day,1,1)) AS Sunday ,SUM(SUBSTR(Memo_notification_day,2,1)) AS Monday,SUM(SUBSTR(Memo_notification_day,3,1)) AS Tuesday,SUM(SUBSTR(Memo_notification_day,4,1)) AS Wednesday,SUM(SUBSTR(Memo_notification_day,5,1)) AS Thursday,SUM(SUBSTR(Memo_notification_day,6,1)) AS Friday,SUM(SUBSTR(Memo_notification_day,7,1)) AS Saturday FROM `memo` WHERE `Memo_notification_date`= '0000-00-00' AND Memo_visiblestatus ='1'";
$result2 = mysqli_query($conn, $sql2);
$num_row2 = mysqli_num_rows($result2);
$row2=$result2->fetch_assoc();
if( $num_row2 == 1 ) {
  if($row2['Sunday']>=1){
    $memo_day_temp []=0;
  }
  else{
  }
    if($row2['Monday']>=1){
    $memo_day_temp []=1;
  }
  else{
  }
    if($row2['Tuesday']>=1){
    $memo_day_temp []=2;
  }
  else{
  }
    if($row2['Wednesday']>=1){
    $memo_day_temp []=3;
  }
  else{
  }
    if($row2['Thursday']>=1){
    $memo_day_temp []=4;
  }
  else{
  }
    if($row2['Friday']>=1){
    $memo_day_temp []=5;
  }
  else{
  }
    if($row2['Saturday']>=1){
    $memo_day_temp []=6;
  }
  else{
  }
  }
else{
}

 /* $booking_day = 17;
  $booking_month = 6;
  $booking_year = 2017;*/
  $day_now = date("d");
  $month_now = date("m");
  $year_now = date("Y");
  /* draw table */
  $calendar = '<table>';
  /* table headings */
  $headings = array($GLOBALS['strSchedulesunday'],$GLOBALS['strSchedulemonday'],$GLOBALS['strScheduletuesday'],$GLOBALS['strSchedulewednesday'],$GLOBALS['strSchedulethursday'],$GLOBALS['strSchedulefriday'],$GLOBALS['strSchedulesaturday']);
  $calendar.= '<tr><th class="day-text">'.implode('</th><th class="day-text">',$headings).'</th></tr>';

  /* days and weeks vars now ... */
  $running_day = date('w',mktime(0,0,0,$month,1,$year));
  $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
  $days_in_this_week = 1;
  $day_counter = 0;
  $dates_array = array();

  /* row for week one */
  $calendar.= '<tr class="calendar-row">';

  /* print "blank" days until the first of the current week */
  for($x = 0; $x < $running_day; $x++):
    $calendar.= '<td class="calendar-day-np"> </td>';
    $days_in_this_week++;
  endfor;
  $sql1 = "SELECT * FROM `schedule` WHERE Schedule_visiblestatus='1'";
$result1 = mysqli_query($conn, $sql1);
$num_row1 = mysqli_num_rows($result1);
if( $num_row1 >= 1 ) {
  /* keep going with days.... */
  for($list_day = 1; $list_day <= $days_in_month; $list_day++):
       $calendar.= '<td class="calendar-day"><center>';
      /* add in the day number */
      if($list_day==$day_now && $month==$month_now && $year==$year_now)
    {
       $calendar.= '<a href="#"  class="day-current-number alarm day" onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
    }
    else{
      $calendar.= '<a href="#"  class="day-number alarm day" onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
    }
      /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
      $calendar.= str_repeat('<p> </p>',2);
      
    $calendar.= '</center></td>';
    if($running_day == 6):
      $calendar.= '</tr>';
      if(($day_counter+1) != $days_in_month):
        $calendar.= '<tr class="calendar-row">';
      endif;
      $running_day = -1;
      $days_in_this_week = 0;
    endif;
    $days_in_this_week++; $running_day++; $day_counter++;
  endfor;
  }
  else{
   /* keep going with days.... */
  if($num_row >= 1 && $num_row2 == 1){
       $list_day = 1;
  foreach ($memo_temp as $key => $val){
  while($list_day <= $days_in_month && $list_day<$memo_temp[$key]){
       $condition_day_nofication=0;
       $calendar.= '<td class="calendar-day"><center>';
      /* add in the day number */
    if($num_row2 == 1){
      foreach ($memo_day_temp as $key2 => $value) {
        if($running_day == $memo_day_temp[$key2]){
            if($list_day==$day_now && $month==$month_now && $year==$year_now)
    {
             $calendar.= '<a href="#"  class="day day-current-number alarm"  onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
             $condition_day_nofication = 1;
    }
    else{
      $calendar.= '<a href="#"  class="day day-number alarm"  onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
      $condition_day_nofication = 1;
    }
        }
      }
    }
      if($condition_day_nofication==0){
      if($list_day==$day_now && $month==$month_now && $year==$year_now)
    {
             $calendar.= '<a href="#"  class="day day-current-number"  onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
    }
    else{
      $calendar.= '<a href="#"  class="day day-number"  onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
    }
  }
   

      /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
      $calendar.= str_repeat('<p> </p>',2);
      
    $calendar.= '</center></td>';
    if($running_day == 6):
      $calendar.= '</tr>';
      if(($day_counter+1) != $days_in_month):
        $calendar.= '<tr class="calendar-row">';
      endif;
      $running_day = -1;
      $days_in_this_week = 0;
    endif;
    $list_day++; $days_in_this_week++; $running_day++; $day_counter++;

  }
       $calendar.= '<td class="calendar-day"><center>';
      /* add in the day number */
      if($list_day==$day_now && $month==$month_now && $year==$year_now)
    {
             $calendar.= '<a href="#"  class="day day-current-number alarm"  onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
    }
    else{
      $calendar.= '<a href="#"  class="day day-number alarm"  onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
    }
      /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
      $calendar.= str_repeat('<p> </p>',2);
      
    $calendar.= '</center></td>';
    if($running_day == 6):
      $calendar.= '</tr>';
      if(($day_counter+1) != $days_in_month):
        $calendar.= '<tr class="calendar-row">';
      endif;
      $running_day = -1;
      $days_in_this_week = 0;
    endif;
    $list_day++; $days_in_this_week++; $running_day++; $day_counter++;
  }
   while($list_day <= $days_in_month){
       $calendar.= '<td class="calendar-day"><center>';
      /* add in the day number */
      if($list_day==$day_now && $month==$month_now && $year==$year_now)
    {
             $calendar.= '<a href="#"  class="day day-current-number"  onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
    }
    else{
      $calendar.= '<a href="#"  class="day day-number"  onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
    }
      /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
      $calendar.= str_repeat('<p> </p>',2);
      
    $calendar.= '</center></td>';
    if($running_day == 6):
      $calendar.= '</tr>';
      if(($day_counter+1) != $days_in_month):
        $calendar.= '<tr class="calendar-row">';
      endif;
      $running_day = -1;
      $days_in_this_week = 0;
    endif;
    $list_day++; $days_in_this_week++; $running_day++; $day_counter++;
  
  }
  }
  elseif($num_row >= 1){
       $list_day = 1;
  foreach ($memo_temp as $key => $val){
  while($list_day <= $days_in_month && $list_day<$memo_temp[$key]){
       $calendar.= '<td class="calendar-day"><center>';
      /* add in the day number */
   
      if($list_day==$day_now && $month==$month_now && $year==$year_now)
    {
             $calendar.= '<a href="#"  class="day day-current-number"  onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
    }
    else{
      $calendar.= '<a href="#"  class="day day-number"  onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
    }
      /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
      $calendar.= str_repeat('<p> </p>',2);
      
    $calendar.= '</center></td>';
    if($running_day == 6):
      $calendar.= '</tr>';
      if(($day_counter+1) != $days_in_month):
        $calendar.= '<tr class="calendar-row">';
      endif;
      $running_day = -1;
      $days_in_this_week = 0;
    endif;
    $list_day++; $days_in_this_week++; $running_day++; $day_counter++;

  }
       $calendar.= '<td class="calendar-day"><center>';
      /* add in the day number */
      if($list_day==$day_now && $month==$month_now && $year==$year_now)
    {
             $calendar.= '<a href="#"  class="day day-current-number alarm"  onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
    }
    else{
      $calendar.= '<a href="#"  class="day day-number alarm"  onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
    }
      /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
      $calendar.= str_repeat('<p> </p>',2);
      
    $calendar.= '</center></td>';
    if($running_day == 6):
      $calendar.= '</tr>';
      if(($day_counter+1) != $days_in_month):
        $calendar.= '<tr class="calendar-row">';
      endif;
      $running_day = -1;
      $days_in_this_week = 0;
    endif;
    $list_day++; $days_in_this_week++; $running_day++; $day_counter++;
  }
   while($list_day <= $days_in_month){
       $calendar.= '<td class="calendar-day"><center>';
      /* add in the day number */
      if($list_day==$day_now && $month==$month_now && $year==$year_now)
    {
             $calendar.= '<a href="#"  class="day day-current-number"  onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
    }
    else{
      $calendar.= '<a href="#"  class="day day-number"  onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
    }
      /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
      $calendar.= str_repeat('<p> </p>',2);
      
    $calendar.= '</center></td>';
    if($running_day == 6):
      $calendar.= '</tr>';
      if(($day_counter+1) != $days_in_month):
        $calendar.= '<tr class="calendar-row">';
      endif;
      $running_day = -1;
      $days_in_this_week = 0;
    endif;
    $list_day++; $days_in_this_week++; $running_day++; $day_counter++;
  
  }
  }
  elseif($num_row2 == 1){
    for($list_day = 1; $list_day <= $days_in_month; $list_day++):
      $condition_day_nofication=0;
       $calendar.= '<td class="calendar-day"><center>';
      /* add in the day number */
      if($num_row2 == 1 and sizeof($memo_day_temp) > 1){
      foreach ($memo_day_temp as $key2 => $value) {
        if($running_day == $memo_day_temp[$key2]){
            if($list_day==$day_now && $month==$month_now && $year==$year_now)
    {
             $calendar.= '<a href="#"  class="day day-current-number alarm"  onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
             $condition_day_nofication = 1;
    }
    else{
      $calendar.= '<a href="#"  class="day day-number alarm"  onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
      $condition_day_nofication = 1;
    }
        }
      }
    }
      if($condition_day_nofication==0){
      if($list_day==$day_now && $month==$month_now && $year==$year_now)
    {
             $calendar.= '<a href="#"  class="day day-current-number"  onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
    }
    else{
      $calendar.= '<a href="#"  class="day day-number"  onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
    }
  }
      /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
      $calendar.= str_repeat('<p> </p>',2);
      
    $calendar.= '</center></td>';
    if($running_day == 6):
      $calendar.= '</tr>';
      if(($day_counter+1) != $days_in_month):
        $calendar.= '<tr class="calendar-row">';
      endif;
      $running_day = -1;
      $days_in_this_week = 0;
    endif;
    $days_in_this_week++; $running_day++; $day_counter++;
  endfor;
  }
  else{
    for($list_day = 1; $list_day <= $days_in_month; $list_day++):
       $calendar.= '<td class="calendar-day"><center>';
      /* add in the day number */
       if($list_day==$day_now && $month==$month_now && $year==$year_now)
    {
             $calendar.= '<a href="#"  class="day day-current-number"  onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
    }
    else{
      $calendar.= '<a href="#"  class="day day-number"  onclick="select_schedule('.$list_day.','.$month.','.$year.')">'.$list_day.'</a>';
    }
      /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
      $calendar.= str_repeat('<p> </p>',2);
      
    $calendar.= '</center></td>';
    if($running_day == 6):
      $calendar.= '</tr>';
      if(($day_counter+1) != $days_in_month):
        $calendar.= '<tr class="calendar-row">';
      endif;
      $running_day = -1;
      $days_in_this_week = 0;
    endif;
    $days_in_this_week++; $running_day++; $day_counter++;
  endfor;
  }
  }
  

  /* finish the rest of the days in the week */
  if($days_in_this_week < 8):
    for($x = 1; $x <= (8 - $days_in_this_week); $x++):
      $calendar.= '<td class="calendar-day-np"> </td>';
    endfor;
  endif;
  /* final row */
  $calendar.= '</tr>';

  /* end the table */
  $calendar.= '</table>';
  
  /* all done, return result */
  return $calendar;
}

function correct_date($month,$year){
if($month<1){
  $month='12';
  $year=$year-1;
}
elseif($month>12){
  $month='1';
  $year=$year+1;
}
$date ="month=".$month."&year=".$year;
return $date;
}
?>
<div class="row">
<div class="col-md-6">
<div class="row">
<div class="col-md-12">
   <ul class="sub_menu">
     
  <li class="brand">
    <?php
$thaiyear=$year+543;
if($month=="01"){
echo $strSchedulejanuary." ".$thaiyear;  
}
elseif($month=="02"){
echo $strSchedulefebruary." ".$thaiyear;    
}
elseif($month=="03"){
echo $strSchedulemarch." ".$thaiyear;   
}
elseif($month=="04"){
echo $strScheduleapril." ".$thaiyear;  
}
elseif($month=="05"){
echo $strSchedulemay." ".$thaiyear;  
}
elseif($month=="06"){
echo $strSchedulejune." ".$thaiyear;  
}
elseif($month=="07"){
echo $strSchedulejuly." ".$thaiyear;  
}
elseif($month=="08"){
echo $strScheduleaugust." ".$thaiyear; 
}
elseif($month=="09"){
echo $strScheduleseptember." ".$thaiyear; 
}
elseif($month=="10"){
echo $strScheduleoctober." ".$thaiyear;  
}
elseif($month=="11"){
echo $strSchedulenovember." ".$thaiyear; 
}
elseif($month=="12"){
echo $strScheduledecember." ".$thaiyear;  
}
?>
  </li>
    <li><a href="display_schedule.php?<?php if($month-1<=9){
        $month_temp = $month-1;
        $month_format = '0'.$month_temp;
        }
        else{
        $month_format = $month-1;
        }
         echo correct_date($month_format,$year);?>" class="add"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a></li>
     <li><a href="display_schedule.php?<?php if($month+1<=9){
        $month_temp = $month+1;
        $month_format = '0'.$month_temp;}
        else{
        $month_format = $month+1;
        }
         echo correct_date($month_format,$year);?>" class="edit"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a></li>
</ul>

</div>
</div>
<div class="row">
<div class="col-md-12">
<?php
/* sample usages */
echo draw_calendar($month,$year);
?>
</div>
</div>
</div>
<div class="col-md-6">
 
<div id="Display_schedule">
</div>
   
</div>
</div>
</div>
</div>

</div>
<!-- Modal -->
</body>
</html>