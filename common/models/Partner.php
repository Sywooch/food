<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partner".
 *
 * @property integer $id
 * @property string $header
 * @property string $href
 * @property string $iconsrc
 * @property integer $show
 */
class Partner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['header', 'href'], 'required'],
            [['show'], 'integer'],
            [['header', 'href', 'iconsrc'], 'string', 'max' => 255],
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
            'href' => 'Href',
            'iconsrc' => 'Iconsrc',
            'show' => 'Show',
        ];
    }
}
