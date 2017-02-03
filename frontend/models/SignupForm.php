<?php
namespace frontend\models;

use yii\base\Model;
use Yii;
use common\components\ctrait\DateTimeRu;
use common\models\User;
use common\models\Phonenumber;
use common\models\ProfileUser;
use common\models\ProfileCook;
use yii\db\Transaction;
use yii\base\ErrorException;

class SignupForm extends Model
{
    use DateTimeRu;

    public $password;
    public $passwordrepeat;
    public $day;
    public $month;
    public $year;

    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 8],

            ['passwordrepeat', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'Пароль',
            'passwordrepeat' => 'Подтвердите пароль',
        ];
    }

    public function signupValid($user, $phonenumber)
    {
        $vthis = $this->validate(['password','passwordrepeat']);
        $vuser = $user->validate(['name','surname','email','usertype']);
        $vphonenumber = $phonenumber->validate(['phonenumber']);
        if ( !$vthis || !$vuser || !$vphonenumber ) {
            // echo "<pre>";
            // print_r($this->errors);
            // print_r($user->errors);
            // print_r($phonenumber->errors);
            // echo "</pre>";
            // die();
            return null;
        }

        $_SESSION['signup']['name'] = $user->name;
        $_SESSION['signup']['surname'] = $user->surname;
        $_SESSION['signup']['email'] = $user->email;
        $_SESSION['signup']['usertype'] = $user->usertype;
        $_SESSION['signup']['password'] = $this->password;


        $code = '';
        for ($i = 0; $i<5; $i++) {
            $code .= (string)mt_rand(0,9);
        }

        $p = trim($phonenumber->phonenumber);
        $p = preg_replace('/[^+0-9]/','',$p);
        $p = preg_replace('/^8/','7',$p);
        $p = preg_replace('/[+]/','',$p);

        \Yii::$app->sms->sms_send( $p, $code );

        $_SESSION['signup']['phonenumber'] = $p;
        $_SESSION['signup']['sms_code'] = $code;
        $_SESSION['signup']['sms_time'] = time();

        return true;
    }

    public function signupBySms()
    {

        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }

        $user = new User([
            'name' => $session['signup']['name'],
            'surname' => $session['signup']['surname'],
            'email' => $session['signup']['email'],
            'usertype' => $session['signup']['usertype'],
        ]);

        $p = trim($session['signup']['phonenumber']);
        $p = preg_replace('/[^+0-9]/','',$p);
        $p = preg_replace('/^8/','7',$p);
        $p = preg_replace('/[+]/','',$p);
        $phonenumber = new Phonenumber([
            'phonenumber' => $session['signup']['phonenumber'],
        ]);

        $password = $session['signup']['password'];

        $vuser = $user->validate(['name','surname','email','usertype']);
        $vphonenumber = $phonenumber->validate(['phonenumber']);
        if ( !$vuser || !$vphonenumber ) {
            // echo "<pre>";
            // print_r($user->errors);
            // print_r($phonenumber->errors);
            // echo "</pre>";
            // die();
            return null;
        }

        $transaction = Yii::$app->db->beginTransaction(Transaction::SERIALIZABLE);
        try {
            $user->setPassword($password);
            $user->generateAuthKey();
            if ($user->validate()) {
                $user->save();
            } else {
                echo "<pre>";
                print_r($user->errors);
                echo "</pre>";
                die();
                throw new ErrorException('Ошибка при сохранении пользователя.');
            }

            $phonenumber->user_id = $user->id;
            $phonenumber->whatsapp = 0;
            $phonenumber->viber = 0;
            if ($phonenumber->validate()) {
                $phonenumber->save();
            } else {
                throw new ErrorException('Ошибка при сохранении номера телефона.');
            }

            $user->phonenumber_id = $phonenumber->id;
            if ($user->validate(['phonenumber_id'])) {
                $user->updateAttributes(['phonenumber_id']);
            } else {
                throw new ErrorException('Ошибка при сохранении основного номера телефона пользователя.');
            }

            switch ($user->usertype) {
                case 'user':
                    $profile = new ProfileUser();
                    break;
                case 'cook':
                    $profile = new ProfileCook();
                    break;
            }
            $profile->user_id = $user->id;
            if ($profile->validate()) {
                $profile->save();
            } else {
                throw new ErrorException('Ошибка при сохранении профиля пользователя.');
            }
        } catch (ErrorException $e) {
            $transaction->rollBack();
            throw $e;
        }
        $transaction->commit();
        return $user;
    }

    public function signup($user, $phonenumber)
    {
        $vthis = $this->validate(['password','passwordrepeat']);
        $vuser = $user->validate(['name','surname','email','usertype']);
        $vphonenumber = $phonenumber->validate(['phonenumber']);
        if ( !$vthis || !$vuser || !$vphonenumber ) {
            echo "<pre>";
            print_r($this->errors);
            print_r($user->errors);
            print_r($phonenumber->errors);
            echo "</pre>";
            die();
            return null;
        }

        $transaction = Yii::$app->db->beginTransaction(Transaction::SERIALIZABLE);
        try {
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->validate()) {
                $user->save();
            } else {
                echo "<pre>";
                print_r($user->errors);
                echo "</pre>";
                die();
                throw new ErrorException('Ошибка при сохранении пользователя.');
            }

            $phonenumber->user_id = $user->id;
            $phonenumber->whatsapp = 0;
            $phonenumber->viber = 0;
            if ($phonenumber->validate()) {
                $phonenumber->save();
            } else {
                throw new ErrorException('Ошибка при сохранении номера телефона.');
            }

            $user->phonenumber_id = $phonenumber->id;
            if ($user->validate(['phonenumber_id'])) {
                $user->updateAttributes(['phonenumber_id']);
            } else {
                throw new ErrorException('Ошибка при сохранении основного номера телефона пользователя.');
            }

            switch ($user->usertype) {
                case 'user':
                    $profile = new ProfileUser();
                    break;
                case 'cook':
                    $profile = new ProfileCook();
                    break;
            }
            $profile->user_id = $user->id;
            if ($profile->validate()) {
                $profile->save();
            } else {
                throw new ErrorException('Ошибка при сохранении профиля пользователя.');
            }
        } catch (ErrorException $e) {
            $transaction->rollBack();
            throw $e;
        }
        $transaction->commit();
        return $user;
    }
}
