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
function select_volume_level(){
    $.ajax({
      type:"POST",
      url:"include/ui/select_volume_level.php",
      success:function(data){
        $("#volume_level").html(data);
      }
    });
  }
$(document).ready(function () {
startTime();
setInterval(select_volume_level, 500);
});
</script>


        	<nav class="navbar navbar-default navbar-static-top">
			  <div class="container-fluid">
			  	 <div class="navbar-header">
      <a class="navbar-brand" href="#" id="text_clock" name="text_clock">s</a>
    </div>
			   <ul class="nav navbar-nav navbar-right">
          <li><a href="lang/thai_lang_select.php"><i class="fa fa-globe" aria-hidden="true"></i> <span class="label label-primary"><?php echo $strCurrentlang;?></span></a></li>
        <li><a href="#" id="volume_level" name="volume_level"></a></li>
        <li><a href="#"><i class="fa fa-link" aria-hidden="true"></i> <span class="label label-danger">Lost</span></a></li>
        <li><a href="#"><i class="fa fa-wifi" aria-hidden="true"></i> <span class="label label-success">Test Wifi</span></a></li>
      </ul>
			  </div>
			</nav>
		