<style type="text/css">
.profile-image {
  position: relative;
    top: -5px;
    float: left;
    left: -5px;
}
</style>
  <nav class="navbar navbar-default navbar-fixed-top"> 
<div class="container-fluid">
    <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
       <a class="navbar-brand" href="#" style="font-family: 'Mitr', sans-serif;font-size: 25px; color:#000000;"><?php echo $strNavbarbrand;?></a>
    </div>
   <div class="collapse navbar-collapse" id="myNavbar">
         <ul class="nav navbar-nav navbar-right"> 
          <?php
if(!isset($_SESSION['Member_id']) || $_SESSION['Member_id']==""){
 ?>
   <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $strCurrentlang;?>
        <span class="caret"></span>
        <ul class="dropdown-menu">
          <li><a href="lang/thai_lang_select.php"><?php echo $strThailang;?></a></li>
          <li><a href="lang/english_lang_select.php"><?php echo $strEnglishlang;?></a></li>
        </ul>
      </a>
   </li>
 <li><a href="login_form.php"><i class="fa fa-sign-in" aria-hidden="true"></i> <?php echo $strNavbarlogin;?></a></li>
 <?php
}
else
{
  ?>
   <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $strCurrentlang;?>
        <span class="caret"></span>
        <ul class="dropdown-menu">
          <li><a href="lang/thai_lang_select.php"><?php echo $strThailang;?></a></li>
          <li><a href="lang/english_lang_select.php"><?php echo $strEnglishlang;?></a></li>
        </ul>
      </a>
   </li>
           <li class="dropdown" id="notification_dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="notification_button"><i class="fa fa-exclamation-circle" aria-hidden="true"></i><span class="badge badge-notify">0</span><span class="caret"></span></a>
        <ul class="dropdown-menu" style="min-width: 300px;" id="dispaly_notification"> 
        </ul>
      </li>
           <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $_SESSION['Member_name'];?>
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="logout.php"><?php echo $strNavbarlogout;?></a></li>
        </ul>
      </li>
        <li><a href="#"></a></li> 
    <script type="text/javascript" src="NotificationAjax.js"></script>
    <?php
}
?>
         </ul>
          <ul class="nav navbar-bar side-nav" >
                <li>
                <li class="menu_item">
                    <a href="index.php" class="dashboard"><h4><i class="fa fa-tachometer" aria-hidden="true"></i></h4><span class="menu_text"><?php echo $strDashboard;?></span></a>
                </li>
                 <li class="menu_item">
                    <a href="display_person.php" class="person"><h4><i class="fa fa-user" aria-hidden="true"></i></h4><span class="menu_text"><?php echo $strPerson;?></span></a>
                </li>
                 <li class="menu_item"> 
                    <a href="display_pill.php" class="pill"><h4><i class="fa fa-medkit" aria-hidden="true"></i></h4><span class="menu_text"><?php echo $strPill;?></span></a>
                </li>
                <li class="menu_item">
                    <a href="display_schedule.php" class="schedule"><h4><i class="fa fa-calendar" aria-hidden="true"></i></h4><span class="menu_text"><?php echo $strSchedule;?></span></a>
                </li>
                 <li class="menu_item">
                    <a href="display_slot.php" class="slot"><h4><i class="fa fa-circle" aria-hidden="true"></i></h4><span class="menu_text"><?php echo $strSlot;?></span></a>
                </li>
                 <li class="menu_item">
                    <a href="display_conversation.php" class="conversation"><h4><i class="fa fa-comments-o" aria-hidden="true"></i>
</h4><span class="menu_text"><?php echo $strConversation;?></span></a>
                </li>
                 <li class="menu_item">
                    <a href="report_behavior.php" class="report"><h4><i class="fa fa-line-chart" aria-hidden="true"></i>
</h4><span class="menu_text"><?php echo $strReport;?></span></a>
                </li>
                    <li class="menu_item">
                    <a href="report_behavior.php" class="faq"><h4><i class="fa fa-quora" aria-hidden="true"></i>
</h4><span class="menu_text"><?php echo $strFaq;?></span></a>
                </li>
            </ul>
    </div>
        <!-- Top Menu Items -->
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
      
        <!-- /.navbar-collapse -->
    </nav>