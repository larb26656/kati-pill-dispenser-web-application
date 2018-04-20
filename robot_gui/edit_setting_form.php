<?php
include("lang_check.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
<link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet"/>
<script type="text/javascript" src="../bootstrap/js/jquery-2.2.0.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
</head>

<style type="text/css">
      body{
        margin: 0px;
        margin-top: 60px;
      }
      #box{
        height: 191px;
        width: 480px;
      }
      .navbar {
         height: 50px;
    }
    </style>
<script type="text/javascript">
	$(document).ready(function(){
	$("form").submit(function(){
  var fData = new FormData(document.getElementById("edit_robot_setting"));
  $.ajax({
   'type':"POST",
    'url':"include/setting/update_setting.php",
    'data':fData,
    'contentType':false,
    'processData':false,
    'cache':false,
    'success':function(data) {
        window.location="normal_face.php";
    },
    'error':function(jqXHR,text,error) { alert(error); }
  });
  return false;
	});
     function select_provinces(){
    $.ajax({
      type:"GET",
      url:"include/setting/select_provinces.php",
      success:function(data){
        $("#provinces_id").html(data);
      }
    });
  }
  select_provinces();
	});

</script>
<body>
<?php include("../connect.php");
$sql3 = "SELECT Config_value FROM `config` WHERE Config_name = 'Robot_lang' AND Config_visiblestatus = '1'";
$result3=$conn->query($sql3);
$row3=$result3->fetch_assoc();
?>
<div id="box">
<?php include("include/ui/status_bar.php");?>
	<div class="container-fluid">
	<div class="row">
  <div class="col-md-12">
  	<form class="form-horizontal" id="edit_robot_setting" name="edit_robot_setting">
  <div class="form-group">
    <label class="control-label col-sm-3" for="robot_lang"><?php echo $strRobotguirobotlanglabel;?></label>
    <div class="col-sm-5">
      <select class="form-control" id="robot_lang" name="robot_lang">
    <option value="thai" <?php if("thai"==$row3['Config_value']){echo 'selected="selected"';}?>><?php echo $strThailang;?></option>
    <option value="english" <?php if("english"==$row3['Config_value']){echo 'selected="selected"';}?>><?php echo $strEnglishlang?></option>
  </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-3" for="display_ip"><?php echo $strRobotguidisplayiplabel;?></label>
    <div class="col-sm-5">
      <label class="control-label col-sm-2" id="display_ip" name="display_ip"><?php echo file_get_contents('http://127.0.0.1:5000/get_ip');?></label>
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3"><?php echo $strRobotguiprovincesidlabel;?></label>
    <div class="col-sm-5">
     <select class="form-control" id="provinces_id" name="provinces_id">
     </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <button type="submit" class="btn btn-default"><?php echo $strFormsubmitbutton;?></button>
    </div>
  </div>
</form>
  </div>
  </div>
</div>
</div>
</body>
</html>
