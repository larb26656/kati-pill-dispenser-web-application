<?php
include("lang_check.php");
require_once '../connect.php';
$sql = "SELECT Config_value FROM `config` WHERE Config_name = 'Robot_lang' AND Config_visiblestatus = '1'";
$result = mysqli_query($conn, $sql);
$row=$result->fetch_assoc();
$directory='"images/'.$row['Config_value'].'/normal_face.png"';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet"/>
    <script type="text/javascript" src="../bootstrap/js/jquery-2.2.0.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
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
  </head>
  <body>
    <script type="text/javascript">
      $(document).ready(function(){
        var timeoutId = 0;

      $('#box').on('mousedown', function() {
        timeoutId = setTimeout(show_setting, 500);
      }).on('mouseup mouseleave', function() {
        clearTimeout(timeoutId);
      });
      function show_setting(){
        window.location="edit_setting_form.php";
      }
      });
    </script>
    <div id="box">
      <?php include("include/ui/status_bar.php");?>
      <img src=<?php echo $directory;?> width="480" height="191">
    </div>
  </body>
</html>
