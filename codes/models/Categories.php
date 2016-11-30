<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $category
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category'], 'required'],
            [['category'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
        ];
    }
    
    public static function getCategoryID($category)
    {
		
		if( is_null( \app\models\Categories::findOne(['category'=>$category]) )) 
			return null;
		else 
			return \app\models\Categories::findOne(['category'=>$category])->id;
		
	}
	
	public static function addCategory($category)
	{

		$cat = new \app\models\Categories();
		$cat->category = $category;
		if($cat->save()) {
			return $cat->id;
		} else {
			return false;
		}
		
		
	}
}
