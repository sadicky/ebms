<div class="modal hide" id="modal-add">
    <div class="modal-header modal-lg">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3><?= $lang['add user'] ?></h3>
    </div>
    <form method="GET" enctype="multipart/form-data" id="formulaire">
        <div class="modal-body">
            <div class="row-fluid"> 
                <div class="span6">                    
                    <div class="control-group">
                        <label class="control-label"><?= $lang['customer_TIN'] ?></label>
                        <div class="controls">
                            <input type="text" placeholder="<?= $lang['customer_TIN'] ?>" class="customer_TIN" id="customer_TIN" onBlur="check()" name="customer_TIN">
                            <div id="nif_status"></div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label"><?= $lang['customer_address'] ?></label>
                        <div class="controls">
                            <input type="text" placeholder="<?= $lang['customer_address'] ?>" id="customer_address" name="customer_address">
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="control-group">
                        <label class="control-label"><?= $lang['customer_name'] ?></label>
                         <div class="controls">
                            <input type="text" placeholder="<?= $lang['customer_name'] ?>" id="customer_name" name="customer_name">
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label"><?= $lang['vat_customer_payer'] ?></label>
                        <div class="controls"> 
                           <select id="vat_customer_payer" name="vat_customer_payer">
                               <option value="0"><?= $lang['no'] ?></option>
                               <option value="1"><?= $lang['yes'] ?></option>
                           </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal"><?= $lang['cancelled'] ?></a>
            <button type="submit" id="submit" class="btn btn-primary submit"><?= $lang['add customer'] ?></button>
        </div>
    </form>
</div>