<?php
$title =  $lang['customer'];
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
        <div class="message"></div>
        <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="icon-th"></i></span>
            <h5><?= $lang['customers'] ?></h5>
            <a data-toggle="modal" href="#modal-add" class="btn btn-primary pull-right btn-mini"><i class="icon-plus icon-white"></i> <?= $lang['add customer'] ?></a>

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered" id="daa-table">
              <thead>
                <tr>
                  <th><?= $lang['ninvoice'] ?></th>
                  <th><?= $lang['customer_name'] ?></th>
                  <th><?= $lang['customer_TIN'] ?></th>
                  <th><?= $lang['customer_address'] ?></th>
                  <th><?= $lang['vat_customer_payer'] ?></th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php $cnt = 1;
                foreach ($getCustomer as $data) : ?>
                  <tr>
                    <td><?= $cnt ?></td>
                    <td><b><?= $data->customer_name ?></b></td>
                    <td><b><?= $data->customer_TIN ?></b></td>
                    <td><?= $data->customer_address ?></td>
                    <td><?php if ($data->vat_customer_payer == 0) echo $lang['no'];
                        else echo $lang['yes']; ?></td>
                    <td><a href="#" class="tip-top" data-original-title="Update">
                        <i class="icon-edit"></i></a>
                      <a href="#" class="tip-top" data-original-title="Delete">
                        <i class="icon-remove"></i></a>
                    </td>
                  </tr>
                <?php $cnt++;
                endforeach; ?>
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
include('Public/Modal/addcust.php');
include('Public/includes/footer.php');
?>

<script type="text/javascript" src="Public/JS/customer.js"></script>
