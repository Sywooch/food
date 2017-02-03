<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\helpers\ArrayHelper;

class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public static $statusName = [
        USER::STATUS_ACTIVE => 'Активный',
        USER::STATUS_DELETED => 'Удален',
    ];
    
    const TYPE_USER = 'user';
    const TYPE_COOK = 'cook';

    public static $usertypeName = [
        USER::TYPE_USER => 'Покупатель',
        USER::TYPE_COOK => 'Повар',
    ];

    const ROLE_USER = 10;
    const ROLE_ADMIN = 20;

    public static $roleName = [
        USER::ROLE_USER => 'Пользователь',
        USER::ROLE_ADMIN => 'Администратор',
    ];

    const AGE_MIN = 16;

    public $newpassword;
    public $newpasswordrepeat;
   
    public static $leftcook = [
        'profile' => [
            'header' => 'Профиль',
        ],
        'menu' => [
            'header' => 'Меню',
        ],
        'foto' => [
            'header' => 'Фото',
        ],
        'pay' => [
            'header' => 'Оплата',
        ],
        'blog' => [
            'header' => 'Блог',
        ],
    ];

    public static $leftuser = [
        'profile' => [
            'header' => 'Профиль',
        ],
        'mycooks' => [
            'header' => 'Мои повара',
        ],
    ];

    public static $topcook = [
        'user/notice' => [
            'header' => 'Уведомления',
            'quantity' => 0,
        ],
        'message/list' => [
            'header' => 'Сообщения',
            'quantity' => 0,
        ],
        'user/reviews' => [
            'header' => 'Отзывы',
            'quantity' => 0,
        ],
        'order/list' => [
            'header' => 'Заказы',
            'quantity' => 0,
        ],
        'user/rating' => [
            'header' => 'Рейтинг',
            'quantity' => 0,
        ],
    ];

    public static $topuser = [
        'user/notice' => [
            'header' => 'Уведомления',
            'quantity' => 0,
        ],
        'message/list' => [
            'header' => 'Сообщения',
            'quantity' => 0,
        ],
        'user/reviews' => [
            'header' => 'Отзывы',
            'quantity' => 0,
        ],
        'order/list' => [
            'header' => 'Заказы',
            'quantity' => 0,
        ],
    ];

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function rules()
    {
        return [
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'required'],
            ['name', 'string', 'min' => 2, 'max' => 255],

            ['surname', 'filter', 'filter' => 'trim'],
            ['surname', 'required'],
            ['surname', 'string', 'min' => 2, 'max' => 255],

            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'message' => 'Этот адрес электронной почты уже используется.'],

            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],

            ['usertype', 'required', 'message' => 'Необходимо выбрать тип аккаунта - Повар или Пользователь (покупатель)'],
            // ['usertype', 'default', 'value' => self::TYPE_USER],
            ['usertype', 'in', 'range' => [self::TYPE_COOK, self::TYPE_USER], 'skipOnEmpty' => false],
            
            ['role', 'default', 'value' => self::ROLE_USER],
            ['role', 'in', 'range' => [self::ROLE_ADMIN, self::ROLE_USER]],

            ['phonenumber_id', 'exist', 'skipOnError' => false, 'skipOnEmpty' => true, 'targetClass' => Phonenumber::className(), 'targetAttribute' => ['phonenumber_id' => 'id']],

            // ['datebirth', 'required'],
            // ['datebirth', 'date', 'format' => 'yyyy-M-d', 'skipOnEmpty' => false, 'message' => 'Неверный формат даты дня рождения.'],
            // ['datebirth', 'validateDateBirth'],

        ];
    }

    public function getUsername()
    {
        return $this->name . ' ' . $this->surname;
    }

    public function validateDateBirth($attribute, $params) {
        $datenow = new \DateTime('now');
        $mininterval = new \DateInterval('P' . self::AGE_MIN . 'Y');
        $datebirthmax = $datenow->sub($mininterval);
        $datebirth = new \DateTime($this->$attribute);
        if ($datebirth > $datebirthmax) {
            $this->addError($attribute, 'Разрешено лицам с ' . self::AGE_MIN . ' лет.');
        }
    }

    /**
     * @param  [string]
     * @return boolean
     */
    public static function isUserAdmin($username)
    {

        if (static::findOne(['name' => $username, 'role' => self::ROLE_ADMIN]))
        {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return [array]
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Ид. номер',
            'username' => 'Имя',
            'email' => 'Email',
            'status' => 'Статус',
            'updated_at' => 'Время обновления',
            'created_at' => 'Время создания',
            'usertype' => 'Повар/Покупатель',
            'role' => 'Роль',
            'newpassword' => 'Новый пароль',
            'newpasswordrepeat' => 'Повторите пароль',
            'datebirth' => 'Дата рождения',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByEmail($email)
    {

        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByPhonenumber($phonenumber)
    {
        return static::find()
            ->innerJoin('phonenumber p', 'p.id = user.phonenumber_id')
            ->where(['p.phonenumber' => $phonenumber, 'status' => self::STATUS_ACTIVE])
            ->one();
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getAddress()
    {
        return $this->hasMany(Address::className(), ['user_id' => 'id']);
    }

    public function getPhonenumber()
    {
        return $this->hasMany(Phonenumber::className(), ['user_id' => 'id']);
    }

    public function getProfileCook()
    {
        return $this->hasOne(ProfileCook::className(), ['user_id' => 'id']);
    }

    public function getProfileUser()
    {
        return $this->hasOne(ProfileUser::className(), ['user_id' => 'id']);
    }

    public function getAlbum()
    {
        return $this->hasMany(Album::className(), ['user_id' => 'id']);
    }

    public function getFotokitchen()
    {
        return $this->hasMany(Fotokitchen::className(), ['user_id' => 'id']);
    }

    public function getFotodoc()
    {
        return $this->hasMany(Fotodoc::className(), ['user_id' => 'id']);
    }

    public function getProfile()
    {
        switch ($this->usertype) {
            case self::TYPE_COOK :
                return $this->getProfileCook();
                break;
            case self::TYPE_USER :
                return $this->getProfileUser();
                break;
            default:
                return null;
                break;
        }
    }

    public function getKitchenUser()
    {
        return $this->hasMany(KitchenUser::className(), ['user_id' => 'id']);
    }

    public function getKitchen()
    {
        return $this->hasMany(Kitchen::className(), ['id' => 'kitchen_id'])->viaTable('kitchen_user', ['user_id' => 'id']);
    }

    private $assignKitchen;

    public function getAssignKitchen()
    {
        return $this->assignKitchen = ArrayHelper::getColumn($this->getKitchen()->all(), 'id');
    }

    /**
     * @return [Kitchen]
     */
    public function getKitchenCook()
    {
        return Kitchen::find()
            ->select('kitchen.*')
            ->innerJoin('dish_kitchen dk', 'dk.kitchen_id = kitchen.id')
            ->innerJoin('dish d', 'd.product_id = dk.dish_id')
            ->innerJoin('product p', 'p.id = d.product_id')
            ->where(['p.user_id' => $this->id])
            ->groupBy('kitchen.id')
            ->all();
    }

    public function getPhonenumberlist()
    {
        $array = ArrayHelper::getColumn($this->phonenumber, 'phonenumber');
        if (count($array)) {
            return implode(', ', $array);
        } else {
            return null;
        }
    }

    public function getPhonenumbermain()
    {
        return $this->hasOne(Phonenumber::className(), ['id' => 'phonenumber_id']);
    }

    public function getAddresslist()
    {
        $array = ArrayHelper::getColumn($this->address, function($address) {
            return $address->address;
        });
        if (count($array)) {
            return implode(', ', $array);
        } else {
            return null;
        }
    }

    public function getKitchenlist()
    {
        $array = ArrayHelper::getColumn($this->kitchen,'header');
        if (count($array)) {
            return implode(', ', $array);
        } else {
            return null;
        }
    }

    public function getFavoritecooks()
    {
        return $this->hasMany(Favoritecook::className(), ['cook_id' => 'id']);
    }

    public function getFavoritecooks0()
    {
        return $this->hasMany(Favoritecook::className(), ['user_id' => 'id']);
    }

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('favoritecook', ['cook_id' => 'id']);
    }

    public function getCooks()
    {
        return $this->hasMany(User::className(), ['id' => 'cook_id'])->viaTable('favoritecook', ['user_id' => 'id']);
    }

    public function getIconsrc($icon = null)
    {
        switch ($this->usertype) {
            case 'cook':
                if (!$this->profileCook) return null;
                $IconsrcCurrent = $this->profileCook->getIconsrc($icon);
                return $IconsrcCurrent?$IconsrcCurrent:'/images/cooker__undefined.jpg';
                break;
            case 'user':
                if (!$this->profileUser) return null;
                $IconsrcCurrent = $this->profileUser->getIconsrc($icon);
                return $IconsrcCurrent?$IconsrcCurrent:'/images/user__undefined.jpg';
                break;
            default:
                return null;
                break;
        }
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['user_id' => 'id']);
    }

}
