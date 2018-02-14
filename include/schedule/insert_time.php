<!DOCTYPE html>
<html>
<head>
<title>ความสุขของกะทิ</title>
<link href="../../bootstrap/css/bootstrap.css" rel="stylesheet"/>
<script type="text/javascript" src="../../bootstrap/js/jquery-2.2.0.min.js"></script>
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../../font-awesome-4.7.0/css/font-awesome.min.css">
<style type="text/css">
	    table.borderless td,table.borderless th{
     border: none !important;
}
</style>
</head>

<body>
<div class="col-md-3">
<div class="row">
<div class="col-md-12" style="text-align: center;">
	<h1>7:00</h1>
</div>
</div>
<div class="row">
<div class="col-md-12" style="text-align: center;">
	ชั่วโมง
</div>
</div>
<div class="row">
<div class="col-md-12" style="text-align: center;">
<div class="table-responsive">
<?php 
echo "<table class='table borderless'>";
$i = 0;
echo "<tr>";
for ($x = 0; $x <= 23; $x++) 
{
   if($i == 5){
       echo "</tr><tr>";
       $i = 0;
   }
   echo "<td>".$x."</td>";
$i++;
}
echo "</tr>";
echo "</table>"; ?>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12" style="text-align: center;">
	นาที
</div>
</div>
<div class="row">
<div class="col-md-12" style="text-align: center;">
<div class="table-responsive">
<?php 
echo "<table class='table borderless'>";
$i = 0;
echo "<tr>";
for ($x = 0; $x <= 55; $x+=5) 
{
   if($i == 5){
       echo "</tr><tr>";
       $i = 0;
   }
   echo "<td>".$x."</td>";
$i++;
}
echo "</tr>";
echo "</table>"; ?>
</div>
</div>
</div>


    
</body>
</html>