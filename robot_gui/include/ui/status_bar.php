<?php
include("../connect.php");
$sql = "SELECT * FROM `robot_setting` INNER JOIN provinces ON robot_setting.Provinces_id=provinces.Provinces_id ";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
?>
<style type="text/css">
.navbar-collapse.collapse {
  display: block!important;
}

.navbar-nav>li, .navbar-nav {
  float: left !important;
}

.navbar-nav.navbar-right:last-child {
  margin-right: -15px !important;
}

.navbar-right {
  float: right!important;
}
</style>
<script type="text/javascript">
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('text_clock').innerHTML = h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
   function select_connect_status(){
    $.ajax({
      type:"GET",
      url:"include/ui/select_connect_status.php",
      success:function(data){
        $("#display_connect_status").html(data);
      }
    });
  }
$(document).ready(function () {
startTime();
select_connect_status();
setInterval(select_connect_status,500);
});
</script>

        	<nav class="navbar navbar-default navbar-fixed-top">
			  <div class="container-fluid">
          <ul class="nav navbar-nav navbar-left">
            <li>
                <a class="navbar-brand" href="#" id="text_clock" name="text_clock"></a>
            </li>
        </ul>
			   <ul class="nav navbar-nav navbar-right">
           <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> <span class="label label-success"><?php echo $row['Provinces_name_'.$strEtclanglabel];?></span></a></li>
           <li id="display_connect_status" name="display_connect_status"></li>
          <li><a href="#"><i class="fa fa-globe" aria-hidden="true"></i> <span class="label label-primary"><?php echo $strCurrentlang;?></span></a></li>
      </ul>
			  </div>
			</nav>
