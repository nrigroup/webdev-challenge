<?php
/* @var $this yii\web\View */
?>
<h1>Upload file</h1>



<div style="border: 1px solid #cccccc; margin: 10px; padding: 20px">
<p>
	
<?php
use yii\widgets\ActiveForm;
?>

<?php if( isset($model) ) : ?>



<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'uploadFile')->fileInput() ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>


<?php else: ?>

<?php 
if(isset($error['notsaved'])) { 
	echo "The following are not saved:<br>";
	foreach(@$error['notsaved'] as $item) {
		echo "\n<br>$item";
	}
} else {
	echo "\nEverything is saved";
	
	echo $this->render('_stat_per_category',['dataProviderCategory'=>$dataProviderCategory]); 
   echo $this->render('_stat_per_month',['dataProviderMonth'=>$dataProviderMonth]); 

} ?>

<?php endif; ?>

</p>
</div>
