<?php
namespace frontend\models;

use common\models\User;
use common\models\Album;
use common\models\Foto;
use yii\base\Model;
use Yii;
use yii\web\UploadedFile;

class FotoForm extends Model
{
	public $text;
	public $file;
	public $album_id;

	public function rules()
	{
		return [
			['album_id', 'required'],
			['album_id', 'integer'],
			['album_id', 'exist', 'skipOnError' => true, 'targetClass' => Album::className(), 'targetAttribute' => ['album_id' => 'id']],

			['text', 'required'],
			['text', 'string', 'max' => 255],
			// ['text', 'default', 'value' => null],

			['file', 'required', 'on' => ['create']],
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
			$this->addError('file', 'Альбом не был найден');
			return null;
		}

		$foto = new Foto();
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

	public function update($foto)
	{
		$this->file = UploadedFile::getInstance($this, 'file');

		if (!$this->validate()) {
			return null;
		}

		$user = User::findOne(Yii::$app->user->identity->id);
		$album = Album::find()->where(['user_id' => $user->id, 'id' => $this->album_id])->one();

		if (!$album) {
			$this->addError('file', 'Альбом не был найден');
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
		return true;
	}

}
