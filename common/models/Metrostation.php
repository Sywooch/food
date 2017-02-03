<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "metrostation".
 *
 * @property integer $id
 * @property integer $branch_id
 * @property string $header
 *
 * @property Address[] $addresses
 * @property Metrobranch $branch
 */
class Metrostation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'metrostation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_id', 'header'], 'required'],
            [['branch_id'], 'integer'],
            [['header'], 'string', 'max' => 255],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Metrobranch::className(), 'targetAttribute' => ['branch_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'branch_id' => 'Branch ID',
            'header' => 'Header',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['metro_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Metrobranch::className(), ['id' => 'branch_id']);
    }
}
