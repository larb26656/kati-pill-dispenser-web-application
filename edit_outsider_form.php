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
 function showPreview(ele){
                $('#img-product').attr('src', ele.value);
                    if (ele.files && ele.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#img-product').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(ele.files[0]);
                    }
                }
   $(document).ready(function () {
        $('.member').addClass('active');
        $('.edit').addClass('active');
        $("#page-wrapper").fadeIn(200);

      $("#update_outsider").validate({
          ignore: "not:hidden",
        rules: {
          Outsider_firstname: "required",
          Outsider_surname: "required",
          Outsider_level: "required",
          Outsider_token: {
            required: true,
            remote:{
                url: "include/outsider/check_token_edit.php",
                type: "post",
                data: {
                  Outsider_id: function() {
                    return $( "#Outsider_id" ).val();
                  }
                }
            }
          }
        },
        messages: {
          Outsider_firstname: '<?php echo $strPersonfirstnameisblank;?>',
          Outsider_surname: '<?php echo $strPersonlastnameisblank;?>',
          Outsider_level: '<?php echo $strPersonlevelisblank;?>',
          Outsider_token: {
            required: '<?php echo $strPersontokenisblank;?>',
            remote: '<?php echo $strPersontokenduplicate;?>'
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
            var fData = new FormData(document.getElementById("update_outsider"));
  $.ajax({
   'type':"POST",
    'url':"include/outsider/update_outsider.php",
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
<?php $outsider_id = $_GET['outsider_id'];
include("connect.php");
$sql = "SELECT * FROM `outsider` WHERE Outsider_id = '$outsider_id'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();?>
<div id="wrapper">

      <?php include("menu.php"); ?>
     <div id="page-wrapper">
       <div class="container-fluid">
        <ul class="sub_menu">

  <li class="brand"><?php echo $strPerson;?></li>
  <li><a href="display_person.php" class="display"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $strSubmenudisplayinformation;?></a></li>
    <li><a href="insert_person_form.php" class="add"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo $strSubmenuinsertinfomation;?></a></li>
    <li><a href="#" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo $strSubmenueditinfomation;?></a></li>
</ul>
     </div>
      <div class="col-md-12">
<div class="container-fluid">
<div class="tab-content">
<form class="form-horizontal" name="update_outsider" id="update_outsider">
   <input type="hidden" class="form-control" id="Outsider_id" name="Outsider_id" value="<?php echo $row['Outsider_id'];?>">
  <div class="form-group">
    <label class="control-label col-sm-2" for="Outsider_firstname"><?php echo $strPersonfirstnamelabel;?></label>
    <div class="col-sm-4 input-container">
      <input type="text" class="form-control" id="Outsider_firstname" name="Outsider_firstname" value="<?php echo $row['Outsider_firstname'];?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Outsider_surname"><?php echo $strPersonlastnamelabel;?></label>
    <div class="col-sm-4 input-container">
      <input type="text" class="form-control" id="Outsider_surname" name="Outsider_surname" value="<?php echo $row['Outsider_surname'];?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Outsider_level"><?php echo $strPersonlevellabel;?></label>
    <div class="col-sm-4 input-container">
       <select class="form-control" id="Outsider_level" name="Outsider_level">
      <option value="caregiver" <?php if("caregiver"==$row['Outsider_level']){echo 'selected="selected"';}?>>
         <?php echo $strPersonlevelcaregiverlabel;?>
         </option>
           <option value="doctor" <?php if("doctor"==$row['Outsider_level']){echo 'selected="selected"';}?>>
                   <?php echo $strPersonleveldoctorlabel;?>
            </option>
            <option value="patient" <?php if("patient"==$row['Outsider_level']){echo 'selected="selected"';}?>>
                    <?php echo $strPersonlevelpatientlabel;?>
             </option>
  </select>
    </div>
  </div>
 <div class="form-group">
    <label class="control-label col-sm-2" for="Outsider_token"><?php echo $strPersontokenlabel;?></label>
    <div class="col-sm-4 input-container">
      <textarea class="form-control" rows="7" id="comment" id="Outsider_token" name="Outsider_token"><?php echo $row['Outsider_token'];?></textarea>
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
</body>
</html>
