<?php
$title =  $lang['Settings'];
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
               <div class="span7">
                    <div class="widget-box">
                        <div class="widget-title">
                            <span class="icon">
                                <i class="icon-eye-open"></i>
                            </span>
                            <h5>COMPANY'S DATA</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>NIF</th>
                                        <th>Modifier</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php foreach($getSoc as $data):?>
                                    <tr>
                                        <td><?=$data->tp_name?></td>
                                        <td><b><?=$data->tp_TIN?></b></td>	
                                        <td class="taskOptions"><a href="#" class="tip-top" data-original-title="Update">
                                            <i class="icon-edit"></i></a>
                                        </td>
                                    </tr>
                                 <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="span5">
                    <div class="widget-box">
                        <div class="widget-title">
                            <span class="icon">
                                <i class="icon-eye-open"></i>
                            </span>
                            <h5>INTERCONNEXION DATA</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>url</th>
                                        <th>username</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php foreach($getI as $data):?>
                                    <tr>
                                        <td><?=$data->con_url?></td>
                                        <td><b><?=$data->con_username?></b></td>
                                    </tr>
                                 <?php endforeach;?>
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
include('Public/includes/footer.php');
?>