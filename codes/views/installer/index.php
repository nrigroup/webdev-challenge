<?php
/* @var $this yii\web\View */
?>
<h1>Installer</h1>

<p>
    Please create a database <i><b>nriglobal</b></i> and execute the following sql commands;
    <ul>
    <?php Yii::setAlias('@sql', realpath(dirname(__FILE__).'/../../sql/')); ?>
    <li><?php echo file_get_contents(Yii::getAlias('@sql/inventory.sql')); ?></li>
    <li><?php echo file_get_contents(Yii::getAlias('@sql/categories.sql')); ?></li>
    <li><?php echo file_get_contents(Yii::getAlias('@sql/lot_condition.sql')); ?></li>
    <li><?php echo file_get_contents(Yii::getAlias('@sql/tax_name.sql')); ?></li>
    
    
    
    
    </ul>
    
</p>
