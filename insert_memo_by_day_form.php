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
<link rel="stylesheet" href="bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">
<script src="jquery-validation/lib/jquery.form.js"></script>
<script src="jquery-validation/dist/jquery.validate.js"></script>

<script type="text/javascript">
   $(document).ready(function () {
        $('.schedule').addClass('active');
        $('.add').addClass('active');
        $("#page-wrapper").fadeIn(200);
        $('#Memo_notification_date').change(function() {
          select_hours($("#Memo_notification_date" ).val());
        });
        $( "#hours" ).change(function() {
          select_minutes($('#hours').val(),$("#Memo_notification_date" ).val());
        });
    $("#insert_memo").validate({
          ignore: "not:hidden",
        rules: {
          Memo_desc: "required",
          Memo_notification_date: "required",
          hours: "required",
          minutes: "required"
        },
        messages: {
          Memo_desc: '<?php echo $strSchedulememodescisblank;?>',
          Memo_notification_date: '<?php echo $strScheduledateisblank;?>',
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
        var fData = new FormData(document.getElementById("insert_memo"));
  $.ajax({
    'type':"POST",
    'url':"include/schedule/insert_memo_by_day.php",
    'data': fData,
    'contentType':false,
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
    function select_hours(dayofweek){
    var info = 'dayofweek=' + dayofweek;
    $.ajax({
      type:"GET",
      data:info,
      url:"include/schedule/select_time_picker_hours_memo_by_day.php",
      success:function(data){
        $("#hours").html(data);
      }
    });
  }
select_hours($("#Memo_notification_date" ).val());
 function select_minutes(hours,dayofweek){
    var info = 'hours=' + hours +'&dayofweek=' + dayofweek;
    $.ajax({
      type:"GET",
      data:info,
      url:"include/schedule/select_time_picker_minutes_memo_by_day.php",
      success:function(data){
        $("#minutes").html(data);
      }
    });
  }
  });
</script>
</head>
<body>
<?php $date = $_GET['date'];?>
<div id="wrapper">  
      <?php include("menu.php"); ?>
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
<form class="form-horizontal" id="insert_memo" name="insert_memo">
   <div class="form-group">
    <label class="control-label col-sm-2" for="Memo_desc"><?php echo $strSchedulemessagetextlabel;?></label>
    <div class="col-sm-4 input-container">
    <textarea class="form-control" rows="3" id="Memo_desc" name="Memo_desc"></textarea>
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Memo_notification_date"><?php echo $strScheduledatelabel;?></label>
    <div class="col-sm-4 input-container">
      <input type="date" class="form-control" id="Memo_notification_date" name="Memo_notification_date" value="<?php echo $date;?>">
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