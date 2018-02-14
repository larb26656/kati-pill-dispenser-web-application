<?php 
include("lang_check.php");
require_once '../connect.php';
$sql = "SELECT * FROM robot_setting";
$result = mysqli_query($conn, $sql);
$row=$result->fetch_assoc();
$directory='"images/'.$row['Robot_lang'].'/normal_face.png"';?>
<html>
    <head>
    	<link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
    	<link href="../bootstrap/css/bootstrap.css" rel="stylesheet"/>
<script type="text/javascript" src="../bootstrap/js/jquery-2.2.0.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
        <title></title>
    </head>
    <style type="text/css">
    	body{
    		margin: 0px;
    		margin-top: 60px;
    	}
    	#box{
    		height: 191px;
    		width: 480px;
    	}
    	.navbar {
   			 height: 50px;
		}
    </style>
    <body>
    	<script type="text/javascript">
    		$(document).ready(function(){
    		var timeoutId = 0;

			$('#coinAnimation').on('mousedown', function() {
   				 timeoutId = setTimeout(show_setting, 500);
			}).on('mouseup mouseleave', function() {
    			clearTimeout(timeoutId);
			});
			function show_setting(){
				window.location="edit_setting_form.php";    
			}
		});
    	</script>
    	<div id="box">
        <?php include("include/ui/status_bar.php");?>
		<canvas id="coinAnimation"></canvas>
       	</div>
        <script>
        	(function() {
	// http://paulirish.com/2011/requestanimationframe-for-smart-animating/
	// http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating
	// requestAnimationFrame polyfill by Erik Möller. fixes from Paul Irish and Tino Zijdel
	// MIT license

    var lastTime = 0;
    var vendors = ['ms', 'moz', 'webkit', 'o'];
    for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame'] 
                                   || window[vendors[x]+'CancelRequestAnimationFrame'];
    }
 
    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() { callback(currTime + timeToCall); }, 
              timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };
 
    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
}());

(function () {
			
	var coin,
		coinImage,
		canvas;					

	function gameLoop () {
	
	  window.requestAnimationFrame(gameLoop);

	  coin.update();
	  coin.render();
	}
	
	function sprite (options) {
	
		var that = {},
			frameIndex = 0,
			tickCount = 0,
			ticksPerFrame = options.ticksPerFrame || 0,
			numberOfFrames = options.numberOfFrames || 1;
		
		that.context = options.context;
		that.width = options.width;
		that.height = options.height;
		that.image = options.image;
		
		that.update = function () {

            tickCount += 1;

            if (tickCount > ticksPerFrame) {

				tickCount = 0;
				
                // If the current frame index is in range
                if (frameIndex < numberOfFrames - 1) {	
                    // Go to the next frame
                    frameIndex += 1;
                } else {
                    frameIndex = 0;
                }
            }
        };
		
		that.render = function () {
		
		  // Clear the canvas
		  that.context.clearRect(0, 0, that.width, that.height);
		  
		  // Draw the animation
		  that.context.drawImage(
		    that.image,
		    frameIndex * that.width / numberOfFrames,
		    0,
		    that.width / numberOfFrames,
		    that.height,
		    0,
		    0,
		    that.width / numberOfFrames,
		    that.height);
		};
		
		return that;
	}
	
	// Get canvas
	canvas = document.getElementById("coinAnimation");
	canvas.width = 480;
	canvas.height = 191;
	
	// Create sprite sheet
	coinImage = new Image();	
	
	// Create sprite
	coin = sprite({
		context: canvas.getContext("2d"),
		width: 960,
		height: 191,
		image: coinImage,
		numberOfFrames: 2,
		ticksPerFrame: 2
	});
	
	// Load sprite sheet
	coinImage.addEventListener("load", gameLoop);
	coinImage.src = <?php echo $directory ?>;

} ());

        </script>
    </body>
</html>