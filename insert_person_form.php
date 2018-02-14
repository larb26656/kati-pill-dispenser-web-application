<?php session_start();
include("lang_check.php");
include("session_check.php");?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            <?php echo $strTitle?>
        </title>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet"/>
<script src="bootstrap/js/jquery-2.2.0.min.js" type="text/javascript">
</script>
<script src="bootstrap/js/bootstrap.min.js">
</script>
<link href="font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Mitr|Athiti" rel="stylesheet">
<link href="bootstrap/css/custom.css" rel="stylesheet"/>
<script src="sweetalert-master/dist/sweetalert.min.js">
</script>
<link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet" type="text/css">
<script src="jquery-validation/lib/jquery.form.js"></script>
<script src="jquery-validation/dist/jquery.validate.js"></script>
<script type="text/javascript">
        
   $(document).ready(function () {
        $('.person').addClass('active');
        $('.add').addClass('active');
        $("#page-wrapper").fadeIn(200);


  $("#insert_member").validate({
          ignore: "not:hidden",
        rules: {
          Member_firstname: "required",
          Member_surname: "required",
          Username: {
            required: true,
            minlength: 8,
            maxlength: 12,
            remote:{
                url: "include/member/check_username.php",
                type: "post"
            }
          },
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
                url: "include/member/check_email.php",
                type: "post"
            }
          }
        },
        messages: {
            Member_firstname: '<?php echo $strPersonfirstnameisblank;?>',
            Member_surname: '<?php echo $strPersonlastnameisblank;?>',
            Username: {
                required: '<?php echo $strPersonusernameisblank;?>',
                minlength: '<?php echo $strPersonusernameisnotminlength;?>',
                maxlength: '<?php echo $strPersonusernameisnotmaxlength;?>',
                remote: '<?php echo $strPersonusernameisduplicate;?>'
            },
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
          var fData = new FormData(document.getElementById("insert_member"));
  $.ajax({
    'type':"POST",
    'url':"include/member/insert_member.php",
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
      $("#insert_outsider").validate({
          ignore: "not:hidden",
        rules: {
          Outsider_firstname: "required",
          Outsider_surname: "required",
          Outsider_level: "required",
          Outsider_token: {
            required: true,
            remote:{
                url: "include/outsider/check_token.php",
                type: "post"
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
            var fData = new FormData(document.getElementById("insert_outsider"));
  $.ajax({
    'type':"POST",
    'url':"include/outsider/insert_outsider.php",
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
                    </link>
                </link>
            </link>
        </link>
    </head>
    <body>
        <div id="wrapper">
            <?php include("menu.php"); ?>
            <div id="page-wrapper">
                <div class="container-fluid">
                <div class="row">
                 <div class="col-md-12">
                    <ul class="sub_menu">
                        <li class="brand">
                            <?php echo $strPerson;?>
                        </li>
                        <li>
                            <a class="display" href="display_person.php">
                                <i aria-hidden="true" class="fa fa-eye">
                                </i>
                                <?php echo $strSubmenudisplayinformation;?>
                            </a>
                        </li>
                        <li>
                            <a class="add" href="#">
                                <i aria-hidden="true" class="fa fa-plus">
                                </i>
                                <?php echo $strSubmenuinsertinfomation;?>
                            </a>
                        </li>
                    </ul>
                       </div>
                    </div>
                    <div class="row">
                       <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#member">
                                <?php echo $strPersonmembertab;?>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#outsider">
                                <?php echo $strPersonoutsidertab;?>
                            </a>
                        </li>
                    </ul>
                    </div>
                    </div>
                <div class="row">
                <div class="col-md-12">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="member">
                                <p>
                                </p>
                                <form class="form-horizontal" id="insert_member" name="insert_member">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="Member_firstname">
                                            <?php echo $strPersonfirstnamelabel;?>
                                        </label>
                                        <div class="col-sm-4 input-container">
                                            <input class="form-control" id="Member_firstname" name="Member_firstname" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="Member_surname">
                                            <?php echo $strPersonlastnamelabel;?>
                                        </label>
                                        <div class="col-sm-4 input-container">
                                            <input class="form-control" id="Member_surname" name="Member_surname" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="Username">
                                            <?php echo $strPersonusernamelabel;?>
                                        </label>
                                        <div class="col-sm-4 input-container">
                                            <input class="form-control" id="Username" name="Username" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="Password">
                                            <?php echo $strPersonpasswordlabel;?>
                                        </label>
                                        <div class="col-sm-4 input-container">
                                            <input class="form-control" id="Password" name="Password" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="Confirm_Password">
                                            <?php echo $strPersonconfirmpasswordlabel;?>
                                        </label>
                                        <div class="col-sm-4 input-container">
                                            <input class="form-control" id="Confirm_Password" name="Confirm_Password" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="pic">
                                            <?php echo $strPersonemaillabel;?>
                                        </label>
                                        <div class="col-sm-4 input-container">
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
                            <div class="tab-pane fade" id="outsider">
                                <p>
                                </p>
                                <form class="form-horizontal" id="insert_outsider" name="insert_outsider">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="Outsider_firstname">
                                            <?php echo $strPersonfirstnamelabel;?>
                                        </label>
                                        <div class="col-sm-4 input-container">
                                            <input class="form-control" id="Outsider_firstname" name="Outsider_firstname" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="Outsider_surname">
                                            <?php echo $strPersonlastnamelabel;?>
                                        </label>
                                        <div class="col-sm-4 input-container">
                                            <input class="form-control" id="Outsider_surname" name="Outsider_surname" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="Outsider_level">
                                            <?php echo $strPersonlevellabel;?>
                                        </label>
                                        <div class="col-sm-4 input-container">
                                            <select class="form-control" id="Outsider_level" name="Outsider_level">
                                             <option value=""><?php echo $strPersonlevelblanklabel;?></option>
                                                <option value="caregiver">
                                                    <?php echo $strPersonlevelcaregiverlabel;?>
                                                </option>
                                                <option value="doctor">
                                                    <?php echo $strPersonleveldoctorlabel;?>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="Outsider_token">
                                            <?php echo $strPersontokenlabel;?>
                                        </label>
                                        <div class="col-sm-4 input-container">
                                        <textarea class="form-control" rows="7" id="comment" id="Outsider_token" name="Outsider_token"></textarea>
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
              </div>
            </div>
        </div>
    </body>
</html>