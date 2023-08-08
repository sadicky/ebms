<?php
$title =  $lang['invoices'];
include('Public/includes/header.php');
include('Public/includes/topbar.php');
include('Public/includes/menu.php');
?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?= WEBROOT ?>dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> <?= $title ?></a></div>
</div>
     

  <div class="container-fluid">
    <div class="quick-actions_homepage">   
      <div class="row-fluid">
      <a href="<?= WEBROOT ?>cancelled" style="margin: 10px" class="btn btn-danger pull-right"><?=$lang['cancelled']?></a>

        <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="icon-th"></i></span>
            <h5><?= $lang['customers'] ?></h5>
        </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered" id="daa-table">
              <thead>
                <tr>
                  <th><?= $lang['ninvoice'] ?></th>
                  <th><?= $lang['date'] ?></th>
                  <th><?= $lang['customer_name'] ?></th>
                  <th><?= $lang['total'] ?></th>
                  <th><?= $lang['vat_customer_payer'] ?></th>
                  <th><?= $lang['add by'] ?></th>
                  <th><?= $lang['see'] ?></th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php  foreach ($getInvoice as $data) : ?>
                  <tr>
                    <td><?= $data->invoice_number ?></td>
                    <td><b><?= $data->invoice_date ?></b></td>
                    <td><b><?= $data->customer_name ?></b></td>
                    <td><?= $data->order_total_after_tax ?></td>
                    <td><?php $ass=$lang['yes'];
                if($data->vat_customer_payer==0) echo $lang['no'];
                else echo $ass;?></td>
                    <td><?= $data->nom ?></td>
                    <td><a id="<?= $data->invoice_number ?>" class="btn btn-mini btn-block view_data"><i class="icon-list"></i><?= $lang['invoice'] ?></a></td>
                    <td><a  class="btn btn-mini btn-block edit"><i class="icon-edit"></i></a></td>
                  </tr>
                <?php  endforeach; ?>
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
include('Public/Modal/pdf.php');
include('Public/includes/footer.php');
?>

<script type="text/javascript" src="Public/JS/invoice.js"></script>
