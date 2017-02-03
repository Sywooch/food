<?php

namespace common\models;

use Yii;
use common\components\ctrait\Sid;

/**
 * This is the model class for table "news_tag".
 *
 * @property integer $id
 * @property string $sid
 * @property string $header
 *
 * @property NewsNewstag[] $newsNewstags
 * @property News[] $news
 */
class NewsTag extends \yii\db\ActiveRecord
{
    use Sid;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['header'], 'required'],
            [['sid', 'header'], 'string', 'max' => 45],
            [['sid'], 'unique'],
            [['header'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Ид.',
            'sid' => 'Строковый ид.',
            'header' => 'Наименование',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsNewstags()
    {
        return $this->hasMany(NewsNewstag::className(), ['newstag_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['id' => 'news_id'])->viaTable('news_newstag', ['newstag_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->sid = self::sid($this->sid,$this->header);
            if ($this->sid === '') {
                $this->addError('sid', 'Строковый идентификатор не смог создасться из заголовка, измените заголовок.');
                return false;
            }
            return true;
        } else {
            return false;
        }
    }
}
