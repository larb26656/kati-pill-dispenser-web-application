<?php session_start();
include("lang_check.php");
include("session_check.php");?>
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
        $('.conversation').addClass('active');
        $('.add').addClass('active');
        $("#page-wrapper").fadeIn(200); 

jQuery.validator.addMethod("check_pill_dispenser", function(value, element) {
          var conversation_type = $("#Conversation_type").val();
          if(conversation_type=="pill_dispenser"){
            if(value==""){
              return false;
            }
            else{
              return true;
            }
          }
          else{
            return true;
          }
          }, '<?php echo $strFaqpillisblank;?>');
    $("#insert_conversation").validate({
          ignore: "not:hidden",
        rules: {
          Conversation_quiz: "required",
          Conversation_type: "required",
          Conversation_language: "required",
          Pill_id: {
              check_pill_dispenser: true    
          }
        },
        messages: {
          Conversation_quiz: '<?php echo $strFaqquestionisblank;?>',
          Conversation_type: '<?php echo $strFaqtypeisblank;?>',
          Conversation_language: '<?php echo $strFaqlangisblank;?>'
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
  var fData = new FormData(document.getElementById("insert_conversation"));
  $.ajax({
   'type':"POST",
    'url':"include/conversation/insert_conversation.php",
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
     
  <li class="brand"><?php echo $strConversation;?></li>
  <li><a href="display_conversation.php" class="display"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $strSubmenudisplayinformation;?></a></li>
    <li><a href="#" class="add"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo $strSubmenuinsertinfomation;?></a></li>
</ul>
     </div>
      <div class="col-md-12">
<div class="container-fluid">
<form class="form-horizontal" name="insert_conversation" id="insert_conversation">
  <div class="form-group">
    <label class="control-label col-sm-2" for="Conversation_quiz"><?php echo $strFaqquestionlabel;?></label>
    <div class="col-sm-4 input-container">
      <input type="text" class="form-control" id="Conversation_quiz" name="Conversation_quiz">
    </div>
  </div>
<div class="form-group">
    <label class="control-label col-sm-2" for="Conversation_type"><?php echo $strFaqtypelabel;?></label>
    <div class="col-sm-4 input-container"> 
   <select class="form-control" id="Conversation_type" name="Conversation_type">
    <option value=""><?php echo $strFaqtypeblanklabel;?></option>
    <option value="date"><?php echo $strFaqtypedatelabel;?></option>
    <option value="time"><?php echo $strFaqtypetimelabel;?></option>
    <option value="pill_dispenser"><?php echo $strFaqtypepill_dispenserlabel;?></option>
    <option value="weather"><?php echo $strFaqtypeweatherlabel;?></option>
    <option value="calculator"><?php echo $strFaqtypecalculatorlabel;?></option>
    <option value="memo"><?php echo $strFaqtypememolabel;?></option>
  </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Conversation_language"><?php echo $strFaqlanglabel;?></label>
    <div class="col-sm-4 input-container"> 
   <select class="form-control" id="Conversation_language" name="Conversation_language" id="Conversation_language">
     <option value=""><?php echo $strFaqlangblanklabel;?></option>
    <option value="thai"><?php echo $strFaqlangthailabel;?></option>
    <option value="english"><?php echo $strFaqlangenglishlabel;?></option>
  </select>
    </div>
  </div>
    <div class="form-group" id="Pill_form_group" name="Pill_form_group">
    <label class="control-label col-sm-2" for="Pill_id"><?php echo $strFaqpilllabel;?></label>
    <div class="col-sm-4 input-container"> 
        <span id="Pill_name" name="Pill_name"></span>
        <input type="hidden" class="form-control" id="Pill_id" name="Pill_id">
    </div>
    <div class="col-sm-2"> 
      <button type="button" class="btn btn-primary" data-target="#slot_edit" data-toggle="modal" onClick="select_pill_in_slot()"><?php echo $strTablechoosebutton;?></button>
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