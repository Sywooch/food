<?php
namespace frontend\models;

use common\models\User;
use common\models\Album;
use common\models\Foto;
use yii\base\Model;
use Yii;

use yii\web\UploadedFile;

class AlbumForm extends Model
{
    public $header;
    public $text;
    public $fotos;
    public $user_id;

    public function rules()
    {
        return [
            ['header', 'required'],
            ['header', 'string', 'max' => 255],
            ['header', function($attribute, $params) {
                $album = Album::find()->where(['header' => $this->header, 'user_id' => $this->user_id])->one();
                if ($album) {
                    $this->addError('header', 'У вас уже есть альбом с таким наименованием.');
                }
            }],

            ['user_id', 'required'],
            ['user_id', 'integer'],
            ['user_id', 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],

            ['text', 'required'],
            ['text', 'string', 'max' => 255],
            ['text', 'default', 'value' => null],

            ['fotos', 'each', 'rule' => ['file', 
                'message' => 'dasfdsadg',
                'skipOnEmpty' => true,
                'extensions' => 'png, jpg, jpeg',
                // 'maxFiles' => 20,
                'maxSize' => 9*1024*1024, 
                'mimeTypes' => 'image/jpeg, image/png',
            ]],
        ];
    }

    public function attributeLabels()
    {
        return [
            'header' => 'Наименование',
            'text' => 'Описание',
        ];
    }


    public function valid()
    {
        $user = User::findOne(Yii::$app->user->identity->id);
        $this->fotos = UploadedFile::getInstances($this, 'fotos');
        $this->user_id = $user->id;

        if (!$this->validate()) {
            return null;
        }

        $album = new Album();
        $album->header = $this->header;
        $album->user_id = $user->id;
        if ($album->validate()) {
            $album->save();
        } else {
            if (isset($album->errors)) {
                foreach ($album->errors as $errors) {
                    foreach ($errors as $errorText) {
                        $this->addError('header', $errorText);
                    }
                }
            }
            return null;
        }

        // Добавление фотографий к альбому 
        if ($this->fotos) {
            $count = $album->getFotos()->count();
            foreach ($this->fotos as $key => $fk) {
                if ( $key + $count > Album::MAX_COUNT_FOTOS ) {
                    $this->addError('fotos', 'Максимальное количество фотографий в альбоме не должно быть больше 100.');
                    return null;
                }
                $foto = new Foto();
                $foto->album_id = $album->id;
                $foto->file = $fk;
                if ($foto->validate()) {
                    $foto->save();
                    if ($key === 0) {
                        $album->foto_id = $foto->id;
                        $album->updateAttributes(['foto_id']);
                    }
                } else {
                    if (isset($foto->errors)) {
                        foreach ($foto->errors as $errors) {
                            foreach ($errors as $errorText) {
                                $this->addError('fotos', $errorText);
                            }
                        }
                    }
                    return null;
                }
            }
        }

        return $album;
    }
}
