<?php

namespace common\models;

use Yii;
use common\components\ctrait\Sid;
use common\components\ctrait\Path;

use yii\base\ErrorException;

use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use Imagine\Image\ImageInterface;

class Publication extends \yii\db\ActiveRecord
{
	use Sid;
    use Path;

    const PATH = 'upload/publication/';

    public $file;
	public $shorttext;

	const SCENARIO_CREATE = 'create';
	const SCENARIO_UPDATE = 'update';

	public static function tableName()
	{
		return 'publication';
	}

	public function rules()
	{
		return [
			['user_id', 'required'],
			['user_id', 'integer'],
			['user_id', 'exist', 'skipOnError' => false, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],

			['header', 'required'],
			['header', 'string', 'max' => 160],

			['sid', 'string', 'max' => 160],

			['text', 'required'],
			['text', 'string'],

			['created_at', 'date', 'format' => 'yyyy-MM-dd HH:mm:ss'],

			['updated_at', 'date', 'format' => 'yyyy-MM-dd HH:mm:ss'],

			['src', 'string', 'max' => 255],

			['video', 'string', 'max' => 255],

            ['file', 'file', 
                'extensions' => 'png, jpg, jpeg',
                'maxSize' => 9*1024*1024, 
                'mimeTypes' => 'image/jpeg, image/png',
                'skipOnEmpty' => false, 
                'on' => [self::SCENARIO_CREATE],
            ],
            ['file', 'file', 
                'extensions' => 'png, jpg, jpeg',
                'maxSize' => 9*1024*1024, 
                'mimeTypes' => 'image/jpeg, image/png',
                'skipOnEmpty' => true, 
                'on' => [self::SCENARIO_UPDATE],
            ],
		];
	}

	public function attributeLabels()
	{
		return [
			'id' => 'Ид. номер',
			'sid' => 'Строковый ид.',
			'header' => 'Заголовок',
			'text' => 'Текст',
			'user_id' => 'Ид. пользователя',
			'updated_at' => 'Обновлена',
			'created_at' => 'Создана',
		];
	}

    public static $images = [
        'full' => [
            'name' => 'full',
            'width' => 788,
            'height' => 248,
        ],
        'list' => [
            'name' => 'list',
            'width' => 378,
            'height' => 248,
        ],
        'icon' => [
            'name' => 'icon',
            'width' => 100,
            'height' => 100,
        ],
    ];

    public static function getImages()
    {
        return self::$images;
    }

    public function getSource($file = null)
    {
        if (!$this->extension) {
            return null;
        }
        if (!$file) {
            return '/' . self::PATH . self::intToPath($this->id) . $this->images['full']['name'] . '.' . $this->extension;
        } else {
            if (!array_key_exists($file, $this->images)) {
                return null;
            }
            return '/' . self::PATH . self::intToPath($this->id) . $this->images[$file]['name'] . '.' . $this->extension;
        }
    }

    public function getExtension()
    {
        if (!$this->src) {
            return null;
        } else {
            $extension = pathinfo ($this->src, PATHINFO_EXTENSION);
            if ($extension === '') {
                return null;
            } else {
                return $extension;
            }
        }
    }

    public function addFile()
    {
        if (!$this->file->tempName) {
            return null;
        }

        $intPath = self::intToPath($this->id);
        if (!$intPath) {
            return null;
        }

        $pathFolder = Yii::getAlias('@frontend/web/') . self::PATH . $intPath;
        if (!self::createPath($pathFolder)) {
            return null;
        }

        $fileName = $this->images['full']['name'] . '.' . $this->file->extension;
        if (!$this->file->saveAs($pathFolder . $fileName)) {
            return null;
        }

        $foto = Image::getImagine()->open($pathFolder . $fileName);
        $foto->thumbnail(new Box($this->images['full']['width'], $this->images['full']['height']),ImageInterface::THUMBNAIL_OUTBOUND)
            ->save($pathFolder . $this->images['full']['name'] . '.' . $this->file->extension, ['quality' => 80]);
        $foto->thumbnail(new Box($this->images['list']['width'], $this->images['list']['height']),ImageInterface::THUMBNAIL_OUTBOUND)
            ->save($pathFolder . $this->images['list']['name'] . '.' . $this->file->extension, ['quality' => 80]);
        $foto->thumbnail(new Box($this->images['icon']['width'], $this->images['icon']['height']),ImageInterface::THUMBNAIL_OUTBOUND)
            ->save($pathFolder . $this->images['icon']['name'] . '.' . $this->file->extension, ['quality' => 80]);

        $this->src = '/' . self::PATH . $intPath . $fileName;
        $numberOfRowsAffected = $this->updateAttributes(['src']);
        if ($numberOfRowsAffected === 0) {
            $this->addError('file', 'Источник не был сохранен.');
            return null;
        }
        return true;
    }

    public function delFile()
    {
        $folder = Yii::getAlias('@frontend/web/' . self::IMG_PATH . self::intToPath($this->id));
        if ( is_dir($folder) ) {
            $dir = opendir($folder);
            while (false !== ($file = readdir($dir))) {
                if ( ($file != ".") && ($file != "..") ) if (!unlink($folder.$file)) {
                    closedir($dir);
                    throw new ErrorException("Какой-то из файов превью не был удален.");
                }
            }
            closedir($dir);
            if (!rmdir($folder)) throw new ErrorException("Не получилось удалить пустую директорию.");
        }
        $this->imgsrc = null;
        return true;
    }

	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

	public function getPublicationPublicationtags()
	{
		return $this->hasMany(PublicationPublicationtag::className(), ['publication_id' => 'id']);
	}

	public function getPublicationtags()
	{
		return $this->hasMany(Publicationtag::className(), ['id' => 'publicationtag_id'])->viaTable('publication_publicationtag', ['publication_id' => 'id']);
	}






	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			if (isset($this->updated_at)&&($this->updated_at==="")) {
				$this->updated_at = date('YmdHis');
			}

			if($this->isNewRecord) {
				$this->created_at = date('YmdHis');
			}
			$this->sid = self::sid($this->sid,$this->header);
			if ($this->sid === '') {
				$this->addError('sid', 'Строковый идентификатор не смог создасться из заголовка, измените заголовок.');
				return false;
			}
			return true;
		} else {
			return false;
		}
	}

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($this->file) {
        	$this->addFile();
        }
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            $this->delFile();
            return true;
        } else {
            return false;
        }
    }
}
