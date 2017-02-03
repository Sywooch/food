<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "recall".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $cook_id
 * @property string $text
 * @property string $created_at
 *
 * @property User $cook
 * @property User $user
 */
class Recall extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recall';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'cook_id', 'text'], 'required'],
            [['user_id', 'cook_id'], 'integer'],
            [['text'], 'string'],
            [['created_at'], 'safe'],
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
            'id' => 'Ид.',
            'created_at' => 'Создан',
            'user_id' => 'Ид. пользователя',
            'cook_id' => 'Ид. повара',
            'text' => 'Отзыв',
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
