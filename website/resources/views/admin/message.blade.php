<?php if(Session::has('success')):?>
<div class="alert alert-success"><?php echo Session::get('success');?></div>
<?php elseif(Session::has('danger')):?>
<div class="alert alert-danger"><?php echo Session::get('danger');?></div>
<?php endif;?>