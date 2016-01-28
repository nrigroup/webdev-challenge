<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Inventory */
/* @var $form ActiveForm */
?>
<div class="upload">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'date') ?>
        <?= $form->field($model, 'category') ?>
        <?= $form->field($model, 'lot_title') ?>
        <?= $form->field($model, 'lot_location') ?>
        <?= $form->field($model, 'lot_condition') ?>
        <?= $form->field($model, 'tax_name') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- _upload -->
