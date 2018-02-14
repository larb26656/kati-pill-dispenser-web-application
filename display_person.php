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
        $('.person').addClass('active');
        $('.display').addClass('active');
        $("#page-wrapper").fadeIn(200);
    });

   function hide_member(id)
{

 var info = 'member_id=' + id;
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
        url: "include/member/hide_member.php",
        data: info,
        async: false ,
         success: function() {
    window.location.reload(true);}
        }).responseText;


     });
}
 function restore_member(id)
{

 var info = 'member_id=' + id;
      swal({
  title: "<?php echo $strDialogboxtitleareyousure;?>",
  text: "<?php echo $strDialogboxbodyrecoveryerror;?>",
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
        url: "include/member/restore_member.php",
        data: info,
        async: false ,
         success: function() {
    window.location.reload(true);}
        }).responseText;


     });
}
  function edit_member(id)
{
 var info = 'member_id=' + id;
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
        window.location.href = "edit_member_form.php?" + info;
       });
}
  function change_admin_permission(id)
{
 var info = 'Member_id=' + id;
   swal({
  title: "<?php echo $strDialogboxtitleareyousure;?>",
  text: "<?php echo $strDialogboxbodychangeadminpermissionwarning;?>",
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
        url: "include/member/change_admin_permission.php",
        data: info,
        async: false ,
         success: function() {
    window.location.href = "logout.php";}
        }).responseText;
       });
}

  function hide_outsider(id)
{

 var info = 'outsider_id=' + id;
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
        url: "include/outsider/hide_outsider.php",
        data: info,
        async: false ,
         success: function() {
    window.location.reload(true);}
        }).responseText;


     });
}
  function edit_outsider(id)
{
 var info = 'outsider_id=' + id;
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
        window.location.href = "edit_outsider_form.php?" + info;
       });
}
</script>
</head>
<body>
<?php 
include("connect.php");
$sql = "SELECT * FROM `member` WHERE Member_visiblestatus = '1'";
$result=$conn->query($sql); 
$sql2 = "SELECT * FROM `outsider` WHERE Outsider_visiblestatus = '1'";
$result2=$conn->query($sql2); 
?>
<div id="wrapper">  

      <?php include("menu.php"); ?>
     <div id="page-wrapper">
            <div class="container-fluid">
            <div class ="row">
  <div class="col-md-12"> 

      <ul class="sub_menu">
     
  <li class="brand"><?php echo $strPerson;?></li>
  <li><a href="#" class="display"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $strSubmenudisplayinformation;?></a></li>
  <li><a href="display_person_restore.php" class="display_restore"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $strSubmenudisplaydeleteinformation;?></a></li>
    <li><a href="insert_person_form.php" class="add"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo $strSubmenuinsertinfomation;?></a></li>
</ul>
</div>
</div>
<div class ="row">
  <div class="col-md-12"> 


<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#member"><?php echo $strPersonmembertab;?></a></li>
  <li><a data-toggle="tab" href="#outsider"><?php echo $strPersonoutsidertab;?></a></li>
</ul>
</div>
</div>
     <div class ="row">
      <div class="col-md-12">  

<div class="tab-content">
  <div id="member" class="tab-pane fade in active">
  <p></p>
   <table id="member_data" class="table table-bordered">
    <thead>
      <tr>
        <th><?php echo $strPersonnamelabel;?></th>
        <th><?php echo $strPersonusernamelabel;?></th>
          <th><?php echo $strPersonemaillabel;?></th>
            <th><?php echo $strTableedit;?></th>
            <th><?php echo $strTableadminpermission;?></th>
            <th><?php echo $strTablemanage;?></th>


      </tr>
    </thead>
    <tbody>
    <?php while($row=$result->fetch_assoc()){ ?>
      <tr<?php if($row['Admin_permission']=="1"){}
      else{ echo " class='warning'";}?>>
        <td><?php echo $row['Member_firstname']." ".$row['Member_surname'];?></td>
        <td><?php echo $row['username'];?></td>
         <td><?php echo $row['Member_email'];?></td>
<td>
<button type="button" class="btn btn-warning btn-xs" onClick="edit_member(<?= $row['Member_id'] ?>)"><?php echo $strTableeditbutton;?></button>
</td>
<td><button type="button" class="btn btn-primary btn-xs" onClick="change_admin_permission(<?= $row['Member_id'] ?>)" <?php if($row['Admin_permission']=="0"){}
      else{ echo "disabled";}?>><?php echo $strTablechoosebutton;?></button></td>
<td>
<button type="button" class="btn btn-danger btn-xs" onClick="hide_member(<?= $row['Member_id'] ?>)"><?php echo $strTabledeletebutton;?></button>
</td>
      </tr>
     <?php } ?>
    </tbody>
  </table>
  </div>
    <div id="outsider" class="tab-pane fade">
  <P></P>
   <table id="outsider_data" class="table table-bordered">
    <thead>
      <tr>
        <th><?php echo $strPersonnamelabel;?></th>
        <th><?php echo $strPersonlevellabel;?></th>
            <th><?php echo $strTableedit;?></th>
            <th><?php echo $strTablemanage;?></th>


      </tr>
    </thead>
    <tbody>
    <?php while($row2=$result2->fetch_assoc()){ ?>
      <tr>
        <td><?php echo $row2['Outsider_firstname']." ".$row2['Outsider_surname'];?></td>
        <td><?php echo ${"strPersonlevel".$row2['Outsider_level']."label"};?></td>
<td>
<button type="button" class="btn btn-warning btn-xs" onClick="edit_outsider(<?= $row2['Outsider_id'] ?>)"><?php echo $strTableeditbutton;?></button>
</td>
<td>
<button type="button" class="btn btn-danger btn-xs" onClick="hide_outsider(<?= $row2['Outsider_id'] ?>)"><?php echo $strTabledeletebutton;?></button>
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
</div>
</div>
</body>
<script>  
 $(document).ready(function(){  
      $('#member_data').DataTable({
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
       $('#outsider_data').DataTable({
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