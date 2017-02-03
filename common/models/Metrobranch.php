<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "metrobranch".
 *
 * @property integer $id
 * @property string $header
 *
 * @property Metrostation[] $metrostations
 */
class Metrobranch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'metrobranch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['header'], 'required'],
            [['header'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMetrostations()
    {
        return $this->hasMany(Metrostation::className(), ['branch_id' => 'id']);
    }
}
