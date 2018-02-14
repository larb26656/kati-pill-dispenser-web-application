<!DOCTYPE html>
<?php session_start();
include("../lang_check.php");?>
<html>
<head>
	<title></title>
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet"/>
<script type="text/javascript" src="../bootstrap/js/jquery-2.2.0.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Mitr|Athiti" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Mitr|Pridi" rel="stylesheet">
<script src="../sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css">
<link href="../Bootstrap-validation/css/bootstrapValidator.css" rel="stylesheet">
<script src="../Bootstrap-validation/js/bootstrapValidator.js"></script>
</head>
<style type="text/css">



/*Form Wizard*/
.bs-wizard {border-bottom: solid 1px #e0e0e0; padding: 0 0 10px 0;}
.bs-wizard > .bs-wizard-step {padding: 0; position: relative;}
.bs-wizard > .bs-wizard-step + .bs-wizard-step {}
.bs-wizard > .bs-wizard-step .bs-wizard-stepnum {color: #595959; font-size: 16px; margin-bottom: 5px;}
.bs-wizard > .bs-wizard-step .bs-wizard-info {color: #999; font-size: 14px;}
.bs-wizard > .bs-wizard-step > .bs-wizard-dot {position: absolute; width: 30px; height: 30px; display: block; background: #fbe8aa; top: 45px; left: 50%; margin-top: -15px; margin-left: -15px; border-radius: 50%;} 
.bs-wizard > .bs-wizard-step > .bs-wizard-dot:after {content: ' '; width: 14px; height: 14px; background: #fbbd19; border-radius: 50px; position: absolute; top: 8px; left: 8px; } 
.bs-wizard > .bs-wizard-step > .progress {position: relative; border-radius: 0px; height: 8px; box-shadow: none; margin: 20px 0;}
.bs-wizard > .bs-wizard-step > .progress > .progress-bar {width:0px; box-shadow: none; background: #fbe8aa;}
.bs-wizard > .bs-wizard-step.complete > .progress > .progress-bar {width:100%;}
.bs-wizard > .bs-wizard-step.active > .progress > .progress-bar {width:50%;}
.bs-wizard > .bs-wizard-step:first-child.active > .progress > .progress-bar {width:0%;}
.bs-wizard > .bs-wizard-step:last-child.active > .progress > .progress-bar {width: 100%;}
.bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot {background-color: #f5f5f5;}
.bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot:after {opacity: 0;}
.bs-wizard > .bs-wizard-step:first-child  > .progress {left: 50%; width: 50%;}
.bs-wizard > .bs-wizard-step:last-child  > .progress {width: 50%;}
.bs-wizard > .bs-wizard-step.disabled a.bs-wizard-dot{ pointer-events: none; }
/*END Form Wizard*/
</style>
<script type="text/javascript">
     $(document).ready(function () {
      check_user();

          var validator = $("#insert_member").bootstrapValidator({
    
      fields : {
        Member_firstname :{
          validators : {
            notEmpty : {
              message : "กรุณากรอกข้อมูลชื่อ"
            }
          }
        },
        Member_surname :{
          validators : {
            notEmpty : {
              message : "กรุณากรอกข้อมูลนามสกุล"
            }
          }
        },
         Username: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอกข้อมูลชื่อผู้ใช้'
                    },
                     remote: {
                        type: 'POST',
                        url: '../include/member/check_username.php',
                        message: 'ชื่อผู้ใช้ซ้ำกรุณากรอกข้อมูลใหม่',
                        delay: 1000
                    },
                    stringLength: {
                        min: 8,
                        max: 30,
                        message: 'ชื่อผู้ใช้ต้องมีความยาวไม่น้อยกว่า 8 ถึง 30 ตัวอักษร'
                    }
                }
            },
         Password :{
          validators : {
            notEmpty : {
              message : "กรุณากรอกข้อมูลรหัสผ่าน"
            },
             identical: {
                        field: 'Confirm_Password',
                        message: 'รหัสผ่านไม่ตรงกัน'
                    }
          }
        },
          Confirm_Password :{
          validators : {
            notEmpty : {
              message : "กรุณากรอกข้อมูลยืนยันรหัสผ่าน"
            },
             identical: {
                        field: 'Password',
                        message: 'รหัสผ่านไม่ตรงกัน'
                    }
          }
        },
           images: {
                validators: {
                    notEmpty : {
                      message : "กรุณาเลือกไฟล์ภาพประจำตัว"
                    },
                    file: {
                        extension: 'png,jpeg,jpg',
                        type: 'image/png,image/jpeg',
                        message: 'โปรดเลือกไฟล์รูป .png .jpeg หรือ .jpg'
                    }
                }
            },

        
      }
    })
        .on('success.form.bv', function(e) {
      swal({
  title: "<?php echo $strDialogboxtitleareyousure;?>",
  text: "<?php echo $strDialogboxbodyinsertwarning;?>",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "<?php echo $strDialogboxconfirmbutton;?>",
  cancelButtonText: "<?php echo $strDialogboxcancelbutton;?>",
  closeOnConfirm: true
},
function(){
   var fData = new FormData(document.getElementById("insert_member"));
    $.ajax({
    'type':"POST",
    'url':"insert_member.php",
    'data':fData,
    'contentType':false,
    'processData':false,
    'cache':false,
    'success':function(data) {
$("#content").html("<?php echo $strInstalldeleteinstallfolder;?>");
    },
    'error':function(jqXHR,text,error) { alert(error); }
  });
 
     });
       return false;
     });

      });   
     function check_user(){
       $.ajax({
    'type':"POST",
    'url':"check_user.php",
    'contentType':false,
    'processData':false,
    'cache':false,
    'success':function(html) {
       var reply = html.replace(/\s+/, "");  
          if(reply=='true')    {
            $("#content").html("<?php echo $strInstalldeleteinstallfolder;?>");
          }
          else{

          }
        }
        });
     }

</script>
<body>
<?php include("navbar.php"); ?>
  <br>
<div class="container">
	 <div class="row">
      <div class="col-md-12" id="content">
                                <form class="form-horizontal" id="insert_member" name="insert_member">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="Member_firstname">
                                            <?php echo $strPersonfirstnamelabel;?>
                                        </label>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="Member_firstname" name="Member_firstname" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="Member_surname">
                                            <?php echo $strPersonlastnamelabel;?>
                                        </label>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="Member_surname" name="Member_surname" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="Username">
                                            <?php echo $strPersonusernamelabel;?>
                                        </label>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="Username" name="Username" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="Password">
                                            <?php echo $strPersonpasswordlabel;?>
                                        </label>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="Password" name="Password" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="Confirm_Password">
                                            <?php echo $strPersonconfirmpasswordlabel;?>
                                        </label>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="Confirm_Password" name="Confirm_Password" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="pic">
                                            <?php echo $strPersonemaillabel;?>
                                        </label>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="Member_email" name="Member_email" type="email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button class="btn btn-default" type="submit">
                                                <?php echo $strFormsubmitbutton;?>
                                            </button>
                                        </div>
                                    </div>
                                </form>
  
</div>
      </div>
  </div>
</div>
</body>
</html>