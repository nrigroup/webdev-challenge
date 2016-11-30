<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventory".
 *
 * @property integer $id
 * @property string $date
 * @property integer $category
 * @property string $lot_title
 * @property string $lot_location
 * @property integer $lot_condition
 * @property string $pre_tax_amount
 * @property integer $tax_name
 * @property string $tax_amount
 */
class Inventory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inventory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'category', 'lot_title', 'lot_location', 'lot_condition', 'tax_name'], 'required'],
            [['date'], 'safe'],
            [['category', 'lot_condition', 'tax_name'], 'integer'],
            [['pre_tax_amount', 'tax_amount'], 'number'],
            [['lot_title'], 'string', 'max' => 50],
            [['lot_location'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'category' => 'Category',
            'lot_title' => 'Lot Title',
            'lot_location' => 'Lot Location',
            'lot_condition' => 'Lot Condition',
            'pre_tax_amount' => 'Pre Tax Amount',
            'tax_name' => 'Tax Name',
            'tax_amount' => 'Tax Amount',
        ];
    }
}
