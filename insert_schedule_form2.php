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
<script src="sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">
<link rel="stylesheet" href="bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">
   <link href="Bootstrap-validation/css/bootstrapValidator.css" rel="stylesheet"/>
  <script src="Bootstrap-validation/js/bootstrapValidator.js">
                        </script>
<script type="text/javascript" src="bootstrap-material-datetimepicker/js/moment-with-locales.min.js"></script>
<script type="text/javascript" src="bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<script type="text/javascript">
var slot_id_temp = [];
   $(document).ready(function () {
        $('.schedule').addClass('active');
        $('.add').addClass('active');
        $("#page-wrapper").fadeIn(200);

        var validator = $("#insert_schedule").bootstrapValidator({
    
      fields : {
      }
    })
        .on('success.form.bv', function(e) {
         var info = 'slot_id_temp=' + slot_id_temp +'&Scheldule_time=' + document.getElementById("Scheldule_time").value;
  $.ajax({
    'type':"POST",
    'url':"include/schedule/insert_schedule.php",
    'data': info,
    'processData':false,
    'cache':false,
    'success':function(data) {
      window.location="display_schedule.php";
    },
    'error':function(jqXHR,text,error) { alert(error); }
  });
  return false;

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
   function insert_slot_temp(id){
       var info = 'Slot_id=' + id;
           swal({
  title: "คุณแน่ใจแล้วเหรือ",
  text: "ที่จะเพิ่มข้อมูล?",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "ยืนยัน",
  cancelButtonText: "ยกเลิก",
  closeOnConfirm: false
},
function(){
slot_id_temp.push(id);
select_slot_temp();
select_slot();
 $('#insert_slot_temp').modal('hide');
 swal("สำเร็จ!", "เพิ่มข้อมูลสำเร็จ", "success");
   });
  }
     function remove_slot_temp(id){
       var info = 'Key=' + id;
           swal({
  title: "คุณแน่ใจแล้วเหรือ",
  text: "ที่จะลบข้อมูล?",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "ยืนยัน",
  cancelButtonText: "ยกเลิก",
  closeOnConfirm: false
},
function(){
 swal("ลบ!", "ข้อมูลถูกลบสำเร็จ.", "success");
 slot_id_temp.splice(id, 1)
       select_slot_temp();
       select_slot();
   });
  }
</script>
</head>
<body>
<div id="wrapper">  
      <?php include("menu.php"); ?>
     <div id="page-wrapper">
       <div class="container-fluid">
      <ul class="sub_menu">
     
  <li class="brand">ตารางเวลา</li>
  <li><a href="display_schedule.php" class="display"><i class="fa fa-eye" aria-hidden="true"></i> แสดงข้อมูล</a></li>
    <li><a href="#" class="add"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มข้อมูล</a></li>
</ul>
     </div>
      <div class="col-md-12">
<div class="container-fluid">
<form class="form-horizontal" id="insert_schedule" name="insert_schedule">
  <div class="form-group">
    <label class="control-label col-sm-2" for="Scheldule_time">เวลา</label>
    <div class="col-sm-4">
      <input type="time" class="form-control" id="Scheldule_time" name="Scheldule_time">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Slot_id">ช่องที่ต้องการจ่าย</label>
    <div class="col-sm-4">
    <div class="thumbnail" id="Display_slot_temp" name="Display_slot_temp">
    </div>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default ">เพิ่มข้อมูล</button>
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
<script type="text/javascript">
  $('#Scheldule_time').bootstrapMaterialDatePicker({   // enable date picker
  date: false,
        lang : 'en',
        format: 'HH:mm',
        'cancelText' : 'ยกเลิก',
        'clearText' : 'ล้างข้อมูล',
        'okText' : 'ยืนยัน'


});
</script>
</script>
</html>