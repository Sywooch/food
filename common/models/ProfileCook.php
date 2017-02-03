<?php

namespace common\models;

use Yii;
use yii\imagine\Image;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use yii\base\ErrorException;
use common\components\ctrait\Path;
use yii\helpers\ArrayHelper;

use common\components\resizeimg\ResizeImg;

class ProfileCook extends \yii\db\ActiveRecord
{
    use Path;

    const ICON_PATH = 'upload/usericon/';
    public $icon;
    public $del_icon;
    private static $icons = [
        'full' => [
            'name' => 'full',
            'width' => 250,
            'height' => 300,
        ],
        'icon' => [
            'name' => 'icon',
            'width' => 64,
            'height' => 64,
        ],
    ];

    public static function tableName()
    {
        return 'profile_cook';
    }

    public function rules()
    {
        return [
            ['user_id', 'required'],
            ['user_id', 'integer'],
            ['user_id', 'unique'],
            ['user_id', 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],

            ['region', 'string', 'skipOnEmpty' => true],

            ['about', 'string'],
            ['about', 'default', 'value' => null],

            ['costmin', 'number', 'min' => 100, 'skipOnEmpty' => true],
            ['costmin', 'default', 'value' => 100],

            ['costfree', 'number', 'min' => 100],
            ['costfree', 'default', 'value' => null],
            
            ['costdelivery', 'number'],
            ['costdelivery', 'default', 'value' => null],

            ['pickup', 'boolean', 'skipOnEmpty' => true],
            ['pickup', 'default', 'value' => 0],

            ['workhome', 'boolean', 'skipOnEmpty' => true],
            ['workhome', 'default', 'value' => 0],

            ['workevent', 'boolean', 'skipOnEmpty' => true],
            ['workevent', 'default', 'value' => 0],

            ['callfrom', 'match', 'pattern' => '/^[\d]{1,2}[:]{1}[\d]{2}$/'],
            ['callfrom', 'default', 'value'=>'8:00'],
            
            ['callto', 'match', 'pattern' => '/^[\d]{1,2}[:]{1}[\d]{2}$/'],
            ['callto', 'default', 'value'=>'19:00'],

            ['del_icon', 'boolean', 'skipOnEmpty' => true],
            ['del_icon', 'default', 'value' => 0],

            ['icon', 'file', 
                'skipOnEmpty' => true, 
                'extensions' => 'png, jpg, jpeg',
                'maxSize' => 9*1024*1024, 
                'mimeTypes' => 'image/jpeg, image/png',
            ],

            ['iconsrc', 'string', 'max' => 255, 'skipOnEmpty' => true],
            ['iconsrc', 'default', 'value' => null],

            ['video', 'string', 'max' => 255, 'skipOnEmpty' => true],
            ['video', 'default', 'value' => null],
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_id' => 'Ид. повара',
            'region' => 'Регион',
            'about' => 'Обо мне',
            'costmin' => 'Минимальная сумма заказа',
            'costfree' => 'Бесплатная доставка от',
            'costdelivery' => 'Стоимость доставки',
            'pickup' => 'Самовывоз',
            'workhome' => 'Выезд на дом',
            'workevent' => 'Работа на мероприятиях',
            'callfrom' => 'Связаться с',
            'callto' => 'Связаться до',
            'iconsrc' => 'Путь к аватарке',
            'video' => 'Ссылка на видео',
        ];
    }

    public static function getIcons()
    {
        return self::$icons;
    }

    public function getIconsrc($icon = null)
    {
        if ($this->iconsrc) {
            if ($icon) {
                return '/' . self::ICON_PATH . self::intToPath($this->user_id) . self::$icons[$icon]['name'] .'.' . $this->extension;
            }
            return '/' . self::ICON_PATH . self::intToPath($this->user_id) . self::$icons['full']['name'] .'.' . $this->extension;
        } else {
            return null;
        }
    }

    public function getExtension()
    {
        if (!$this->iconsrc) {
            return null;
        } else {
            $extension = pathinfo ($this->iconsrc, PATHINFO_EXTENSION);
            if ($extension === '') {
                return null;
            } else {
                return $extension;
            }
        }
    }

    public function addIcon()
    {
        if (!$this->icon || !$this->icon->tempName) {
            throw new ErrorException("Нет имени файла tempName.");
        }

        $intPath = self::intToPath($this->user_id);
        if (!$intPath) {
            throw new ErrorException("Не создан id путь к файлу.");
        }

        $pathFolder = Yii::getAlias('@frontend/web/') . self::ICON_PATH . $intPath;
        if (!self::createPath($pathFolder)) {
            throw new ErrorException("Не создан путь к файлу.");
        }

        $fileName = $this->icons['full']['name'] . '.' . $this->icon->extension;
        if (!$this->icon->saveAs($pathFolder . $fileName)) {
            throw new ErrorException("Файл не сохранен по пути.");
        }

        // Если указана область - кропим
        if (
            ($_POST['iw'] !== '') &&
            ($_POST['ih'] !== '') &&
            ($_POST['aw'] !== '') &&
            ($_POST['ah'] !== '') &&
            ($_POST['pw'] !== '') &&
            ($_POST['ph'] !== '') &&
            ($_POST['x1'] !== '') &&
            ($_POST['y1'] !== '') &&
            ($_POST['x2'] !== '') &&
            ($_POST['y2'] !== '')
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
            'width' => self::$icons['full']['width'],
            'height' => self::$icons['full']['height'],
            'kind' => 'cover',
            'subFolder' => false,
            'nameSufix' => false,
        ];
        $resizeImg->resize($paramImg);

        // Делаем все виды превьюшек
        $foto = Image::getImagine()->open($pathFolder . $fileName);
        $foto->thumbnail(new Box(self::$icons['icon']['width'], self::$icons['icon']['height']),ImageInterface::THUMBNAIL_OUTBOUND)
            ->save($pathFolder . self::$icons['icon']['name'] . '.' . $this->icon->extension, ['quality' => 80]);

        $this->iconsrc = '/' . self::ICON_PATH . $intPath . $fileName;
        $this->updateAttributes(['iconsrc']);
        $this->icon = null;
    }

    public function delIcon()
    {
        $folder = Yii::getAlias('@frontend/web/' . self::ICON_PATH . self::intToPath($this->user_id));
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
        $this->iconsrc = null;
        $this->updateAttributes(['iconsrc']);
        return true;
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['user_id' => 'user_id']);
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            $this->delIcon();
            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($this->icon) {
            $this->addIcon();
        }
    }

}
