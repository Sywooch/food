<?php

namespace common\models;

use Yii;

class Set extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'set';
    }

    public function rules()
    {
        return [
            ['product_id', 'required'],
            ['product_id', 'integer'],
            ['product_id', 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            
            ['text', 'filter', 'filter' => 'trim'],
            ['text', 'required'],
            ['text', 'string', 'max' => 255, 'skipOnEmpty' => false, 'message' => 'Необходимо ввести описание.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'text' => 'Text',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function getSetDishes()
    {
        return $this->hasMany(SetDish::className(), ['set_id' => 'product_id']);
    }
}
