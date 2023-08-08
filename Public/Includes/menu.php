<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a><ul>
    <li class="active"><a href="<?=WEBROOT?>dashboard"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li> <a href="<?=WEBROOT?>addInvoice"><i class="icon icon-plus"></i> <span> <?=$lang['add Invoice']?></span></a> </li>
    <li> <a href="<?=WEBROOT?>invoices"><i class="icon icon-list-alt"></i> <span><?=$lang['invoices']?></span></a> </li>
    <li><a href="<?=WEBROOT?>search"><i class="icon icon-search"></i> <span><?=$lang['search']?></span></a></li>
    <li><a href="<?=WEBROOT?>clients"><i class="icon icon-user"></i> <span><?=$lang['customer']?></span></a></li>
    <div class="pull-right" style="color: white; padding:10px;" ><span class="label label-inverse"><b><?php echo $lang['user'].' : '. $_SESSION['nom'].' '.$_SESSION['prenom'];?></b></span></div>
  </ul>
</div>