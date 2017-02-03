<?php
namespace common\models;

use Yii;

use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use Imagine\Image\ImageInterface;
use common\components\resizeimg\ResizeImg;

use common\components\ctrait\Path;

class Fotokitchen extends \yii\db\ActiveRecord
{
    use Path;

    public $file;

    public static function tableName()
    {
        return 'fotokitchen';
    }

    public function rules()
    {
        return [
            ['user_id', 'required'],
            ['user_id', 'integer'],
            ['user_id', 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],

            ['src', 'string', 'skipOnEmpty' => true, 'max' => 255],
            ['src', 'default', 'value' => null],

            ['file', 'file', 
                'skipOnEmpty' => false, 
                'extensions' => 'png, jpg, jpeg',
                'maxSize' => 9*1024*1024,
                'mimeTypes' => 'image/jpeg, image/png',
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'src' => 'Src',
        ];
    }

    const PATH = 'upload/fotokitchen/';
    const MAXCOUNT = 10;

    public function getFiles()
    {
        return [
            'full' => [
                'name' => 'full',
                'width' => 800,
                'height' => 600,
            ],
            'list' => [
                'name' => 'list',
                'width' => 320,
                'height' => 240,
            ],
            'icon' => [
                'name' => 'icon',
                'width' => 100,
                'height' => 100,
            ],
        ];
    }

    public function getSource($file = null)
    {
        if (!$this->extension) {
            return null;
        }
        if (!$file) {
            return '/' . self::PATH . self::intToPath($this->id) . $this->files['full']['name'] . '.' . $this->extension;
        } else {
            if (!array_key_exists($file, $this->files)) {
                return null;
            }
            return '/' . self::PATH . self::intToPath($this->id) . $this->files[$file]['name'] . '.' . $this->extension;
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
        if (!$this->file || !$this->file->tempName) {
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

        $fileName = $this->files['full']['name'] . '.' . $this->file->extension;
        if (!$this->file->saveAs($pathFolder . $fileName)) {
            return null;
        }

        // Ресайзим до нужных размеров
        // $resizeImg = new ResizeImg($pathFolder . $fileName);
        // $paramImg = [
        //     'width' => $this->files['full']['width'],
        //     'height' => $this->files['full']['height'],
        //     'kind' => 'cover',
        //     'subFolder' => false,
        //     'nameSufix' => false,
        // ];
        // $resizeImg->resize($paramImg);

        // Делаем все виды превьюшек
        $foto = Image::getImagine()->open($pathFolder . $fileName);
        $foto->thumbnail(new Box($this->files['full']['width'], $this->files['full']['height']),ImageInterface::THUMBNAIL_OUTBOUND)
            ->save($pathFolder . $this->files['full']['name'] . '.' . $this->file->extension, ['quality' => 80]);
        $foto->thumbnail(new Box($this->files['list']['width'], $this->files['list']['height']),ImageInterface::THUMBNAIL_OUTBOUND)
            ->save($pathFolder . $this->files['list']['name'] . '.' . $this->file->extension, ['quality' => 80]);
        $foto->thumbnail(new Box($this->files['icon']['width'], $this->files['icon']['height']),ImageInterface::THUMBNAIL_OUTBOUND)
            ->save($pathFolder . $this->files['icon']['name'] . '.' . $this->file->extension, ['quality' => 80]);

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
        $folder = Yii::getAlias('@frontend/web/' . self::PATH . self::intToPath($this->id));
        if ( is_dir($folder) ) {
            $dir = opendir($folder);
            while (false !== ($file = readdir($dir))) {
                if ( ($file != ".") && ($file != "..") ) if (!unlink($folder.$file)) {
                    closedir($dir);
                    throw new ErrorException("Какой-то из файов превью не был удален.");
                }
            }
            closedir($dir);
            if (!rmdir($folder)) {
                throw new ErrorException("Не получилось удалить пустую директорию.");
            }
        }
        $this->src = null;
        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if (!$this->addFile()) {
            $this->addError('file', 'Файл не был сохранен по неизвестной причине.');
            $this->delete();
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

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
