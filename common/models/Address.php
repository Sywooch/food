<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property string $address
 * @property integer $user_id
 *
 * @property User $user
 */
class Address extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'address';
    }

    public function rules()
    {
        return [
            ['user_id', 'required'],
            ['user_id', 'integer'],
            ['user_id', 'exist', 'skipOnError' => false, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            
            ['address', 'required'],
            ['address', 'string', 'max' => 255],

            // ['latitude', 'required'],
            ['latitude', 'string', 'max' => 255],
            ['latitude', 'default', 'value' => null],

            // ['longitude', 'required'],
            ['longitude', 'string', 'max' => 255],
            ['longitude', 'default', 'value' => null],

            ['description', 'string', 'max' => 255],
            ['description', 'default', 'value' => null],

            ['metro_id', 'integer'],
            ['metro_id', 'exist', 'targetClass' => Metrostation::className(), 'targetAttribute' => ['metro_id' => 'id']],
            ['metro_id', 'default', 'value' => null],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Ид.',
            'address' => 'Адрес',
            'user_id' => 'Ид. пользователя',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getMetrostation()
    {
        return $this->hasOne(Metrostation::className(), ['id' => 'metro_id']);
    }
}
