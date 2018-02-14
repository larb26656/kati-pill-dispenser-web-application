<?php session_start();
include("lang_check.php");
include("session_check.php");?>
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
<script src="DataTables-1.10.15/media/js/jquery.dataTables.min.js"></script>  
<script src="DataTables-1.10.15/media/js/dataTables.bootstrap.min.js"></script>            
<link rel="stylesheet" href="DataTables-1.10.15/media/css/dataTables.bootstrap.min.css" />
<script src="sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">
<script type="text/javascript">
   $(document).ready(function () {
        $('.pill').addClass('active');
        $('.display').addClass('active');
        $("#page-wrapper").fadeIn(200);
    });
 function edit_pill(id)
{
 var info = 'pill_id=' + id;
   swal({
  title: "<?php echo $strDialogboxtitleareyousure;?>",
  text: "<?php echo $strDialogboxbodyediterror;?>",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "<?php echo $strDialogboxconfirmbutton;?>",
  cancelButtonText: "<?php echo $strDialogboxcancelbutton;?>",
  closeOnConfirm: false
},
function(){
        window.location.href = "edit_pill_form.php?" + info;
       });
}
      function hide_pill(id)
{

 var info = 'pill_id=' + id;
      swal({
  title: "<?php echo $strDialogboxtitleareyousure;?>",
  text: "<?php echo $strDialogboxbodydeleteerror;?>",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "<?php echo $strDialogboxconfirmbutton;?>",
  cancelButtonText: "<?php echo $strDialogboxcancelbutton;?>",
  closeOnConfirm: false
},
function(){
        var html = $.ajax({
        type: "GET",
        url: "include/pill/hide_pill.php",
        data: info,
        async: false ,
         success: function() {
    window.location.reload(true);}
        }).responseText;


     });
}
</script>
</head>
<body>
<?php 
include("connect.php");
$sql = "SELECT * FROM `pill` WHERE Pill_visiblestatus = '1' ORDER BY Pill_id";
$result=$conn->query($sql); 
?>
<div id="wrapper">  
      <?php include("menu.php"); ?>
     <div id="page-wrapper">
       <div class="container-fluid">
       <div class="row">
       <div class="col-md-12">
      <ul class="sub_menu">
     
  <li class="brand"><?php echo $strPill;?></li>
  <li><a href="#" class="display"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $strSubmenudisplayinformation;?></a></li>
   <li><a href="display_pill_restore.php" class="display_restore"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $strSubmenudisplaydeleteinformation;?></a></li>
    <li><a href="insert_pill_form.php" class="add"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo $strSubmenuinsertinfomation;?></a></li>
</ul>
     </div>
     </div>
      <div class="row">
      <div class="col-md-12">
   <table id="pill_data" class="table table-bordered">
    <thead>
      <tr>
        <th><?php echo $strPillcommonnamelabel ;?></th>
        <th><?php echo $strPillbrandnamelabel ;?></th>
        <th><?php echo $strPillpropertieslabel ;?></th>
        <th><?php echo $strPillmethodlabel ;?></th>
          <th><?php echo $strPillleftlabel ;?></th>
          <th><?php echo $strPillexpirydatelabel ;?></th>
            <th><?php echo $strTableedit ;?></th>
          <th><?php echo $strTablemanage ;?></th>

      </tr>
    </thead>
    <tbody>
    <?php while($row=$result->fetch_assoc()){
     ?>
      <tr>
        <td><?php echo $row['Pill_commonname_'.$strEtclanglabel];?></td>
        <td><?php echo $row['Pill_brandname_'.$strEtclanglabel];?></td>
        <td><?php echo $row['Pill_properties_'.$strEtclanglabel];?></td>
        <td><?php echo $strPilldurationtakelabel." ".unit_convert($row['Pill_dispenseramount'],$strPillunit)." ".${"strPillduration".$row['Pill_duration']."label"};?></td>
           <td><?php echo unit_convert($row['Pill_left'],$strPillunit);?></td>
            <td><?php echo $row['Pill_expiry_date'];?></td>

<td>
<button type="button" class="btn btn-warning btn-xs" onClick="edit_pill(<?= $row['Pill_id'] ?>)"><?php echo $strTableeditbutton;?></button>
</td>
<td>
<button type="button" class="btn btn-danger btn-xs" onClick="hide_pill(<?= $row['Pill_id'] ?>)"><?php echo $strTabledeletebutton;?></button>
</td>
      </tr>
     <?php } ?>
    </tbody>
  </table>
</div>
  </div>
</div>

</div>
</div>
</body>
<script>  
 $(document).ready(function(){  
      $('#pill_data').DataTable({
        ordering: false,
              "language": {
            "lengthMenu": "<?php echo $strTablelengthmenu;?>",
            "zeroRecords": "<?php echo $strTablezerorecords;?>",
            "info": "<?php echo $strTableinfo;?>",
            "infoEmpty": "<?php echo $strTableinfoempty;?>",
            "infoFiltered": "(<?php echo $strTableinfofiltered;?>)",
            "paginate": {
            "first":      "<?php echo $strTablefirst;?>",
            "last":       "<?php echo $strTablelast;?>",
            "next":       "<?php echo $strTablenext;?>",
            "previous":   "<?php echo $strTableprevious;?>"
    },
            "search":         "<?php echo $strTablesearch;?>"
        }
    } );
} ); 
 </script>  
</html>