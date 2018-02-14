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
<script src="DataTables-1.10.15/media/js/jquery.dataTables.min.js"></script>  
<script src="DataTables-1.10.15/media/js/dataTables.bootstrap.min.js"></script>            
<link rel="stylesheet" href="DataTables-1.10.15/media/css/dataTables.bootstrap.min.css" />
<script src="sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">
<script type="text/javascript">
   $(document).ready(function () {
        $('.conversation').addClass('active');
        $('.display').addClass('active');
        $("#page-wrapper").fadeIn(200);
    });
 function edit_conversation(id)
{
 var info = 'conversation_id=' + id;
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
        window.location.href = "edit_conversation.php?" + info;
       });
}
  function hide_conversation(id)
{

 var info = 'conversation_id=' + id;
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
        url: "include/conversation/hide_conversation.php",
        data: info,
        async: false ,
         success: function() {
    window.location.reload(true);}
        }).responseText;


     });
}
 function restore_conversation(id)
{

 var info = 'conversation_id=' + id;
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
        url: "include/conversation/restore_conversation.php",
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
$sql = "SELECT * FROM `conversation` WHERE Conversation_visiblestatus = '1'";
$result=$conn->query($sql); 
?>
<div id="wrapper">  
      <?php include("menu.php"); ?>
     <div id="page-wrapper">
       <div class="container-fluid">
       <div class="row">
       <div class="col-md-12">
      <ul class="sub_menu">
     
  <li class="brand"><?php echo $strConversation;?></li>
  <li><a href="#" class="display"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $strSubmenudisplayinformation;?></a></li>
   <li><a href="display_conversation_restore.php" class="display_restore"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $strSubmenudisplaydeleteinformation;?></a></li>
    <li><a href="insert_conversation_form.php" class="add"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo $strSubmenuinsertinfomation;?></a></li>
</ul>
     </div>
     </div>
     <div class="row">
      <div class="col-md-12">
   <table id="conversation_data" class="table table-bordered">
    <thead>
      <tr>
        <th><?php echo $strFaqquestionlabel;?></th>
         <th><?php echo $strFaqtypelabel;?></th>
         <th><?php echo $strFaqlanglabel;?></th>
            <th><?php echo $strTableeditbutton;?></th>
          <th><?php echo $strTablemanage;?></th>

      </tr>
    </thead>
    <tbody>
    <?php while($row=$result->fetch_assoc()){
       ?>
      <tr>
        <td><?php echo $row['Conversation_quiz'];?></td>
        <td><?php
          if($row['Conversation_type']=="pill_dispenser"){
              $sql2 = "SELECT * FROM `pill` WHERE Pill_id = '".$row['Pill_id']."' LIMIT 1";
              $result2=$conn->query($sql2); 
              $row2=$result2->fetch_assoc();
              $pill_name=$row2['Pill_commonname_'.$strEtclanglabel]." ".unit_convert($row2['Pill_dispenseramount'],$strPillunit);
              echo ${"strFaqtype".$row['Conversation_type']."label"}." (".$pill_name.")";
          }
          else{
            echo ${"strFaqtype".$row['Conversation_type']."label"};
          }
        ?></td>
        <td><?php echo ${"strFaqlang".$row['Conversation_language']."label"};?></td>
<td>
<button type="button" class="btn btn-warning btn-xs" onClick="edit_conversation(<?= $row['Conversation_id'] ?>)"><?php echo $strTableeditbutton;?></button>
</td>
<td>
<button type="button" class="btn btn-danger btn-xs" onClick="hide_conversation(<?= $row['Conversation_id'] ?>)"><?php echo $strTabledeletebutton;?></button>
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
      $('#conversation_data').DataTable({
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