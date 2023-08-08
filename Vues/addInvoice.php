<?php
$title =  $lang['add Invoice'];
include('Public/includes/header.php');
include('Public/includes/topbar.php');
include('Public/includes/menu.php');
?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?= WEBROOT ?>dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> <?= $title ?></a></div>
  </div>

  <div class="container-fluid">
    <div class="quick">
      <div class="row-fluid">

        <div class="message"></div>


        <form method="POST" enctype="multipart/form-data" id="invoice_forms">
          <table class="table table-bordered card">
            <tr>
              <td colspan="2">
                <div class="row-fluid">
                  <div class="span3">
                    <div class="control-group">
                      <label class="control-label"><?= $lang['customer'] ?></label>
                      <div class="controls">
                        <select class="select customer_name" name="customer_names" id="customer_names">
                          <option value="1">Choisir un client</option>
                          <?php foreach ($getCustomer as $value) : ?>
                            <option value="<?= $value->customer_id ?>"><?= $value->customer_name ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="span3">
                    <div class="control-group">
                      <label class="control-label"><?= $lang['ninvoice'] ?></label>
                      <input type="text" name="invoice_numbers" id="invoice_numbers" value="0" class="form-control input-sm number_only" readonly placeholder="Numéro Facture" />
                    </div>
                  </div>
                  <div class="span3">
                    <div class="control-group">
                      <label class="control-label"><?= $lang['date'] ?></label>
                      <input type="hidden" value="<?=$_SESSION['iduser']?>" id="user" name="user"> 
                      <input type="text" name="invoice_dates" id="invoice_dates" value="<?= date('Y-m-d') ?>" class="form-control input-sm" readonly placeholder="Selectioner la date" />
                    </div>
                  </div>
                  <div class="span3">
                    <div class="control-group">
                      <label class="control-label"><?= $lang['mode'] ?></label>
                      <select name="payment_type" id="payment_type" class="select">
                        <option value=""><?= $lang['mode'] ?></option>
                        <option value="1"><?=$lang['cash']?></option>
                        <option value="2"><?=$lang['bank']?></option>
                        <option value="3"><?=$lang['accountant']?></option>
                        <option value="4"><?=$lang['others']?></option>
                      </select>
                    </div>
                  </div>
                </div>
                <br />
                <table id="invoice-item-table" class="table table-bordered table-hover table-striped">
                  <tr>
                    <th width="5%">S/N.</th>
                    <th width="20%">Designation</th>
                    <th width="10%">Quantite</th>
                    <th width="10%">Prix unitaire</th>
                    <th width="10%">Total HTVA</th>
                    <th width="12.5%" rowspan="2">TVA</th>
                    <th width="3%" rowspan="2"></th>
                  </tr>
                  <tr>
                  </tr>
                  <tr>
                    <td><span id="sr_no">1</span></td>
                    <td><input type="text" name="item_names[]" id="item_names1" class="form-control input-sm" /></td>
                    <td><input type="text" name="order_item_quantitys[]" id="order_item_quantitys1" data-srno="1" class="form-control input-sm order_item_quantitys" /></td>
                    <td><input type="text" name="order_item_prices[]" id="order_item_prices1" data-srno="1" class="form-control input-sm number_only order_item_prices" /></td>
                    <input type="hidden" name="order_item_tax1_rates[]" value="18" id="order_item_tax1_rates1" data-srno="1" class="form-control input-sm number_only order_item_tax1_rates" />
                    <input type="hidden" name="order_item_final_amounts[]" id="order_item_final_amounts1" data-srno="1" readonly class="form-control input-sm order_item_final_amounts" />

                    <td><input type="text" name="order_item_actual_amounts[]" id="order_item_actual_amounts1" data-srno="1" class="form-control input-sm order_item_actual_amounts" readonly /></td>
                    <td> <input type="text" name="order_item_tax1_amounts[]" id="order_item_tax1_amounts1" data-srno="1" readonly class="form-control input-sm order_item_tax1_amounts" /></td>
                    <td></td>
                  </tr>
                </table>
                <div align="right">
                  <button type="button" name="add_rows" id="add_rows" class="btn btn-success">+</button>
                </div>
              </td>
            </tr>
            <tr>
              <td align="right"><b>Total TTC</b></td>
              <td align="right"><b><span id="final_total_amts"></span> Fbu</b></td>
            </tr>
            <tr>
              <td colspan="2" align="left">
            </tr>
            <tr>
              <td colspan="2" align="center">
                <input type="hidden" name="total_items" id="total_items" value="1" />
                <input type="submit" name="create_invoices" id="create_invoices" class="btn btn-primary" value="Send to Obr's server" />
              </td>
            </tr>
          </table>
      </div>
      </form>

      

    </div>
  </div>
</div>
</div>
</div>

<?php
include('Public/includes/footer.php');
?>

<script>
        $(document).ready(function() {
          var final_total_amt = $('#final_total_amts').text();
          var count = 1;

          $(document).on('click', '#add_rows', function() {
            count++;
            $('#total_items').val(count);
            var html_code = '';
            html_code += '<tr id="row_ids_' + count + '">';
            html_code += '<td><span id="sr_no">' + count + '</span></td>';

            html_code += '<td><input type="text" name="item_names[]" id="item_names' + count + '" class="form-control input-sm" /></td>';

            html_code += '<td><input type="text" name="order_item_quantitys[]" id="order_item_quantitys' + count + '" data-srno="' + count + '" class="form-control input-sm number_only order_item_quantitys" /></td>';
            html_code += '<td><input type="text" name="order_item_prices[]" id="order_item_prices' + count + '" data-srno="' + count + '" class="form-control input-sm number_only order_item_prices" /></td>';
            html_code += '<td><input type="text" name="order_item_actual_amounts[]" id="order_item_actual_amounts' + count + '" data-srno="' + count + '" class="form-control input-sm order_item_actual_amounts" readonly /></td>';

            html_code += '<input type="hidden" name="order_item_tax1_rates[]" value="18" id="order_item_tax1_rates' + count + '" data-srno="' + count + '" class="form-control input-sm number_only order_item_tax1_rates" />';
            html_code += '<input type="hidden" name="order_item_final_amounts[]" id="order_item_final_amounts' + count + '" data-srno="' + count + '" readonly class="form-control input-sm order_item_final_amounts" />';

            html_code += '<td><input type="text" name="order_item_tax1_amounts[]" id="order_item_tax1_amounts' + count + '" data-srno="' + count + '" readonly class="form-control input-sm order_item_tax1_amounts" /></td>';
            html_code += '<td><button type="button" name="remove_rows" id="' + count + '" class="btn btn-danger btn-xs remove_rows">X</button></td>';
            html_code += '</tr>';
            $('#invoice-item-table').append(html_code);
          });

          $(document).on('click', '.remove_rows', function() {
            var row_id = $(this).attr("id");
            var total_item_amount = $('#order_item_final_amounts' + row_id).val();
            var final_amount = $('#final_total_amts').text();
            var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
            $('#final_total_amts').text(result_amount);
            $('#row_ids_' + row_id).remove();
            count--;
            $('#total_items').val(count);
          });

          function cal_final_total(count) {
            var final_item_total = 0;
            for (j = 1; j <= count; j++) {
              var quantity = 0;
              var price = 0;
              var actual_amount = 0;
              var tax1_rate = 0;
              var tax1_amount = 0;
              var tax2_rate = 0;
              var tax2_amount = 0;
              var tax3_rate = 0;
              var tax3_amount = 0;
              var item_total = 0;
              quantity = $('#order_item_quantitys' + j).val();
              if (quantity > 0) {
                price = $('#order_item_prices' + j).val();
                if (price > 0) {
                  actual_amount = parseFloat(quantity) * parseFloat(price);
                  $('#order_item_actual_amounts' + j).val(actual_amount);
                  tax1_rate = $('#order_item_tax1_rates' + j).val();
                  if (tax1_rate > 0) {
                    tax1_amount = parseFloat(actual_amount) * parseFloat(tax1_rate) / 100;
                    $('#order_item_tax1_amounts' + j).val(tax1_amount);
                  }
                  tax2_rate = $('#order_item_tax2_rates' + j).val();
                  if (tax2_rate > 0) {
                    tax2_amount = parseFloat(actual_amount) * parseFloat(tax2_rate) / 100;
                    $('#order_item_tax2_amounts' + j).val(tax2_amount);
                  }
                  tax3_rate = $('#order_item_tax3_rates' + j).val();
                  if (tax3_rate > 0) {
                    tax3_amount = parseFloat(actual_amount) * parseFloat(tax3_rate) / 100;
                    $('#order_item_tax3_amounts' + j).val(tax3_amount);
                  }
                  item_total = parseFloat(actual_amount) + parseFloat(tax1_amount) + parseFloat(tax2_amount) + parseFloat(tax3_amount);
                  final_item_total = parseFloat(final_item_total) + parseFloat(item_total);
                  $('#order_item_final_amounts' + j).val(item_total);
                }
              }
            }
            $('#final_total_amts').text(final_item_total);
          }

          $(document).on('blur', '.order_item_prices', function() {
            cal_final_total(count);
          });

          $(document).on('blur', '.order_item_tax1_rates', function() {
            cal_final_total(count);
          });

          $('#create_invoices').click(function() {
            for (var no = 1; no <= count; no++) {
              if ($.trim($('#item_names' + no).val()).length == 0) {
                alert("SVP, entrez la désignation de l'article");
                $('#item_names' + no).focus();
                return false;
              }

              if ($.trim($('#order_item_quantitys' + no).val()).length == 0) {
                alert("SVP, entrez la Quantité");
                $('#order_item_quantitys' + no).focus();
                return false;
              }

              if ($.trim($('#order_item_prices' + no).val()).length == 0) {
                alert("SVP, entrez le Prix unitaire");
                $('#order_item_prices' + no).focus();
                return false;
              }

            }

            $('#invoice_forms').submit();

          });
        });

        $(document).ready(function() {
          $('.number_only').keypress(function(e) {
            return isNumbers(e, this);
          });

          function isNumbers(evt, element) {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if (
              (charCode != 46 || $(element).val().indexOf('.') != -1) && // “.” CHECK DOT, AND ONLY ONE.
              (charCode < 48 || charCode > 57))
              return false;
            return true;
          }
        });
      </script>

<script type="text/javascript" src="Public/JS/invoice.js"></script>