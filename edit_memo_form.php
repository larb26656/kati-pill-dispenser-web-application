<?php session_start();
include("lang_check.php");
include("session_check.php");
$Memo_id = $_GET['Memo_id'];?>
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
<script src="jquery-validation/lib/jquery.form.js"></script>
<script src="jquery-validation/dist/jquery.validate.js"></script>

<script type="text/javascript">
   $(document).ready(function () {
        $('.schedule').addClass('active');
        $('.add').addClass('active');
        $("#page-wrapper").fadeIn(200);
        $('.checkbox').change(function() {
           select_hours_edit('<?php echo $Memo_id;?>',get_day_pattern());
        });
        $( "#hours" ).change(function() {
          select_minutes_edit('<?php echo $Memo_id;?>',$('#hours').val(),get_day_pattern());
        });
 $("#update_memo").validate({
          ignore: "not:hidden",
        rules: {
          Memo_desc: "required",
          day: {
              required: true,
              minlength: 1
          },
          hours: "required",
          minutes: "required"
        },
        messages: {
          Memo_desc: '<?php echo $strSchedulememodescisblank;?>',
          day: '<?php echo $strScheduledayisblank;?>',
          hours: '<?php echo $strSchedulehoursisblank;?>',
          minutes: '<?php echo $strScheduleminutesisblank;?>'
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
          // Add the `help-block` class to the error element
          error.addClass( "help-block" );

          if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.parent( "label" ) );
          } else {
            error.insertAfter( element );
          }
        },
        highlight: function ( element, errorClass, validClass ) {
          $( element ).parents( ".input-container" ).addClass( "has-error" ).removeClass( "has-success" );
        },
        unhighlight: function (element, errorClass, validClass) {
          $( element ).parents( ".input-container" ).addClass( "has-success" ).removeClass( "has-error" );
        },
       submitHandler: function(form) {   
        var fData = 'Memo_id=' + document.getElementById("Memo_id").value + '&Memo_desc=' + document.getElementById("Memo_desc").value +'&hours=' + document.getElementById("hours").value+'&minutes=' + document.getElementById("minutes").value + '&Memo_notification_day=' + get_day_pattern();
  $.ajax({
    'type':"POST",
    'url':"include/schedule/update_memo.php",
    'data': fData,
    'processData':false,
    'cache':false,
    'success':function(data) {
      window.location="display_schedule.php";
    },
    'error':function(jqXHR,text,error) { alert(error); }
  });
  return false;
    }
        });
  function get_day_pattern(){
    var day_pattern = ''+ +$("#Sunday").is( ':checked' ) + +$("#Monday").is( ':checked' ) + +$("#Tuesday").is( ':checked' ) + +$("#Wednesday").is( ':checked' ) + +$("#Thursday").is( ':checked' ) + +$("#Friday").is( ':checked' ) + +$("#Saturday").is( ':checked' );
    return day_pattern;
  }
  function select_hours_edit(memo_id,day_pattern){
    var info = 'memo_id=' + memo_id +'&day_pattern=' + day_pattern;
    $.ajax({
      type:"GET",
      data:info,
      url:"include/schedule/select_time_picker_hours_memo_edit.php",
      success:function(data){
        $("#hours").html(data);
        select_minutes_edit('<?php echo $Memo_id;?>',$("#hours option:selected").val(),get_day_pattern());
      }
    });
  }
  select_hours_edit('<?php echo $Memo_id;?>',get_day_pattern());
 function select_minutes_edit(memo_id,hours,day_pattern){
    var info = 'memo_id=' + memo_id + '&hours=' + hours +'&day_pattern=' + day_pattern;
    $.ajax({
      type:"GET",
      data:info,
      url:"include/schedule/select_time_picker_minutes_memo_edit.php",
      success:function(data){
        $("#minutes").html(data);
      }
    });
  }
  });
</script>
</head>
<body>
<div id="wrapper">  
<?php include("menu.php"); include("connect.php");
$Memo_id = $_GET['Memo_id'];
$sql = "SELECT * FROM  `memo` WHERE Memo_id='$Memo_id'";
$result = mysqli_query($conn, $sql);
$row=$result->fetch_assoc();?>
     <div id="page-wrapper">
       <div class="container-fluid">
      <ul class="sub_menu">
     
  <li class="brand"><?php echo $strSchedule;?></li>
  <li><a href="display_schedule.php" class="display"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $strSubmenudisplayinformation;?></a></li>
    <li><a href="#" class="add"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo $strSubmenuinsertinfomation;?></a></li>
</ul>
     </div>
      <div class="col-md-12">
<div class="container-fluid">
<form class="form-horizontal" id="update_memo" name="update_memo">
   <div class="form-group">
    <input type="hidden" id="Memo_id" name="Memo_id" value="<?php echo $row['Memo_id']?>">
    <label class="control-label col-sm-2" for="Memo_desc"><?php echo $strSchedulemessagetextlabel;?></label>
    <div class="col-sm-4 input-container">
    <textarea class="form-control" rows="3" id="Memo_desc" name="Memo_desc"><?php echo $row['Memo_desc']?></textarea>
    </div>
    </div>
     <div class="form-group">
    <label class="control-label col-sm-2" for="Memo_notification_day"><?php echo $strSchedulenotificationdaylabel;?></label>
    <div class="col-sm-4 input-container">
    <div class="checkbox">
  <label><input type="checkbox" value="0" id="Sunday" name="day" <?php if(substr($row['Memo_notification_day'],0,1)=='1'){ echo " checked";}?>><?php echo $strSchedulesunday;?></label>
</div>
<div class="checkbox">
  <label><input type="checkbox" value="0" id="Monday" name="day" <?php if(substr($row['Memo_notification_day'],1,1)=='1'){ echo " checked";}?>><?php echo $strSchedulemonday;?></label>
</div>
<div class="checkbox">
  <label><input type="checkbox" value="0" id="Tuesday" name="day" <?php if(substr($row['Memo_notification_day'],2,1)=='1'){ echo " checked";}?>><?php echo $strScheduletuesday;?></label>
</div>
<div class="checkbox">
  <label><input type="checkbox" value="0" id="Wednesday" name="day" <?php if(substr($row['Memo_notification_day'],3,1)=='1'){ echo " checked";}?>><?php echo $strSchedulewednesday;?></label>
</div>
<div class="checkbox">
  <label><input type="checkbox" value="0" id="Thursday" name="day" <?php if(substr($row['Memo_notification_day'],4,1)=='1'){ echo " checked";}?>><?php echo $strSchedulethursday;?></label>
</div>
<div class="checkbox">
  <label><input type="checkbox" value="0" id="Friday" name="day" <?php if(substr($row['Memo_notification_day'],5,1)=='1'){ echo " checked";}?>><?php echo $strSchedulefriday;?></label>
</div>
<div class="checkbox">
  <label><input type="checkbox" value="0" id="Saturday" name="day" <?php if(substr($row['Memo_notification_day'],6,1)=='1'){ echo " checked";}?>><?php echo $strSchedulesaturday;?></label>
</div>
    </div>
    </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Schedule_time"><?php echo $strScheduletimelabel;?></label>
    <div class="col-sm-2 input-container">
      <select class="form-control" id="hours" name="hours">
      </select>
    </div>
    <div class="col-sm-2 input-container">
      <select class="form-control" id="minutes" name="minutes">
      </select>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default "><?php echo $strFormsubmitbutton;?></button>
    </div>
  </div>
</form>
  
</div>
  </div>
</div>

</div>
<!-- Modal -->
<div id="insert_slot_temp" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">เพิ่มข้อมูลช่อง</h4>
      </div>
      <div class="modal-body" id="Display_slot" name="Display_slot">
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
      </div>
    </div>

  </div>
</div>
</body>
</html>