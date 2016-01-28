<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $uploadFile;

    public function rules()
    {
        return [
            [['uploadFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'csv'],
        ];
    }
    
    public function upload()
    {
		
		$this->uploadFile->saveAs(Yii::$app->params['fileUploadPath'] . $this->uploadFile->baseName . '.' . $this->uploadFile->extension);
        return true;
        
    }
}
