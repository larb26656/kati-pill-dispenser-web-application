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
<script src="jquery-validation/lib/jquery.form.js"></script>
<script src="jquery-validation/dist/jquery.validate.js"></script>
<script type="text/javascript">
   $(document).ready(function () {
        $('.person').addClass('active');
        $('.edit').addClass('active');
        $("#page-wrapper").fadeIn(200);

  $("#update_member").validate({
          ignore: "not:hidden",
        rules: {
          Member_firstname: "required",
          Member_surname: "required",
          Password: {
            required: true,
            minlength: 8,
            maxlength: 12
          },
          Confirm_Password: {
            required: true,
            equalTo: "#Password"
          },
          Member_email: {
            required: true,
            email: true,
            remote:{
                url: "include/member/check_email_edit.php",
                type: "post",
                data: {
                  Member_id: function() {
                    return $( "#Member_id" ).val();
                  }
                }
            }
          }
        },
        messages: {
            Member_firstname: '<?php echo $strPersonfirstnameisblank;?>',
            Member_surname: '<?php echo $strPersonlastnameisblank;?>',
            Password: {
                required: '<?php echo $strPersonpasswordisblank;?>',
                minlength: '<?php echo $strPersonpasswordisnotminlength;?>',
                maxlength: '<?php echo $strPersonpasswordisnotmaxlength;?>'             
            },
            Confirm_Password: {
                required: '<?php echo $strPersonconfirmpasswordisblank;?>',
                equalTo: '<?php echo $strPersonconfirmpasswordnotmatch;?>'
            },
            Member_email: {
                required: '<?php echo $strPersonemailisblank;?>',
                email: '<?php echo $strPersonemailwrongformat;?>',
                remote: '<?php echo $strPersonemailisduplicate;?>'
            }
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
        alert("a");
    var fData = new FormData(document.getElementById("update_member"));
  $.ajax({
    'type':"POST",
    'url':"include/member/update_member.php",
    'data':fData,
    'contentType':false,
    'processData':false,
    'cache':false,
    'success':function(data) {
      window.location="display_person.php";
    },
    'error':function(jqXHR,text,error) { alert(error); }
  });
  return false;
   }
     });

  });
</script>
</head>
<body>
<?php
include("connect.php");
$member_id = $_GET['member_id'];
$sql = "SELECT * FROM  `member` WHERE member_id='$member_id'";
$result = mysqli_query($conn, $sql);
$row=$result->fetch_assoc();?>
<div id="wrapper">  

      <?php include("menu.php"); ?>
     <div id="page-wrapper">
       <div class="container-fluid">
       <div class="row">
       <div class="col-md-12">
        <ul class="sub_menu">
     
  <li class="brand"><?php echo $strPerson;?></li>
  <li><a href="display_person.php" class="display"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $strSubmenudisplayinformation;?></a></li>
    <li><a href="insert_person_form.php" class="add"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo $strSubmenuinsertinfomation;?></a></li>
    <li><a href="#" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo $strSubmenueditinfomation;?></a></li>
</ul>
     </div>
    </div>
    <div class="row">
      <div class="col-md-12">
<form class="form-horizontal" name="update_member" id="update_member">
 <input type="hidden" id="Member_id" name="Member_id" value="<?php echo $member_id;?>">
  <div class="form-group">
    <label class="control-label col-sm-2" for="Member_firstname"><?php echo $strPersonfirstnamelabel;?></label>
    <div class="col-sm-4 input-container">
      <input type="text" class="form-control" id="Member_firstname" name="Member_firstname" value="<?php echo $row['Member_firstname'];?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Member_surname"><?php echo $strPersonlastnamelabel;?></label>
    <div class="col-sm-4 input-container">
      <input type="text" class="form-control" id="Member_surname" name="Member_surname" value="<?php echo $row['Member_surname'];?>">
    </div>
  </div>
<div class="form-group">
    <label class="control-label col-sm-2" for="password"><?php echo $strPersonpasswordlabel;?></label>
    <div class="col-sm-4 input-container"> 
      <input type="password" class="form-control" id="Password"  name="Password" value="<?php echo $row['password'];?>">
    </div>
  </div>
  <div class="form-group">
                                        <label class="control-label col-sm-2" for="Confirm_Password">
                                            <?php echo $strPersonconfirmpasswordlabel;?>
                                        </label>
                                        <div class="col-sm-4 input-container">
                                            <input class="form-control" id="Confirm_Password" name="Confirm_Password" type="password" value="<?php echo $row['password'];?>">
                                        </div>
                                    </div>
    <div class="form-group">
                                        <label class="control-label col-sm-2" for="pic">
                                            <?php echo $strPersonemaillabel;?>
                                        </label>
                                        <div class="col-sm-4 input-container">
                                            <input class="form-control" id="Member_email" name="Member_email" type="email" value="<?php echo $row['Member_email'];?>">
                                        </div>
                                    </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default"><?php echo $strFormeditbutton;?></button>
    </div>
  </div>
</form>
  
</div>
  </div>
</div>
</div>
</div>
</body>
</html>