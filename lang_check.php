<?php
$dirname = "installation/";
if(is_dir($dirname)) {
	?>
	<meta http-equiv="refresh" content = "0;
  url = installation/"> 
	<?php 
	exit();
    echo "The Directory {$new_path} exists";
    }
 else{
 }
if(!isset($_SESSION['lang'])){
	$_SESSION['lang']='th';
}
if($_SESSION['lang']=='th'){
	$lang='lang/th.php';
}
elseif($_SESSION['lang']=='en'){
	$lang='lang/en.php';
}
include($lang);
?>