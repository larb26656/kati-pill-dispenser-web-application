<?php session_start();
include("lang_check.php");?>
<!DOCTYPE html>
<html>
<head>
<title>เข้าสู่ระบบ</title>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet"/>
<script type="text/javascript" src="bootstrap/js/jquery-2.2.0.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Mitr|Pridi" rel="stylesheet">
<link href="bootstrap/css/custom.css" rel="stylesheet"/>
<script src="sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">
<script src="jquery-validation/lib/jquery.form.js"></script>
<script src="jquery-validation/dist/jquery.validate.js"></script>
</head>
<script type="text/javascript">
$(document).ready(function() {
  $("#content").fadeIn(200);
$("#login_form").validate({
          ignore: "not:hidden",
        rules: {
          username: "required",
          password: "required"
        },
        messages: {
            username: '<?php echo $strPersonusernameisblank;?>',
            password: '<?php echo $strPersonpasswordisblank;?>'
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
       var all_data =
        {
          username:$("#username").val(),
          password:$("#password").val(),
         };
           $.ajax({
          type:'POST',
          url:"login_check.php",
          data:all_data,
         success: function(html){  
        var reply = html.replace(/\s+/, "");  
          if(reply=='true')    {
       //$("#add_err").html("right username or password");
       window.location="index.php";
      }
      else    {
      swal("<?php echo $strDialogboxtitleerror;?>", "<?php echo $strDialogboxbodyloginerror;?>", "error");
      }
       },
      });
    return false;
  }
  });

});
</script>
<style>
body{
background-color: #FFFFFF;  /* fallback for old browsers */
}
.col-center-block {
    float: none;
    display: block;
    margin: 0 auto;
    /* margin-left: auto; margin-right: auto; */
}

</style>
<body id="content">
<div class="container">
    <div class="row">
      <div class="col-md-12">
    
      <div class="col-md-3 col-center-block" style="margin-top: 130px;">
          <center><p style="font-family: 'Mitr', sans-serif;font-size: 60px;">
          <?php echo $strLogintitle;?> <span class="badge badge-notify"><?php echo $strLoginbeta;?></span></p></center>
         <form class="form"  role="form" method="post" id="login_form">
  <div class="form-group input-container">
    <input type="text" class="form-control" id="username" name="username" placeholder="<?php echo $strLoginusernameplaceholder;?>">
  </div>
  <div class="form-group input-container">
    <input type="password" class="form-control" id="password" name="password" placeholder="<?php echo $strLoginpasswordplaceholder;?>">
  </div>
  <div class="form-group">
     <a href="password_recovery_form.php"><?php echo $strLoginforgotpasswordlabel;?></a>
  </div>
  <div class="form-group">
    <button type="submit" id="login" name="login" class="btn btn-default"><?php echo $strLoginbuttonlabel;?></button>
  </div>
<div id="result" name="result"></div>
</form>
</div>

          </div>
  </div>
</div>
</body>
</html>