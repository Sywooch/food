<?php

namespace common\models;

use Yii;
use common\components\ctrait\Sid;
use common\components\ctrait\Path;
use yii\web\UploadedFile;

use common\components\resizeimg\ResizeImg;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use yii\imagine\Image;

class News extends \yii\db\ActiveRecord
{
    use Sid;
    use Path;

    public $e = null;
    public $file;
    public $del_img;
    public $shorttext;

    const IMG_PATH = 'upload/newsimg/';

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

    public $selectedNewstag;


    public static function tableName()
    {
        return 'news';
    }

    public function rules()
    {
        return [
            [['header'], 'required'],
            [['text'], 'string'],
            [['updated_at', 'created_at', 'selectedNewstag'], 'safe'],
            [['sid'], 'string', 'max' => 80],
            [['header'], 'string', 'max' => 255],
            [['file'], 'file', 
                'skipOnEmpty' => true, 
                'extensions' => 'png, jpg', 
                'maxSize' => 9*1024*1024, 
                'mimeTypes' => 'image/jpeg, image/png',
            ],
            [['del_img'], 'boolean'],
            [['imgsrc'], 'default', 'value' => null],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Ид.',
            'sid' => 'Строковый ид.',
            'header' => 'Заголовок',
            'text' => 'Текст',
            'updated_at' => 'Дата обновления',
            'created_at' => 'Дата создания',
            'selectedNewstag' => 'Теги новости',
            'del_img' => 'Удалить изображение',
            'file' => 'Добавить изображение для новости',
            'imgsrc' => 'Путь к изображению',
        ];
    }

    public function getNewsNewstag()
    {
        return $this->hasMany(NewsNewstag::className(), ['newstag_id' => 'id']);
    }

    public function getNewsTag()
    {
        return $this->hasMany(NewsTag::className(), ['id' => 'newstag_id'])->viaTable('news_newstag', ['news_id' => 'id']);
    }

    public function srcOf($image = 'full')
    {
        if ($this->imgsrc) {
            return '/' . self::IMG_PATH . self::intToPath($this->id) . self::$images[$image]['name'] .'.' . $this->extension;
        } else {
            return null;
        }
    }

    public function getExtension()
    {
        $extension = pathinfo ($this->imgsrc, PATHINFO_EXTENSION);
        if ($extension === '') throw new ErrorException("Не удалось определить расширение загруженного файла");
        return $extension;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (isset($this->updated_at)&&$this->updated_at==="") {
                $this->updated_at = date('YmdHis');
            }

            if($this->isNewRecord) {
                if (isset($this->created_at)&&$this->created_at==="") {
                    $this->created_at = date('YmdHis');
                }
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

    public function addFile()
    {
        if (!$this->file || !$this->file->tempName) throw new ErrorException("1234");

        $intPath = self::intToPath($this->id);
        if (!$intPath) throw new ErrorException("1235");

        $pathFolder = Yii::getAlias('@frontend/web/') . self::IMG_PATH . $intPath;
        if (!self::createPath($pathFolder)) throw new ErrorException("1236");

        $fileName = self::$images['full']['name'] . '.' . $this->file->extension;
        // Сохранени фото
        $this->file->saveAs($pathFolder . $fileName);
        // Если указана область - кропим
        if (
            Yii::$app->request->post('iw') &&
            Yii::$app->request->post('ih') &&
            Yii::$app->request->post('aw') &&
            Yii::$app->request->post('ah') &&
            Yii::$app->request->post('pw') &&
            Yii::$app->request->post('ph') &&
            Yii::$app->request->post('x1') &&
            Yii::$app->request->post('y1') &&
            Yii::$app->request->post('x2') &&
            Yii::$app->request->post('y2')
        ) {
            $k = Yii::$app->request->post('ph') / Yii::$app->request->post('ih');
            $areaWidth = floor(Yii::$app->request->post('aw') / $k);
            $areaHeight = floor(Yii::$app->request->post('ah') / $k);
            $fromX = floor(Yii::$app->request->post('x1') / $k);
            $fromY = floor(Yii::$app->request->post('y1') / $k);
            Image::crop($pathFolder . $fileName, $areaWidth, $areaHeight, [$fromX,$fromY])
                ->save($pathFolder . $fileName, ['quality' => 80]);
        }
        // Ресайзим до нужных размеров
        $resizeImg = new ResizeImg($pathFolder . $fileName);
        $paramImg = [
            'width' => self::$images['full']['width'],
            'height' => self::$images['full']['height'],
            'kind' => 'cover',
            'subFolder' => false,
            'nameSufix' => false,
        ];
        $resizeImg->resize($paramImg);

        // Делаем все виды превьюшек
        $foto = Image::getImagine()->open($pathFolder . $fileName);
        $foto->thumbnail(new Box(self::$images['list']['width'], self::$images['list']['height']),ImageInterface::THUMBNAIL_OUTBOUND)
            ->save($pathFolder . self::$images['list']['name'] . '.' . $this->file->extension, ['quality' => 80]);
        $foto->thumbnail(new Box(self::$images['icon']['width'], self::$images['icon']['height']),ImageInterface::THUMBNAIL_OUTBOUND)
            ->save($pathFolder . self::$images['icon']['name'] . '.' . $this->file->extension, ['quality' => 80]);

        // Добавляем  в модель src основного изображения
        $this->file = $fileName;
        $this->imgsrc = '/' . self::IMG_PATH . $intPath . $fileName;
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
}
