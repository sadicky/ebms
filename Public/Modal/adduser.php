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
                        <label class="control-label"><?= $lang['name'] ?></label>
                         <div class="controls">
                            <input type="text" placeholder="<?= $lang['name'] ?>" id="nom" name="nom">
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label"><?= $lang['tel'] ?></label>
                        <div class="controls">
                            <input type="text" placeholder="<?= $lang['tel'] ?>" id="tel" name="tel">
                        </div>
                    </div>
                </div>

                <div class="span6">
                    <div class="control-group">
                        <label class="control-label"><?= $lang['prename'] ?></label>
                        <div class="controls">
                            <input type="text" placeholder="<?= $lang['prename'] ?>" id="prenom" name="prenom">
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label"><?= $lang['email'] ?></label>
                        <div class="controls"> 
                            <input type="hidden" id="password" value="123456" name="password">
                           <input type="email" placeholder="<?= $lang['email'] ?>" id="email" name="email">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal"><?= $lang['cancelled'] ?></a>
            <button type="submit" class="btn btn-primary submit"><?= $lang['add user'] ?></button>
        </div>
    </form>
</div>