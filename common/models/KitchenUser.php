<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kitchen_user".
 *
 * @property integer $kitchen_id
 * @property integer $user_id
 *
 * @property Kitchen $kitchen
 * @property User $user
 */
class KitchenUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kitchen_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['user_id', 'required'],
            ['user_id', 'integer'],
            ['user_id', 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],

            ['kitchen_id', 'required'],
            ['kitchen_id', 'integer'],
            ['kitchen_id', 'exist', 'skipOnError' => true, 'targetClass' => Kitchen::className(), 'targetAttribute' => ['kitchen_id' => 'id']],

            [['kitchen_id', 'user_id'], 'unique', 'targetAttribute' => ['kitchen_id', 'user_id'], 'message' => 'The combination of Kitchen ID and User ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kitchen_id' => 'Kitchen ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKitchen()
    {
        return $this->hasOne(Kitchen::className(), ['id' => 'kitchen_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
