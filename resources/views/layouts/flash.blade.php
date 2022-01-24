<?php
$ses_msg = Session::has('success');
if (!empty($ses_msg)) {
    ?>
    <div class="alert alert-success alert-dismissable p-1 mt-1">
        <button type="button" class="close btn-sm" data-dismiss="alert" aria-hidden="true">x</button>
        <p><i class="fa fa-bell-o fa-fw"></i> <?php echo Session::get('success'); ?></p>
    </div>
    <?php
}// 
$ses_msg = Session::has('error');
if (!empty($ses_msg)) {
    ?>
    <div class="alert alert-danger alert-dismissable p-1 mt-1">
        <button type="button" class="close btn-sm" data-dismiss="alert" aria-hidden="true">x</button>
        <p><i class="fa fa-bell-o fa-fw"></i> <?php echo Session::get('error'); ?></p>
    </div>
<?php
}// ?>