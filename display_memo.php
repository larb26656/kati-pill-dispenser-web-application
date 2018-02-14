<!DOCTYPE html>
<html>
<head>
<title>ความสุขของกะทิ</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
<script type="text/javascript" src="bootstrap/js/jquery-2.2.0.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php 
include("connect.php");
$sql = "SELECT * FROM `drug` WHERE Drug_visiblestatus = '1'";
$result=$conn->query($sql); 
include("mainmenu.php"); ?>
<div class="container-fluid">
	   <div class="row">
      <div class="col-md-2">
    <?php include("profile.php");?>
      </div>
      <div class="col-md-10">
     <ol class="breadcrumb">
  <li><a href="index.php">แผงควบคุม</a></li>
  <li class="active">แสดงข้อมูลยา</li>
</ol>
<div class="container-fluid">
   <table class="table table-bordered">
    <thead>
      <tr>
        <th>รหัสยา</th>
        <th>ชื่อยา</th>
        <th>รายละเอียดยา</th>
         <th>จำนวนยา</th>
          <th>จำนวนการจ่ายยา</th>
            <th>แก้ไข</th>
          <th>ลบ</th>

      </tr>
    </thead>
    <tbody>
    <?php while($row=$result->fetch_assoc()){
      $percent_drugleft=$row['Drug_left']/$row['Drug_amount']*100; ?>
      <tr>
        <td><?php echo $row['Drug_id'];?></td>
        <td><?php echo $row['Drug_name'];?></td>
        <td><?php echo $row['Drug_desc'];?></td>
  <td><div class="progress">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow=<?php echo '"'.$percent_drugleft.'"';?>
  aria-valuemin="0" aria-valuemax="100" style=<?php echo '"width:'.$percent_drugleft.'%"';?>>
    <?php echo $row['Drug_left']."/".$row['Drug_amount'];?>
  </div>
</div>
</td>
        <td><?php echo $row['Drug_dispenseramount'];?></td>
<td>
<a href="edit_drugs.php"  class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
</td>
<td>
<button type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
</td>
      </tr>
     <?php } ?>
    </tbody>
  </table>
</div>
  </div>
</div>

</div>
</body>
</html>