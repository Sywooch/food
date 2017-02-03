<?php
namespace frontend\models;

use common\models\User;
use Yii;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;
    public $user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            // ['email', 'email'],
            // ['email', 'exist',
            //     'targetClass' => '\common\models\User',
            //     'filter' => ['status' => User::STATUS_ACTIVE],
            //     'message' => 'Нет пользователя с таким адресом электронной почты.'
            // ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Укажите адрес электронной почты',
        ];
    }

    /**
     * Определяет метод восстановления по
     * @return string|false [description]
     */
    public function methodByQuery()
    {
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);
        if ($user) {
            return 'email';
        }

        if (!$user) {
            $p = trim($this->email);
            $p = preg_replace('/[^+0-9]/','',$p);
            $p = preg_replace('/^8/','7',$p);
            $p = preg_replace('/[+]/','',$p);
            $user = User::find()
                ->joinWith('phonenumber')
                ->where(['user.status' => User::STATUS_ACTIVE, 'phonenumber.phonenumber' => $p])
                ->one();
            if ($user) {
                $this->user = $user;
                return 'phonenumber';
            }
        }

        return false;
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
        }
        if (!$user->save()) {
            return false;
        }
        $message = Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([\Yii::$app->params['noreplyEmail'] => \Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Password reset for ' . \Yii::$app->name)
            ->send();
        return $message;
    }

    public function sendSms()
    {
        
    }
}
