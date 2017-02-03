<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mainpage".
 *
 * @property integer $id
 * @property string $header
 * @property string $src
 * @property string $text
 */
class Mainpage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mainpage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['header', 'src'], 'required'],
            [['header', 'text'], 'string'],
            [['src'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'header' => 'Header',
            'src' => 'Src',
            'text' => 'Text',
        ];
    }
}
