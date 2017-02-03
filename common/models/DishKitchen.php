<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dish_kitchen".
 *
 * @property integer $dish_id
 * @property integer $kitchen_id
 *
 * @property Dish $dish
 * @property Kitchen $kitchen
 */
class DishKitchen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dish_kitchen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dish_id', 'kitchen_id'], 'required'],
            [['dish_id', 'kitchen_id'], 'integer'],
            [['dish_id', 'kitchen_id'], 'unique', 'targetAttribute' => ['dish_id', 'kitchen_id'], 'message' => 'The combination of Dish ID and Kitchen ID has already been taken.'],
            [['dish_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dish::className(), 'targetAttribute' => ['dish_id' => 'product_id']],
            [['kitchen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kitchen::className(), 'targetAttribute' => ['kitchen_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dish_id' => 'Dish ID',
            'kitchen_id' => 'Kitchen ID',
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
    public function getKitchen()
    {
        return $this->hasOne(Kitchen::className(), ['id' => 'kitchen_id']);
    }
}
