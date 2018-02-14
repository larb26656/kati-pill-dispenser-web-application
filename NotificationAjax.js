var badge_number_temp=0;
var notification_sound = new Audio('sound/notification.mp3');

$(document).ready(function(e) {
	increaseNotify();
    setInterval(increaseNotify, 1000);
    $('#notification_button').click(function() { 
    select_notification();
    decreaseNotify();
  });
    $('#dispaly_notification').click(function(e) {
        var events = $._data(document, 'events') || {};
    events = events.click || [];
    for(var i = 0; i < events.length; i++) {
        if(events[i].selector) {
            if($(event.target).is(events[i].selector)) {
                events[i].handler.call(event.target, event);
            }
            $(event.target).parents(events[i].selector).each(function(){
                events[i].handler.call(this, event);
            });
        }
    }
    event.stopPropagation();
    });
});
function increaseNotify(){ // โหลดตัวเลขทั้งหมดที่ถูกส่งมาแสดง
	$.ajax({
		url: "include/notification/increase.php",
		type: 'GET',
		success: function(obj) {
			var obj = JSON.parse(obj);
      if(obj.badge_number>badge_number_temp){
        notification_sound.play();
      }
			$(".badge-notify").text(obj.badge_number);
      badge_number_temp = obj.badge_number;
			var defaultTxt = $("title").text();
			defaultTxt = defaultTxt.split("(");
      if(obj.badge_number==0){
        $("title").text(defaultTxt[0]);
      }
      else{
			 $("title").text(defaultTxt[0]+" ("+obj.badge_number+")");
      }
		}
	});
}
function decreaseNotify(){ // ลบตัวเลข badge number
	$.ajax({
		url: "include/notification/decrease.php",
		type: 'GET',
		success: function(obj) {
			
		}
	});
}
function select_notification(){
    $.ajax({
      type:"POST",
      url:"include/notification/select_notification.php",
      success:function(data){
        $("#dispaly_notification").html(data);
      }
    });
  }
  
  function activaTab(tab){
    $('.tab-pane a[href="#' + tab + '"]').tab('show');
};
  function click_tab(){
 	 activaTab('menu1');
  }
  
