<?php session_start();
include("../../lang_check.php");?>
<script src="DataTables-1.10.15/media/js/jquery.dataTables.min.js"></script>  
<script src="DataTables-1.10.15/media/js/dataTables.bootstrap.min.js"></script>            
<link rel="stylesheet" href="DataTables-1.10.15/media/css/dataTables.bootstrap.min.css" />  
<style type="text/css">
</style>
<script type="text/javascript">
$(document).ready(function () {
   $('[data-toggle="tooltip"]').tooltip();   
     });
  function select_pill_in_slot(slot_id){
      var info = 'slot_id=' + slot_id; 
      $.ajax({
      type:"POST",
      url:"include/slot/select_pill_in_slot.php",
      data: info,
      success:function(data){
        $("#slot_edit_content").html(data);
      }
    });
  }
    function select_slot_detail(slot_id){
      var info = 'slot_id=' + slot_id; 
      $.ajax({
      type:"POST",
      url:"include/slot/select_slot_detail.php",
      data: info,
      success:function(data){
        $("#slot_detail_content").html(data);
      }
    });
  }

  function update_pill(slot_id,pill_id)
{

 var info = 'slot_num=' + slot_id + '&pill_id=' + pill_id;

      swal({
  title: "<?php echo $strDialogboxtitleareyousure;?>",
  text: "<?php echo $strDialogboxbodychangeslotwarning;?>",
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
        url: "include/slot/update_slot.php",
        data: info,
        async: false ,
         success: function() {
    window.location.reload(true);}
        }).responseText;


    });
      select_pill_in_slot(slot_id);
}
 function delete_pill(slot_id)
{

 var info = 'slot_num=' + slot_id;

      swal({
  title: "<?php echo $strDialogboxtitleareyousure;?>",
  text: "<?php echo $strDialogboxbodychangeslotwarning;?>",
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
        url: "include/slot/delete_slot.php",
        data: info,
        async: false ,
         success: function() {
    window.location.reload(true);}
        }).responseText;


    });
      select_pill_in_slot(slot_id);
}
</script>
<div class="row">
<?php
$i=1;
while ($i <= 8){
include("../../connect.php");
$color_panel = array("#FF8C7C", "#FF7CB8", "#BE90D4","#417FCB", "#3BB9FF", "#4EEC91", "#F9BF3B", "#8E5C3B");
$sql = "SELECT * FROM slot WHERE Slot_num = '$i' AND Slot_visiblestatus = '1' ORDER BY Slot_id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$num_row = mysqli_num_rows($result);
$row=$result->fetch_assoc();
     if($num_row == 0){
      ?>
       <div class="col-md-3">
              <div class="panel panel-default">
                <div class="panel-heading dashboard_header">
                    <div class="pull-right">
                       <img src="pic/slot/blank.png" weight="70px" height="70px" class="img-circle" style="background-color: <?php echo $color_panel[$i-1]?>;">
                    </div>
                  <h4 class="list-group-item-text">  
                   <?php echo $strSlot." ".$i;?>
                  </h4>
                  <h5>
                 -
                  </h5>
                  
                </div>
                <div class="panel-body dashboard_info"><?php echo $strBlankslot;?><div class="pull-right"><button type="button" class="btn btn-default btn-xs" data-target="#slot_edit" data-toggle="modal" onClick="select_pill_in_slot(<?= $i ?>)" ><?php echo $strSlotedit;?></button></div>
              </div>
            </div>
            </div>
      <?php
     }
     else{
      $sql2 = "SELECT * FROM slot INNER JOIN pill ON slot.Pill_id=pill.Pill_id WHERE slot_id='".$row['Slot_id']."'";
      $result2 = mysqli_query($conn, $sql2) or die($conn->error);
      $row2=$result2->fetch_assoc(); 
      ?>
       <div class="col-md-3">
              <div class="panel panel-default">
                <div class="panel-heading dashboard_header" >
                  <div class="pull-right">
                        <img src="pic/slot/pill.png" weight="70px" height="70px" class="img-circle" style="background-color: <?php echo$color_panel[$i-1]?>;">
                    </div>
                  <h4 class="list-group-item-text">  
                  <?php echo $strSlot." ".$i;?>
                  </h4>
                  <h5>
                  <?php echo $strNumofpill." ".unit_convert_with_max_num($row2['Pill_left'],15,$strPillunit);  
                  if($row2['Pill_left'] < 5){
                   ?> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><?php }?> 
                  </h5>
          
                  
                </div>
                <div class="panel-body dashboard_info"><span data-toggle="tooltip" title="<?php echo $row2['Pill_commonname_'.$strEtclanglabel]; ?>"><b><a href='edit_pill_form.php?pill_id=<?php echo $row2['Pill_id'];?>'><?php echo  mb_substr($row2['Pill_commonname_'.$strEtclanglabel],0,60,'UTF-8');?></a></b></span><div class="pull-right"><button type="button" class="btn btn-default btn-xs open-detail-pill" data-target="#pill_detail" data-toggle="modal" onClick="select_slot_detail(<?= $i ?>); select_pill_in_slot(<?= $i ?>);"><?php echo $strSlotdetail; ?></button>
              </div>
            </div>
            </div>
            </div>

     <?php } 
    $i++;
     if($i == 5){
    ?>
    </div>
    <div class="row">
    <?php
     }
     }?>
     </div>

<div id="pill_detail" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo $strSlotpilldetailtitle;?></h4>
        </div>
          <div class="modal-body" id="slot_detail_content">
   

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-xs" data-target="#slot_edit" data-toggle="modal"><?php echo $strSlotedit;?></button>
        </div>
    </div>
    </div>
    </div>

    <div id="slot_edit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo $strSlotchoosedetailtitle;?></h4>
        </div>
        <div class="modal-body" id="slot_edit_content">
         

        </div>
    </div>
    </div>
    </div>