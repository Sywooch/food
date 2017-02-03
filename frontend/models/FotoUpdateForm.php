<?php
namespace frontend\models;

use common\models\User;
use common\models\Album;
use common\models\Foto;
use yii\base\Model;
use Yii;
use yii\web\UploadedFile;

class FotoUpdateForm extends Model
{
	public $id;
	public $text;
	public $file;
	public $album_id;

	public function rules()
	{
		return [
			['id', 'required'],
			['id', 'integer'],
			['id', 'exist', 'skipOnError' => true, 'targetClass' => Foto::className(), 'targetAttribute' => ['album_id' => 'id']],

			['album_id', 'required'],
			['album_id', 'integer'],
			['album_id', 'exist', 'skipOnError' => true, 'targetClass' => Album::className(), 'targetAttribute' => ['album_id' => 'id']],

			['text', 'required'],
			['text', 'string', 'max' => 255],
			// ['text', 'default', 'value' => null],

			['file', 'required'],
			['file', 'file', 
				// 'message' => 'dasfdsadg',
				'skipOnEmpty' => true,
				'extensions' => 'png, jpg, jpeg',
				'maxSize' => 9*1024*1024, 
				'mimeTypes' => 'image/jpeg, image/png',
			],
		];
	}

	public function attributeLabels()
	{
		return [
			'text' => 'Описание фотографии',
		];
	}


	public function valid()
	{
		$this->file = UploadedFile::getInstance($this, 'file');

		if (!$this->validate()) {
			return null;
		}

		$user = User::findOne(Yii::$app->user->identity->id);

		$album = Album::find()->where(['user_id' => $user->id, 'id' => $this->album_id])->one();
		if (!$album) {
			throw new NotFoundHttpException("Альбом не найден.");
			// $this->addError('file', 'Альбом не найден.');
			return null;
		}

		$foto = Album::find()->where(['album_id' => $album->id, 'id' => $this->id])->one();
		if (!$foto) {
			throw new NotFoundHttpException("Фото не найдено.");
			// $this->addError('model', 'Фото не найдено.');
			return null;
		}
		$foto->text = $this->text;
		$foto->album_id = $album->id;
		$foto->file = $this->file;
		if ($foto->validate()) {
			$foto->save();
			if ($album->getFotos()->count() == 1) {
                $album->foto_id = $foto->id;
                $album->updateAttributes(['foto_id']);
			}
		} else {
			if (isset($foto->errors)) {
				foreach ($foto->errors as $errors) {
					foreach ($errors as $errorText) {
						$this->addError('model', $errorText);
					}
				}
			}
			return null;
		}

		return $foto;
	}
}
