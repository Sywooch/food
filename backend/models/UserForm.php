<?php
namespace backend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class UserForm extends Model
{
    public $e = null;

    public $username;
    public $email;
    public $newpassword;
    public $newpasswordrepeat;

    public $usertype;
    public $status;
    public $role;

    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => 'Это имя пользователя уже занято.', 'on' => ['create']],
            ['username', 'string', 'min' => 6, 'max' => 35],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => 'Этот адрес электронной почты уже используется.', 'on' => ['create']],

            ['newpassword', 'required', 'on' => ['create']],
            ['newpassword', 'string', 'on' => ['create'], 'min' => 8, 'skipOnEmpty' => false],
            // ['newpassword', 'safe', 'on' => ['update']],
            ['newpassword', 'string', 'on' => ['update'], 'min' => 8, 'skipOnEmpty' => true],

            // ['newpasswordrepeat', 'compare', 'on' => ['create'], 'compareAttribute' => 'newpassword'],
            // ['newpasswordrepeat', 'compare', 'on' => ['update'], 'compareAttribute' => 'newpassword'],
            ['newpasswordrepeat', 'compare', 'compareAttribute' => 'newpassword'],

            ['usertype', 'required'],
            ['usertype', 'in', 'range' => [User::TYPE_COOK, User::TYPE_USER]],

            ['status', 'required'],
            ['status', 'in', 'range' => [User::STATUS_DELETED, User::STATUS_ACTIVE]],

            ['role', 'required'],
            ['role', 'in', 'range' => [User::ROLE_USER, User::ROLE_ADMIN]],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Ид. номер',
            'username' => 'Имя',
            'email' => 'Email',
            'newpassword' => 'Пароль',
            'newpasswordrepeat' => 'Повторите пароль',
            'status' => 'Статус',
            'updated_at' => 'Дата обновления',
            'created_at' => 'Дата создания',
            'usertype' => 'Повар/Покупатель',
            'role' => 'Роль (Администратор/Пользователь)',
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();

        $user->username = $this->username;
        $user->email = $this->email;

        $user->setPassword($this->newpassword);
        $user->generateAuthKey();

        $user->usertype = $this->usertype;
        $user->role = $this->role;
        $user->status = $this->status;

        return $user->save() ? $user : null;
    }

}
