
<!--Header-part-->
<div id="header">
  <h2><a style="color:white; font-size:30px;padding-left:20px;" href="<?=WEBROOT?>dashboard">SpaceInvoice 2.0</a></h2>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class="" ><a href="<?=WEBROOT?>profile"><i class="icon icon-user"></i> <span class="text">Profile</span></a></li>
    <li class=" dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-globe"></i> <span class="text"> <?=$lang['language']?></span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a class="sAdd" title="" href="dashboard?Lang=fr">Français</a></li>
        <li><a class="sInbox" title="" href="dashboard?Lang=en">English</a></li>
      </ul>
    </li>
    <li class=""><a title="Settings" href="<?=WEBROOT?>settings"><i class="icon icon-cog"></i> <span class="text"> <?=$lang['Settings']?></span></a></li>
    <li class=""><a title="Logout" href="<?=WEBROOT?>logout"><i class="icon icon-share-alt"></i> <span class="text"> <?=$lang['logout']?></span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->

