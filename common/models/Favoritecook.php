<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "favoritecook".
 *
 * @property integer $cook_id
 * @property integer $user_id
 *
 * @property User $cook
 * @property User $user
 */
class Favoritecook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'favoritecook';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cook_id', 'user_id'], 'required'],
            [['cook_id', 'user_id'], 'integer'],
            [['cook_id', 'user_id'], 'unique', 'targetAttribute' => ['cook_id', 'user_id'], 'message' => 'The combination of Cook ID and User ID has already been taken.'],
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
            'cook_id' => 'Cook ID',
            'user_id' => 'User ID',
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
