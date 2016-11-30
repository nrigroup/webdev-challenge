<h2>Inventory per month</h2>
<?php

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Inventory;


echo GridView::widget([
    'dataProvider' => $dataProviderMonth,
]);


?>


