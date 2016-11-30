<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lot_condition".
 *
 * @property integer $id
 * @property string $lot_condition
 */
class LotCondition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lot_condition';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lot_condition'], 'required'],
            [['lot_condition'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lot_condition' => 'Lot Condition',
        ];
    }
    
    public static function getLotConditionID($lot_condition)
    {
		if( is_null( \app\models\LotCondition::findOne(['lot_condition'=>$lot_condition]) ) ) 
			return null;
		else 
			return \app\models\LotCondition::findOne(['lot_condition'=>$lot_condition])->id;
		
	}
	
	public static function addLotCondition($lot_condition)
	{
		
		$condition = new \app\models\LotCondition();
		$condition->lot_condition = $lot_condition;
		if($condition->save()) {
			return $condition->id;
		} else {
			return false;
		}
		
		
	}
}
