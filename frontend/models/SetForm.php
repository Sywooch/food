<?php
namespace frontend\models;

use yii\base\Model;
use Yii;
use common\models\User;
use yii\db\Transaction;
use yii\base\ErrorException;

class SetForm extends Model
{

    public function rules()
    {
        return [
        ];
    }

    public function attributeLabels()
    {
        return [
        ];
    }

    public function create()
    {
    //     $vthis = $this->validate();
    //     $vuser = $user->validate(['username','email','usertype']);
    //     $vphonenumber = $phonenumber->validate(['phonenumber']);
    //     if ( !$vthis || !$vuser || !$vphonenumber ) {
    //         return null;
    //     }

    //     $transaction = Yii::$app->db->beginTransaction(Transaction::SERIALIZABLE);
    //     try {
    //         $user->setPassword($this->password);
    //         $user->generateAuthKey();
    //         if ($user->validate()) {
    //             $user->save();
    //         } else {
    //             throw new \Exception();
    //         }

    //         $phonenumber->user_id = $user->id;
    //         if ($phonenumber->validate()) {
    //             $phonenumber->save();
    //         } else {
    //             throw new \Exception();
    //         }

    //         $user->phonenumber_id = $phonenumber->id;
    //         if ($user->validate(['phonenumber_id'])) {
    //             $user->updateAttributes(['phonenumber_id']);
    //         } else {
    //             throw new \Exception();
    //         }

    //         switch ($user->usertype) {
    //             case 'user':
    //                 $profile = new ProfileUser();
    //                 break;
    //             case 'cook':
    //                 $profile = new ProfileCook();
    //                 break;
    //         }
    //         $profile->user_id = $user->id;
    //         if ($profile->validate()) {
    //             $profile->save();
    //         } else {
    //             throw new \Exception();
    //         }
    //     } catch (\Exception $e) {
    //         $transaction->rollBack();
    //         throw new ErrorException('Ошибка приложения при регистрации пользователя.');
    //     }
    //     $transaction->commit();
    //     return $user;
    }
}
