<?php

namespace common\models;

use Yii;
use common\components\ctrait\Sid;

/**
 * This is the model class for table "dishtype".
 *
 * @property integer $id
 * @property string $sid
 * @property string $header
 */
class Dishtype extends \yii\db\ActiveRecord
{
    use Sid;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dishtype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['header'], 'required'],
            [['sid', 'header'], 'string', 'max' => 160],
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
