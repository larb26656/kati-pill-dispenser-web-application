<?php
	if(!isset($_SESSION['Member_id']))
	{?>
		 <meta http-equiv="refresh" content = "0;
  url = login_form.php"> 
<?php
		exit();
	}
