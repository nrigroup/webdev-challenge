<?php

namespace app\controllers;
use Yii;

class InstallerController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
