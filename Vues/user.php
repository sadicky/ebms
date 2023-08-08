<?php
$title =  $lang['user'];
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
               <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title">
                            <span class="icon">
                                <i class="icon-eye-open"></i>
                            </span>
                            <h5><?=$lang['users']?></h5>
                            <a data-toggle="modal" href="#modal-add" class="btn btn-primary pull-right btn-mini"><i class="icon-plus icon-white"></i> <?=$lang['add user']?></a>
									
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php $cnt=1; foreach($getUser as $data):?>
                                    <tr>
                                        <td><?=$cnt?></td>
                                        <td><?=$data->nom?></td>
                                        <td><?=$data->prenom?></td>
                                        <td><b><?=$data->email?></b></td>
                                        <td><?=$data->tel?></td>	
                                        <td ><a href="#" class="tip-top" data-original-title="Update">
                                            <i class="icon-edit"></i></a>
                                            <a href="#" class="tip-top" data-original-title="Delete">
                                            <i class="icon-remove"></i></a>
                                        </td>
                                    </tr>
                                 <?php $cnt++; endforeach;?>
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
include('Public/Modal/adduser.php');
include('Public/includes/footer.php');
?>

<script type="text/javascript" src="Public/JS/user.js"></script>
