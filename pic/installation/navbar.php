<nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#" style="font-family: 'Mitr', sans-serif;font-size: 25px; color:#000000;"><?php echo $strInstallNavbarbrand ;?></a>
    </div>
     <ul class="nav navbar-nav navbar-right"> 
     	   <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $strCurrentlang;?>
        <span class="caret"></span>
        <ul class="dropdown-menu">
          <li><a href="../lang/thai_lang_select.php"><?php echo $strThailang;?></a></li>
          <li><a href="../lang/english_lang_select.php"><?php echo $strEnglishlang;?></a></li>
        </ul>
      </a>
   </li>
    </ul>
  </div>
</nav>