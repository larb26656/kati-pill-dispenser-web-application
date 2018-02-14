<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>focus demo</title>
  <style>
  .test {
    display: none;
  }
  </style>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
 <form class="form-horizontal">
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="email" placeholder="Enter email">
    <small class="help-block" data-bv-validator="notEmpty" data-bv-for="Outsider_firstname" data-bv-result="NOT_VALIDATED" style=>กรุณากรอกข้อมูลชื่อ</small>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Password:</label>
    <div class="col-sm-10"> 
      <input type="password" class="form-control" id="pwd" placeholder="Enter password">
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label><input type="checkbox"> Remember me</label>
      </div>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>
<p><input type="text" id="id" name="id" value="test"></p>
<p><input type="password" id="test" name="test"> </p>

<p><input type="text" id="test2" name="test2" value="test"></p>
<p><input type="password" id="password" name="password"></p>
<p><input type="password" id="confirm_password" name="confirm_password"></p>
<input id = "btnSubmit" type="submit" value="Submit"/>
<p id="demo"></p>
 
<script>
demoP = document.getElementById("demo");
var array = [];
array.push(1);
array.push(2);

function myFunction(item, index) {
    demoP.innerHTML = demoP.innerHTML + "index[" + index + "]: " + item + "<br>"; 
}
array.forEach(myFunction);
 var result;
$(document).ready(function() {
    $("#btnSubmit").click(function(){
    	 result=true;
       check_normal(id);
check_normal(test);
check_with_post(test2,"test_post.php");
check_password(password,confirm_password);
if(result==true){
alert("test");
    }
 else{

    } 

 }); 
});
function check_normal(id){
  if($(id).val()==""){
 	$(id).css("background-color", "red");
 	result=false;
  }
  else{
  	 $(id).css("background-color", "white");

  }
}
function check_with_post(id,url){
	  if($(id).val()==""){
 	$(id).css("background-color", "red");
 	result=false;
  }
  else{
  	 var all_data =
        {
          text:$("#text").val()
         };
           $.ajax({
          type:'POST',
          url:url,
          data:all_data,
         success: function(html){  
        var reply = html.replace(/\s+/, "");  
          if(reply=='true')    {
          	 $(id).css("background-color", "white");
      
      }
      else    {
     $(id).css("background-color", "red");
 	result=false;
      }
       },
      });
    return false;
  }
	

}
function check_password(id,id2){
 if($(id).val()=="" && $(id2).val()==""){
 	$(id).css("background-color", "red");
 	$(id2).css("background-color", "red");
 	result=false;
 }
 else if($(id).val()==""){
 	$(id).css("background-color", "red");
 	result=false;
 }
 else if($(id2).val()==""){
 	$(id2).css("background-color", "red");
 	result=false;
 }
 else{
 if($(id).val()==$(id2).val()){
  	 $(id).css("background-color", "white");
  	 $(id2).css("background-color", "white");
  }
  else{
  	$(id).css("background-color", "white");
  	$(id2).css("background-color", "red");
 	result=false;
  }
}
}


</script>
 
</body>
</html>