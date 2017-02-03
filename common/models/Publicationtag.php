<?php

namespace common\models;

use Yii;

class Publicationtag extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'publicationtag';
    }

    public function rules()
    {
        return [
            ['header', 'required'],
            ['header', 'unique'],
            ['header', 'string', 'max' => 160],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'header' => 'Header',
        ];
    }

    public function getPublicationPublicationtags()
    {
        return $this->hasMany(PublicationPublicationtag::className(), ['publicationtag_id' => 'id']);
    }
}
