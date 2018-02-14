<?php session_start();
include("lang_check.php");
include("session_check.php");
include("connect.php");
$pill_id = $_GET['pill_id'];
$sql = "SELECT * FROM `pill` WHERE Pill_id = '$pill_id'";
$result=$conn->query($sql); 
$row=$result->fetch_assoc();?>
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
        $('.pill').addClass('active');
        $('.edit').addClass('active');
        $("#page-wrapper").fadeIn(200);

  $("#update_pill").validate({
          ignore: "not:hidden",
        rules: {
          Pill_commonname_thai: "required",
          Pill_commonname_english: "required",
          Pill_brandname_thai: "required",
          Pill_brandname_english: "required",
          Pill_properties_thai: "required",
          Pill_properties_english: "required",
          Pill_duration: "required",
          Pill_dispenseramount: "required",
          Pill_amount: "required",
          Pill_expiry_date: "required"
        },
        messages: {
          Pill_commonname_thai: '<?php echo $strPillthaicommonnameisblank;?>',
          Pill_commonname_english: '<?php echo $strPillenglishcommonnameisblacnk;?>',
          Pill_brandname_thai: '<?php echo $strPillthaibrandnameisblank;?>',
          Pill_brandname_english: '<?php echo $strPillenglishbrandnameisblank;?>',
          Pill_properties_thai: '<?php echo $strPillthaipropertiesisblank;?>',
          Pill_properties_english: '<?php echo $strPillenglishpropertiesisblank;?>',
          Pill_duration: '<?php echo $strPilldurationisblank;?>',
          Pill_dispenseramount: '<?php echo $strPilldispenseramountisblank;?>',
          Pill_amount: '<?php echo $strPillamountisblank;?>',
          Pill_expiry_date: '<?php echo $strPillexpirydateisblank;?>'
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
            var fData = new FormData(document.getElementById("update_pill"));
  $.ajax({
'type':"POST",
    'url':"include/pill/update_pill.php",
    'data':fData,
    'contentType':false,
    'processData':false,
    'cache':false,
    'success':function(data) { 
          window.location="display_pill.php";
    },
    'error':function(jqXHR,text,error) { alert(error); }
  });
  return false;
  }
     });
 function select_pill_amount(pill_dispenseramount){
    var info = 'pill_dispenseramount=' + pill_dispenseramount;
    $.ajax({
      type:"GET",
      data: info,
      url:"include/pill/select_pill_amount.php",
      success:function(data){
        $("#Pill_left").html(data);
      }
    });
  }
 function select_pill_amount_edit(pill_dispenseramount,pill_amount){
    var info = 'pill_dispenseramount=' + pill_dispenseramount + '&pill_amount=' + pill_amount;
    $.ajax({
      type:"GET",
      data: info,
      url:"include/pill/select_pill_amount_edit.php",
      success:function(data){
        $("#Pill_left").html(data);
      }
    });
  }
 $("#Pill_dispenseramount").bind('keyup mouseup', function () {
    if(document.getElementById("Pill_dispenseramount").value === ""){
    }
    else{
      select_pill_amount(document.getElementById("Pill_dispenseramount").value);
    }
    //alert(document.getElementById("Pill_dispenseramount").value);            
});
    select_pill_amount_edit(document.getElementById("Pill_dispenseramount").value,<?php echo $row['Pill_left'];?>);
    });
</script>
</head>
<body>
<div id="wrapper">  
      <?php include("menu.php"); ?>
     <div id="page-wrapper">
       <div class="container-fluid">
     <div class="row">
     <div class="col-md-12">
    <ul class="sub_menu">
  <li class="brand"><?php echo $strPill;?></li>
  <li><a href="display_pill.php" class="display"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $strSubmenudisplayinformation;?></a></li>
    <li><a href="insert_pill_form.php" class="add"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo $strSubmenuinsertinfomation;?></a></li>
     <li><a href="#" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo $strSubmenueditinfomation;?></a></li>
</ul>
     </div>
     </div>
     <div class="row">
      <div class="col-md-12">
<form class="form-horizontal" name="update_pill" id="update_pill">
<input type="hidden" class="form-control" id="Pill_id" name="Pill_id" value="<?php echo $row['Pill_id'];?>">
  <div class="form-group">
    <label class="control-label col-sm-2" for="Pill_commonname_thai"><?php echo $strPillthaicommonnamelabel;?></label>
    <div class="col-sm-4 input-container"> 
        <input type="text" class="form-control" id="Pill_commonname_thai" name="Pill_commonname_thai" value="<?php echo $row['Pill_commonname_thai'];?>">
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Pill_commonname_english"><?php echo $strPillenglishcommonnamelabel;?></label>
    <div class="col-sm-4 input-container"> 
        <input type="text" class="form-control" id="Pill_commonname_english" name="Pill_commonname_english"  value="<?php echo $row['Pill_commonname_english'];?>">
    </div>
  </div>
     <div class="form-group">
    <label class="control-label col-sm-2" for="Pill_brandname_thai"><?php echo $strPillthaibrandnamelabel;?></label>
    <div class="col-sm-4 input-container"> 
        <input type="text" class="form-control" id="Pill_brandname_thai" name="Pill_brandname_thai"  value="<?php echo $row['Pill_brandname_thai'];?>">
    </div>
  </div>
       <div class="form-group">
    <label class="control-label col-sm-2" for="Pill_brandname_english"><?php echo $strPillenglishbrandnamelabel;?></label>
    <div class="col-sm-4 input-container"> 
        <input type="text" class="form-control" id="Pill_brandname_english" name="Pill_brandname_english" value="<?php echo $row['Pill_brandname_english'];?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Pill_properties_thai"><?php echo $strPillthaipropertieslabel;?></label>
    <div class="col-sm-4 input-container"> 
       <textarea class="form-control" rows="5" id="Pill_properties_thai" name="Pill_properties_thai"><?php echo $row['Pill_properties_thai'];?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Pill_properties_english"><?php echo $strPillenglishpropertieslabel;?></label>
    <div class="col-sm-4 input-container"> 
       <textarea class="form-control" rows="5" id="Pill_properties_english" name="Pill_properties_english"><?php echo $row['Pill_properties_english'];?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Pill_duration"><?php echo $strPilldurationlabel;?></label>
    <div class="col-sm-4 input-container"> 
    <select class="form-control" id="Pill_duration" name="Pill_duration">
    <option value="painorfever" <?php if("painorfever"==$row['Pill_duration']){echo 'selected="selected"';}?>><?php echo $strPilldurationpainorfeverlabel;?></option>
    <option value="beforebreakfast" <?php if("beforebreakfast"==$row['Pill_duration']){echo 'selected="selected"';}?>><?php echo $strPilldurationbeforebreakfastlabel;?></option>
    <option value="beforelunch" <?php if("beforelunch"==$row['Pill_duration']){echo 'selected="selected"';}?>><?php echo $strPilldurationbeforelunchlabel;?></option>
    <option value="beforedinner" <?php if("beforedinner"==$row['Pill_duration']){echo 'selected="selected"';}?>><?php echo $strPilldurationbeforedinnerlabel;?></option>
  </select>
    </div>
  </div>
<div class="form-group">
    <label class="control-label col-sm-2" for="Pill_dispenseramount"><?php echo $strPilldispenseramount;?></label>
    <div class="col-sm-1 input-container"> 
      <input type="number" class="form-control" id="Pill_dispenseramount" name="Pill_dispenseramount" value="<?php echo $row['Pill_dispenseramount'];?>" min="1" max="15">
    </div>
    <label class="col-sm-1"><?php echo $strPillunit;?></label>
  </div>
   <div class="form-group">
    <label class="control-label col-sm-2" for="Pill_left"><?php echo $strPillamount;?></label>
    <div class="col-sm-1 input-container"> 
      <select class="form-control" id="Pill_left" name="Pill_left"></select> 
    </div>
    <label class="col-sm-1"><?php echo $strPillunit;?></label>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Pill_expiry_date"><?php echo $strPillexpirydatelabel;?></label>
    <div class="col-sm-4 input-container"> 
      <input type="date" class="form-control" id="Pill_expiry_date" name="Pill_expiry_date" value="<?php echo $row['Pill_expiry_date'];?>">
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