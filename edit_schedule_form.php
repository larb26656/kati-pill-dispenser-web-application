<?php session_start();
include("lang_check.php");
$Schedule_id = $_GET['Schedule_id'];
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
var slot_id_temp = [];
   $(document).ready(function () {
        $('.schedule').addClass('active');
        $('.add').addClass('active');
        $("#page-wrapper").fadeIn(200);
        $( "#hours" ).change(function() {
          select_minutes_edit($('#hours').val(),<?php echo $Schedule_id;?>);
        });
        //add database data temp
        <?php
        include("connect.php");
        $sql = "SELECT * FROM `schedule` WHERE Schedule_id='$Schedule_id'";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
        $sql2 = "SELECT * FROM `dispenser` INNER JOIN slot ON dispenser.Slot_id = slot.Slot_id INNER JOIN pill ON slot.Pill_id = pill.Pill_id WHERE Schedule_id = '$Schedule_id'";
        $result2=$conn->query($sql2);
         while($row2=$result2->fetch_assoc()){
         ?>
        insert_slot_id_temp_first_time("<?php echo $row2['Slot_id']?>");
         <?php  } ?>
         select_slot_temp();
         select_slot();
         // form submit
        jQuery.validator.addMethod("check_slot_temp_length", function(value, element) {
          if(value>0){
            return true;
          }
          else{
            return false;
          }
          }, '<?php echo $strScheduleslottempisblank;?>');
        $("#update_schedule").validate({
          ignore: "not:hidden",
        rules: {
          hours: "required",
          minutes: "required",
          slot_temp_num: {
            check_slot_temp_length: true
          }
        },
        messages: {
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
          var info = 'schedule_id=' + document.getElementById("Schedule_id").value +'&slot_id_temp=' + slot_id_temp +'&hours=' + document.getElementById("hours").value+'&minutes=' + document.getElementById("minutes").value;
          $.ajax({
          'type':"POST",
          'url':"include/schedule/update_schedule.php",
          'data': info,
          'processData':false,
          'cache':false,
          'success':function(data) {
            window.location="display_schedule.php";
          },
          'error':function(jqXHR,text,error) { alert(jqXHR.responseText); }
        });
        return false;
        }
        });

});
function select_slot_temp(){
  var info = 'slot_id_temp=' + slot_id_temp;
  $.ajax({
    type:"POST",
    url:"include/schedule/select_slot_temp.php",
    data: info,
    success:function(data){
      $("#Display_slot_temp").html(data);
      $("#slot_temp_num").val(slot_id_temp.length);
    }
  });
}
select_slot_temp();
function select_slot(){
  var info = 'slot_id_temp=' + slot_id_temp;
  $.ajax({
    type:"POST",
    url:"include/schedule/select_slot.php",
    data: info,
    success:function(data){
      $("#Display_slot").html(data);
    }
  });
}
select_slot();
function select_hours_edit(schedule_id){
  var info = 'schedule_id=' + schedule_id;
  $.ajax({
    type:"GET",
    data:info,
    url:"include/schedule/select_time_picker_hours_edit.php",
    success:function(data){
      $("#hours").html(data);
      select_minutes_edit($("#hours option:selected").val(),'<?php echo $Schedule_id; ?>');
    }
  });
}
select_hours_edit('<?php echo $Schedule_id; ?>');
function select_minutes_edit(hours,schedule_id){
  var info = 'hours=' + hours + '&schedule_id=' + schedule_id;
  $.ajax({
    type:"GET",
    data:info,
    url:"include/schedule/select_time_picker_minutes_edit.php",
    success:function(data){
      $("#minutes").html(data);
    }
  });
}
function insert_slot_temp(id){
  var info = 'Slot_id=' + id;
  swal({
    title: "<?php echo $strDialogboxtitleareyousure;?>",
    text: "<?php echo $strDialogboxbodyinsertwarning;?>",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "<?php echo $strDialogboxconfirmbutton;?>",
    cancelButtonText: "<?php echo $strDialogboxcancelbutton;?>",
    closeOnConfirm: false
  },
  function(){
    slot_id_temp.push(id);
    select_slot_temp();
    select_slot();
    $('#insert_slot_temp').modal('hide');
    swal("<?php echo $strDialogboxtitlesuccess;?>", "<?php echo $strDialogboxbodyinsertwarning;?>", "success");
  });
}
function remove_slot_temp(id){
  var info = 'Key=' + id;
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
  swal("<?php echo $strDialogboxtitlesuccess;?>", "<?php echo $strDialogboxbodydeleteerror;?>", "success");
  slot_id_temp.splice(id, 1)
  select_slot_temp();
  select_slot();
});
}
function insert_slot_id_temp_first_time(id){
slot_id_temp.push(id);
}
</script>
</head>
<body>
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
<form class="form-horizontal" id="update_schedule" name="update_schedule">
    <input type="hidden" class="form-control" id="Schedule_id" name="Schedule_id" value="<?php echo $Schedule_id; ?>" >
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
    <label class="control-label col-sm-2" for="Slot_id"><?php echo $strScheduleslotidlabel;?></label>
    <div class="col-sm-4 input-container">
    <div class="thumbnail" id="Display_slot_temp" name="Display_slot_temp">
    </div>
    <input type="hidden" id="slot_temp_num" name="slot_temp_num"/>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default"><?php echo $strFormsubmitbutton;?></button>
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
        <h4 class="modal-title"><?php echo $strScheduleslotinserttitle;?></h4>
      </div>
      <div class="modal-body" id="Display_slot" name="Display_slot">

      </div>
    </div>

  </div>
</div>
</body>
<script type="text/javascript">
</script>
</html>
