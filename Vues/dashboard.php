
<?php 
$title =  $lang['Dashboard'];
include ('Public/includes/header.php');
include ('Public/includes/topbar.php');
include ('Public/includes/menu.php');
?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=WEBROOT?>dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> <?=$title?></a></div>
  </div>

  <div class="container-fluid">
   	<div class="quick-actions_homepage">
    <div class="row-fluid">
      
    <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>Invoice sent</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered" id="data-table">
              <thead>
                <tr>
                  <th><?=$lang['ninvoice']?></th>
                  <th><?=$lang['date']?></th>
                  <th><?=$lang['customer']?></th>
                  <th><?=$lang['total']?></th>
                  <th><?=$lang['see']?></th>
                  <th><?=$lang['cancelled']?></th>
                  <th><?=$lang['edit']?></th>
                </tr>
              </thead>
              <tbody>
                <tr class="gradeX">
                  <td class="center">4</td>
                  <td class="center">02-09-2023</td>
                  <td class="center">Icare Solutions</td>
                  <td class="center">50000</td>
                  <td class="center">4</td>
                  <td class="center">4</td>
                  <td class="center">4</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
</div>
</div>
</div>


<?php 
include ('Public/includes/footer.php');
?>