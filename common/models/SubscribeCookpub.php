<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subscribe_cookpub".
 *
 * @property integer $user_id
 * @property integer $cook_id
 *
 * @property User $cook
 * @property User $user
 */
class SubscribeCookpub extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscribe_cookpub';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'cook_id'], 'required'],
            [['user_id', 'cook_id'], 'integer'],
            [['user_id', 'cook_id'], 'unique', 'targetAttribute' => ['user_id', 'cook_id'], 'message' => 'The combination of User ID and Cook ID has already been taken.'],
            [['cook_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['cook_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'cook_id' => 'Cook ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCook()
    {
        return $this->hasOne(User::className(), ['id' => 'cook_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
