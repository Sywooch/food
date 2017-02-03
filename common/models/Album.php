<?php

namespace common\models;

use Yii;

class Album extends \yii\db\ActiveRecord
{

    public $e = null;
    public $listImg = null;
    const MAX_COUNT_FOTOS = 100;

    public static function tableName()
    {
        return 'album';
    }

    public function rules()
    {
        return [
            ['user_id', 'required'],
            ['user_id', 'integer'],
            ['user_id', 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],

            ['header', 'required'],
            ['header', 'string', 'max' => 160],
            ['header', function($attribute, $params) {
                $album = self::find()->where(['header' => $this->header, 'user_id' => $this->user_id])->one();
                if ($album) {
                    $this->addError('header', 'У вас уже есть альбом с таким наименованием.');
                }
            }],

            ['foto_id', 'integer'],
            ['foto_id', 'exist', 
                'skipOnError' => true, 
                'skipOnEmpty' => true,
                'targetClass' => Foto::className(), 
                'targetAttribute' => ['foto_id' => 'id']
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Ид. альбома',
            'header' => 'Наименование',
            'user_id' => 'Ид. пользователя',
            'foto_id' => 'Ид. обложки',
        ];
    }

    public function getFoto()
    {
        return $this->hasOne(Foto::className(), ['id' => 'foto_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getFotos()
    {
        return $this->hasMany(Foto::className(), ['album_id' => 'id']);
    }

    public function getSource($file = null)
    {
        if (!$this->foto_id) {
            return null;
        }
        return $this->foto->getSource($file);
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            $this->foto_id = null;
            $this->updateAttributes(['foto_id']);
            if (count($this->fotos)) {
                // Foto::deleteAll(['album_id' => $this->id]);
                foreach ($this->fotos as $key => $foto) {
                    $foto->delete();
                }
            }
            return true;
        } else {
            return false;
        }
    }
}
