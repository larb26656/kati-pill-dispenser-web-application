<?php session_start();
include("lang_check.php");
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $strTitle;?></title>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet"/>
<script type="text/javascript" src="bootstrap/js/jquery-2.2.0.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Mitr|Athiti" rel="stylesheet">
<link href="bootstrap/css/custom.css" rel="stylesheet"/>
<script src="sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">
<script src="DataTables-1.10.15/media/js/jquery.dataTables.min.js"></script>  
<script src="DataTables-1.10.15/media/js/dataTables.bootstrap.min.js"></script>            
<link rel="stylesheet" href="DataTables-1.10.15/media/css/dataTables.bootstrap.min.css" />  
<script src="jquery-validation/lib/jquery.form.js"></script>
<script src="jquery-validation/dist/jquery.validate.js"></script>
<script type="text/javascript">
   $(document).ready(function () {
    $("#Pill_form_group").hide();
        $('.add').addClass('active');
        $("#page-wrapper").fadeIn(200);
$("#password_recovery").validate({
          ignore: "not:hidden",
        rules: {
          Email: {
            required: true,
            email: true,
            remote:{
                url: "include/member/check_email_inverse.php",
                type: "post"
            }
          }
        },
        messages: {
          Email: {
                required: '<?php echo $strPersonemailisblank;?>',
                email: '<?php echo $strPersonemailwrongformat;?>',
                remote: '<?php echo $strPersonemailnotfound;?>'
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
            var fData = new FormData(document.getElementById("password_recovery"));
  $('#loadingmessage').show();
  $('#content').hide();
  $.ajax({
   'type':"POST",
    'url':"include/member/sent_email.php",
    'data':fData,
    'contentType':false,
    'processData':false,
    'cache':false,
    'success':function(data) {
    $('#loadingmessage').hide();
     $('#content').show();
      $("#content").html(data);
         
    },
    'error':function(jqXHR,text,error) { alert(error); }
  });
  return false;
    }
     });
  $('#Conversation_type').change(function() {
 var conversation_type_value = $(this).val();
    if(conversation_type_value == "pill_dispenser"){
       $("#Pill_form_group").show();
    }
    else{
      $("#Pill_form_group").hide();
    }
  }); 
    });
   function select_pill_in_slot(){
      var info = 'pill_id=' + $("#Pill_id").val(); 
      $.ajax({
      type:"POST",
      url:"include/conversation/select_pill_in_slot.php",
      data: info,
      success:function(data){
        $("#slot_edit_content").html(data);
      }
    });
  }
    function update_pill(pill_id,pill_name)
{

 var info = 'pill_id=' + pill_id + '&pill_name=' + pill_name;

    $("#Pill_id").val(pill_id);
    $("#Pill_name").text(pill_name);
    $('#slot_edit').modal('toggle');
}
</script>
</head>
<body>
<?php 
include("connect.php");
$sql = "SELECT * FROM `member` WHERE Member_visiblestatus = '1'";
$result=$conn->query($sql); 
?>
<div id="wrapper">  
      <?php include("menu.php"); ?>
     <div id="page-wrapper">
       <div class="container-fluid">
      <ul class="sub_menu">
     
  <li class="brand"><?php echo $strPasswordrecovery;?></li>
</ul>
     </div>
      <div class="col-md-12">
<div id="loadingmessage" style="display:none">
  <center><img src='pic/loading.gif'/ height="100" width="100"><br>
    <h4><?php echo $strLoadinglabel;?></h4></center>
</div>
<div class="container-fluid" id="content">
<form class="form-horizontal" name="password_recovery" id="password_recovery">
  <div class="form-group">
    <label class="control-label col-sm-2" for="Email"><?php echo $strPersonemaillabel;?></label>
    <div class="col-sm-4 input-container">
      <input type="email" class="form-control" id="Email" name="Email">
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
  <div id="slot_edit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel" ><?php echo $strFaqpillchooselabel;?></h4>
        </div>
        <div class="modal-body" id="slot_edit_content">
         

        </div>
    </div>
    </div>
    </div>
</body>
</html>