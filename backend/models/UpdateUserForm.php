<?php
namespace backend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class UpdateUserForm extends Model
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
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Это имя пользователя уже занято.'],
            ['username', 'string', 'min' => 6, 'max' => 35],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот адрес электронной почты уже используется.'],

            // ['password', 'required'],
            // ['password', 'string', 'min' => 6],

            ['newpassword', 'safe'],
            ['newpassword', 'string', 'min' => 8, 'skipOnEmpty' => true],
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
            'password' => 'Пароль',
            'status' => 'Статус',
            'updated_at' => 'Дата обновления',
            'created_at' => 'Дата создания',
            'usertype' => 'Повар/Покупатель',
            'role' => 'Роль (Администратор/Пользователь)',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->usertype = $this->usertype;
        $user->role = $this->role;

        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }

}
