<?php

namespace common\models;

use Yii;
use common\components\ctrait\Path;
use yii\imagine\Image;
use yii\base\ErrorException;

use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use Imagine\Image\ImageInterface;
use common\components\resizeimg\ResizeImg;

class Productfoto extends \yii\db\ActiveRecord
{
    use Path;

    const PATH = 'upload/productfoto/';

    public $file;

    public static function tableName()
    {
        return 'productfoto';
    }

    public function rules()
    {
        return [
            ['product_id', 'required'],
            ['product_id', 'integer'],
            ['product_id', 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],

            ['src', 'string', 'max' => 255, 'skipOnEmpty' => true],
            ['src', 'default', 'value' => null],

            ['file', 'required'], 
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
            'product_id' => 'Product ID',
            'src' => 'Src',
        ];
    }

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
                'width' => 250,
                'height' => 250,
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
            throw new ErrorException("Нет имени файла tempName.");
        }

        $intPath = self::intToPath($this->id);
        if (!$intPath) {
            throw new ErrorException("Не создан id путь к файлу.");
        }

        $pathFolder = Yii::getAlias('@frontend/web/') . self::PATH . $intPath;
        if (!self::createPath($pathFolder)) {
            throw new ErrorException("Не создан путь к файлу.");
        }

        $fileName = $this->files['full']['name'] . '.' . $this->file->extension;
        if (!$this->file->saveAs($pathFolder . $fileName)) {
            throw new ErrorException("Файл не сохранен по пути.");
        }

        // Ресайзим до нужных размеров
        $resizeImg = new ResizeImg($pathFolder . $fileName);
        $paramImg = [
            'width' => $this->files['full']['width'],
            'height' => $this->files['full']['height'],
            'kind' => 'cover',
            'subFolder' => false,
            'nameSufix' => false,
        ];
        $resizeImg->resize($paramImg);

        // Делаем все виды превьюшек
        $foto = Image::getImagine()->open($pathFolder . $fileName);
        $foto->thumbnail(new Box($this->files['list']['width'], $this->files['list']['height']),ImageInterface::THUMBNAIL_OUTBOUND)
            ->save($pathFolder . $this->files['list']['name'] . '.' . $this->file->extension, ['quality' => 80]);
        $foto->thumbnail(new Box($this->files['icon']['width'], $this->files['icon']['height']),ImageInterface::THUMBNAIL_OUTBOUND)
            ->save($pathFolder . $this->files['icon']['name'] . '.' . $this->file->extension, ['quality' => 80]);

        $this->src = '/' . self::PATH . $intPath . $fileName;
        $numberOfRowsAffected = $this->updateAttributes(['src']);
        if ($numberOfRowsAffected === 0) {
            throw new ErrorException("После сохранения файла путь не занесен в бд.");
        }
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
        $this->updateAttributes(['src']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($this->file) {
            try {
                $this->addFile();
            } catch (ErrorException $e) {
                $this->delete();
                throw $e;
            }
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
