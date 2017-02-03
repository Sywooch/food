<?php
namespace common\models;

use Yii;

class Phonenumber extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'phonenumber';
    }

    public function rules()
    {
        return [
            ['user_id', 'required'],
            ['user_id', 'integer'],
            ['user_id', 'exist', 'skipOnError' => false, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],

            ['phonenumber', 'required'],
            ['phonenumber', 'filter', 'filter' => 'trim'],
            ['phonenumber', 'filter', 'filter' => function ($value) {
                $p = trim($value);
                $p = preg_replace('/[^+0-9]/','',$p);
                $p = preg_replace('/^8/','7',$p);
                $p = preg_replace('/[+]/','',$p);
                return $p;
                // return trim($value, '+');
            }],
            ['phonenumber', 'match', 'pattern' => '/^[\d]{6,16}$/'],
            ['phonenumber', 'unique'],

            ['whatsapp', 'required'],
            ['whatsapp', 'boolean'],
            ['whatsapp', 'default', 'value' => 0],

            ['viber', 'required'],
            ['viber', 'boolean'],
            ['viber', 'default', 'value' => 0],

            ['whatsappnumber', 'filter', 'filter' => 'trim'],
            ['whatsappnumber', 'filter', 'filter' => function ($value) {
                return trim($value, '+');
            }],
            ['whatsappnumber', 'match', 'pattern' => '/^[\d]{6,16}$/', 'skipOnEmpty' => false, 'when' => function($model) {
                return $model->whatsapp == true;
            }],

            ['vibernumber', 'filter', 'filter' => 'trim'],
            ['vibernumber', 'filter', 'filter' => function ($value) {
                return trim($value, '+');
            }],
            ['vibernumber', 'match', 'pattern' => '/^[\d]{6,16}$/', 'skipOnEmpty' => false, 'when' => function($model) {
                return $model->viber == true;
            }],

            ['show', 'boolean'],
            ['show', 'default', 'value' => 1],
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_id' => 'Ид. пользователя',
            'phonenumber' => 'Номер телефона',
            'whatsapp' => 'Есть Whatsapp',
            'viber' => 'Есть Viber',
            'whatsappnumber' => 'Номер Whatsapp',
            'vibernumber' => 'Номер Viber',
            'show' => 'Контакт виден для всех',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if (!$this->viber) {
            $this->vibernumber = null;
            $this->updateAttributes(['vibernumber']);
        }
        if (!$this->whatsapp) {
            $this->whatsappnumber = null;
            $this->updateAttributes(['whatsappnumber']);
        }
    }
}
