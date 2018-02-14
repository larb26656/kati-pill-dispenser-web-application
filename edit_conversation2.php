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
<link href="Bootstrap-validation/css/bootstrapValidator.css" rel="stylesheet">
<script src="Bootstrap-validation/js/bootstrapValidator.js"></script>
<script type="text/javascript">
   $(document).ready(function () {
        $('.conversation').addClass('active');
        $('.edit').addClass('active');
        $("#page-wrapper").fadeIn(200);
        var validator = $("#edit_conversation").bootstrapValidator({
    
      fields : {
        Conversation_quiz :{
          validators : {
            notEmpty : {
              message : "กรุณากรอกข้อมูลคำถาม"
            }
          }
        },
        Conversation_ans :{
          validators : {
            notEmpty : {
              message : "กรุณากรอกข้อมูลคำตอบ"
            }
          }
        },
         Conversation_type: {
                validators: {
                    notEmpty: {
                        message: 'กรุณาเลือกประเภท'
                    }
                }
            },
              Conversation_language: {
                validators: {
                    notEmpty: {
                        message: 'กรุณาเลือกภาษา'
                    }
                }
            }

        
      }
    })
        .on('success.form.bv', function(e) {
            var fData = new FormData(document.getElementById("edit_conversation"));
  $.ajax({
   'type':"POST",
    'url':"include/conversation/update_conversation.php",
    'data':fData,
    'contentType':false,
    'processData':false,
    'cache':false,
    'success':function(data) {
         window.location="display_conversation.php";
         
    },
    'error':function(jqXHR,text,error) { alert(error); }
  });
  return false;
     });
    });
</script>
</head>
<body>
<?php $conversation_id = $_GET['conversation_id'];
include("connect.php");
$sql = "SELECT * FROM `conversation` WHERE Conversation_id = '$conversation_id'";
$result=$conn->query($sql);
$row=$result->fetch_assoc(); 
?>
<div id="wrapper">  
      <?php include("menu.php"); ?>
     <div id="page-wrapper">
       <div class="container-fluid">
        <ul class="sub_menu">
     
  <li class="brand">คำถาม-คำตอบ</li>
  <li><a href="display_conversation.php" class="display"><i class="fa fa-eye" aria-hidden="true"></i> แสดงข้อมูล</a></li>
    <li><a href="insert_conversation.php" class="add"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มข้อมูล</a></li>
    <li><a href="#" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i> แก้ไขข้อมูล</a></li>
</ul>
     </div>
      <div class="col-md-12">
<div class="container-fluid">
<form class="form-horizontal" name="edit_conversation" id="edit_conversation">
 <input type="hidden" class="form-control" id="Conversation_id" name="Conversation_id" value="<?php echo $row['Conversation_id']; ?>">
  <div class="form-group">
    <label class="control-label col-sm-2" for="Conversation_quiz">คำถาม:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="Conversation_quiz" name="Conversation_quiz" value="<?php echo $row['Conversation_quiz']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Conversation_ans">คำตอบ:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" id="Conversation_ans" name="Conversation_ans" value="<?php echo $row['Conversation_ans']; ?>">
    </div>
  </div>
<div class="form-group">
    <label class="control-label col-sm-2" for="Conversation_type">ประเภท:</label>
    <div class="col-sm-4"> 
   <select class="form-control" id="Conversation_type" name="Conversation_type">
       <option value="ข้อความ" <?php if("ข้อความ"==$row['Conversation_type']){echo 'selected="selected"';}?>>ข้อความ</option>
    <option value="เวลา" <?php if("เวลา"==$row['Conversation_type']){echo 'selected="selected"';}?>>เวลา</option>
    <option value="สภาพอากาศ" <?php if("สภาพอากาศ"==$row['Conversation_type']){echo 'selected="selected"';}?>>สภาพอากาศ</option>
    <option value="จ่ายยา" <?php if("จ่ายยา"==$row['Conversation_type']){echo 'selected="selected"';}?>>จ่ายยา</option>
  </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Conversation_language">ภาษา:</label>
    <div class="col-sm-4"> 
   <select class="form-control" id="Conversation_language" name="Conversation_language" id="Conversation_language">  
  <option value="ไทย" <?php if("ไทย"==$row['Conversation_language']){echo 'selected="selected"';}?>>ไทย</option>
    <option value="อังกฤษ" <?php if("อังกฤษ"==$row['Conversation_language']){echo 'selected="selected"';}?>>อังกฤษ</option>
  </select>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">เพิ่มข้อมูล</button>
    </div>
  </div>
</form>
  
</div>
  </div>
</div>

</div>
</body>
</html>