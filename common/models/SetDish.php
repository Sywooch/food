<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "set_dish".
 *
 * @property integer $set_id
 * @property integer $dish_id
 *
 * @property Dish $dish
 * @property Set $set
 */
class SetDish extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'set_dish';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['set_id', 'dish_id'], 'required'],
            [['set_id', 'dish_id'], 'integer'],
            [['dish_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dish::className(), 'targetAttribute' => ['dish_id' => 'product_id']],
            [['set_id'], 'exist', 'skipOnError' => true, 'targetClass' => Set::className(), 'targetAttribute' => ['set_id' => 'product_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'set_id' => 'Set ID',
            'dish_id' => 'Dish ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDish()
    {
        return $this->hasOne(Dish::className(), ['product_id' => 'dish_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSet()
    {
        return $this->hasOne(Set::className(), ['product_id' => 'set_id']);
    }
}
