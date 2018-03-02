<?php
include("lang_check.php");
$text=$_GET['text'];
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
  <link href="../bootstrap/css/bootstrap.css" rel="stylesheet"/>
  <script type="text/javascript" src="../bootstrap/js/jquery-2.2.0.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <style type="text/css">
    body{
      margin: 0px;
      margin-top: 60px;
      background-color: #000000;
    }
    .navbar {
      height: 50px;
    }
    .box{
      color: #FFFFFF;
      height: 191px;
      width: 480px;
      word-wrap:break-word;
    }
    #text{
      opacity: 1;
    }
  </style>
</head>
<body>
<div class="box">
  <?php include("include/ui/status_bar.php");?>
  <h2 style="text-align: center;" id="text">
  </h2> 
</div>
<script type="text/javascript">
  $(document).ready(function(){
  var textGet = "<?php echo $_GET['text'];?>"

  var textArray = getTextArray(textGet);
  var i = 0;
  var text = document.querySelector('#text');

  var timeleft = 180;

  var downloadTimer = setInterval(function(){
    timeleft = timeleft-1;
    if(timeleft < 0){
      clearInterval(downloadTimer);
      show_normal_face();
    }
    },1000);

  var timeoutId = 0;

  $('.box').on('mousedown', function() {
    document.body.style.backgroundColor = "#E74C3C";
    timeoutId = setTimeout(show_normal_face, 500);
  }).on('mouseup mouseleave', function() {
    clearTimeout(timeoutId);
    document.body.style.backgroundColor = "#000000";
  });

  function show_normal_face(){
    window.location="normal_face.php";    
  }

  function getTextArray(text){
    var textArray = [];
    var textMaximumOnScreen = 155;
    if(text.length > textMaximumOnScreen){
      loopTimes = Math.round(text.length/textMaximumOnScreen);
      textPositionStart = 0;
      textPositionStop = textMaximumOnScreen;
      for (i = 1; i <= loopTimes; i++) { 
        textSubString = text.substring(textPositionStart,textPositionStop);
        textArray.push(textSubString);
        textPositionStart = textPositionStart+textMaximumOnScreen;
        textPositionStop = textPositionStart+textMaximumOnScreen;
      }
    }
    else{
      textArray.push(text);
    }
    return textArray;
  }
  function slide(){
    text.innerHTML = textArray[i];
    text.style.opacity = 1;
    setTimeout(next, 2000);  
  }

  function next(){
    i++;
    if(i > textArray.length-1){
      i=0;
    }
    text.style.opacity = 1;
    setTimeout(slide, 1000);
  }

  slide();
  });
</script>
</body>
</html>



