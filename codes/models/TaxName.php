<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tax_name".
 *
 * @property integer $id
 * @property string $tax_name
 */
class TaxName extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tax_name';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tax_name'], 'required'],
            [['tax_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tax_name' => 'Tax Name',
        ];
    }
    
    public static function getTaxNameID($tax_name)
    {
		if( is_null( \app\models\TaxName::findOne(['tax_name'=>$tax_name]) ) ) 
			return null;
		else 
			return \app\models\TaxName::findOne(['tax_name'=>$tax_name])->id;
		
	}
	
	public static function addTaxName($tax_name)
	{
		
		$name = new \app\models\TaxName();
		$name->tax_name = $tax_name;
		if($name->save()) {
			return $name->id;
		} else {
			return false;
		}
		
		
	}
}
