<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notice".
 *
 * @property integer $id
 * @property string $text
 * @property integer $user_id
 * @property string $created_at
 * @property integer $author_id
 * @property integer $read
 *
 * @property User $author
 * @property User $user
 */
class Notice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'user_id'], 'required'],
            [['text'], 'string'],
            [['user_id', 'author_id', 'read'], 'integer'],
            [['created_at'], 'safe'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'author_id' => 'Author ID',
            'read' => 'Read',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
