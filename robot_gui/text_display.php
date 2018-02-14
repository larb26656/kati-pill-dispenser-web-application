<?php
include("lang_check.php");
$text=$_GET['text'];
?>
<link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet"/>
<script type="text/javascript" src="../bootstrap/js/jquery-2.2.0.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<style type="text/css">
      body{
        background: #000000;
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

#container {
  background: #000000;
  width: 480px;
  height: 201px;
}
.jumbotron{
    background-color: #000000;
    color:#fff;
}
#content {
  position: relative;
  float: left;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

</style>
<div id="container">
<?php include("include/ui/status_bar.php");?>
<div class="jumbotron text-center">
  <h4><?php echo $text;?></h4> 
</div>
</div>
