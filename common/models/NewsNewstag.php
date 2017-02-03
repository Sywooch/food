<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "news_newstag".
 *
 * @property integer $news_id
 * @property integer $newstag_id
 *
 * @property News $news
 * @property NewsTag $newstag
 */
class NewsNewstag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news_newstag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_id', 'newstag_id'], 'required'],
            [['news_id', 'newstag_id'], 'integer'],
            [['news_id', 'newstag_id'], 'unique', 'targetAttribute' => ['news_id', 'newstag_id'], 'message' => 'The combination of News ID and Newstag ID has already been taken.'],
            [['news_id'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['news_id' => 'id']],
            [['newstag_id'], 'exist', 'skipOnError' => true, 'targetClass' => NewsTag::className(), 'targetAttribute' => ['newstag_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'news_id' => 'News ID',
            'newstag_id' => 'Newstag ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasOne(News::className(), ['id' => 'news_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewstag()
    {
        return $this->hasOne(NewsTag::className(), ['id' => 'newstag_id']);
    }
}
