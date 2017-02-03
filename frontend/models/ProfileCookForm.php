<?php
namespace frontend\models;

use common\models\User;
use common\models\Phonenumber;
use common\models\Address;
use common\models\Metrostation;
use common\models\Fotokitchen;
use common\models\Fotodoc;
use yii\base\Model;
use Yii;
use yii\db\Transaction;
use yii\web\UploadedFile;
use yii\base\ErrorException;

class ProfileCookForm extends Model
{
    public $loadEmpty; // fix no load
    public $leftphonenumber = [];
    public $del_icon;
    public $fotokitchen;
    public $leftfotokitchen = [];
    public $fotodoc;
    public $leftfotodoc = [];

    public function rules()
    {
        return [
            ['loadEmpty', 'string', 'skipOnEmpty' => true],

            ['leftphonenumber', 'each', 'rule' => [
                'integer',
            ]],

            ['del_icon', 'boolean', 'skipOnEmpty' => true],
            ['del_icon', 'default', 'value' => 0],

            ['fotokitchen', 'each', 'rule' => ['file', 
                'skipOnEmpty' => true, 
                'extensions' => 'png, jpg, jpeg',
                'maxSize' => 9*1024*1024, 
                'mimeTypes' => 'image/jpeg, image/png',
            ]],

            ['leftfotokitchen', 'each', 'rule' => [
                'integer',
            ]],

            ['fotodoc', 'each', 'rule' => ['file', 
                'skipOnEmpty' => true, 
                'extensions' => 'png, jpg, jpeg',
                'maxSize' => 9*1024*1024, 
                'mimeTypes' => 'image/jpeg, image/png',
            ]],

            ['leftfotodoc', 'each', 'rule' => [
                'integer',
            ]],
        ];
    }

    public function attributeLabels()
    {
        return [
        ];
    }

    public function update($phonenumber,
        $newphonenumber,
        $user,
        $address,
        $profile,
        $newfotokitchen,
        $fotokitchen,
        $newfotodoc,
        $fotodoc
    ) {

        // Файлы
        $profile->icon = UploadedFile::getInstance($profile, 'icon');

        // Валидация
        $vthis = $this->validate();
        if ($newphonenumber) {
            $vnewphonenumber = Model::validateMultiple($newphonenumber, [
                'phonenumber',
                'viber',
                'whatsapp',
                'vibernumber',
                'whatsappnumber',
            ]);
        } else {
            $vnewphonenumber = true;
        }
        if ($phonenumber) {
            $vphonenumber = Model::validateMultiple($phonenumber);
        } else {
            $vphonenumber = true;
        }
        if ($address->metro_id) {
            $m = Metrostation::find()->where(['header' => $address->metro_id])->one();
            if ($m) {
                $address->metro_id = $m->id;
            } else {
                $address->metro_id = null;
            }
        } else {
            $address->metro_id = null;
        }
        $vaddress = $address->validate();
        // $user->datebirth = '2000-01-01';
        $vuser = $user->validate(['email']);
        $vprofile = $profile->validate();
        if ($newfotokitchen) {
            $vnewfotokitchen = Model::validateMultiple($newfotokitchen, ['file']);
        } else {
            $vnewfotokitchen = true;
        }

        // Проверка валидации, ок или показываем ошибки в форме
        if ( !$vthis || !$vnewphonenumber || !$vphonenumber || !$vaddress || !$vuser || !$vprofile || !$vnewfotokitchen ) {
            // echo "<pre>";
            // print_r($user->datebirth);
            // print_r($user->errors);
            // echo "</pre>";
            // die();
            return null;
        }

        // Сохранение валидных моделей, ок или исключение
        $transaction = Yii::$app->db->beginTransaction(Transaction::SERIALIZABLE);
        try {

            if ($profile->validate()) {
                $profile->save();
            } else {
                throw new ErrorException("Не удалось сохранить данные профиля.");
            }
            if ($address->validate()) {
                $address->save();
            } else {
                throw new ErrorException("Не удалось сохранить данные адреса.");
            }
            if ($phonenumber) {
                foreach ($phonenumber as $key => $p) {
                    if (in_array($p->id, $this->leftphonenumber)) {
                        if ($p->validate()) {
                            $p->save();
                        } else {
                            throw new ErrorException("Не удалось сохранить существующий телефон.");
                        }
                    } else {
                        $p->delete();
                    }
                }
            }
            if ($newphonenumber) {
                foreach ($newphonenumber as $key => $p) {
                    $p->user_id = $user->id;
                    if ($p->validate()) {
                        $p->save();
                    } else {
                        throw new ErrorException("Не удалось добавить новый телефон.");
                    }
                }
            }

            if ($phonenumber) {
                $phonenumber_id = $phonenumber[0]->id;
            } else {
                $phonenumber_id = $newphonenumber[0]->id;
            }
            $user->phonenumber_id = $phonenumber_id;
            if ($user->validate()) {
                $user->save();
            } else {
                throw new ErrorException("Не удалось сохранить данные пользователя.");
            }

            if ($fotokitchen) {
                foreach ($fotokitchen as $key => $fk) {
                    if (in_array($fk->id, $this->leftfotokitchen)) {
                    } else {
                        $fk->delete();
                    }
                }
            }
            if ($newfotokitchen) {
                foreach ($newfotokitchen as $key => $fk) {
                    $fk->user_id = $user->id;
                    if ($fk->validate()) {
                        $fk->save();
                    } else {
                        throw new ErrorException("Не удалось сохранить новые фотографии кухонь");
                    }
                }
            }
            if ($fotodoc) {
                foreach ($fotodoc as $key => $fk) {
                    if (in_array($fk->id, $this->leftfotodoc)) {
                    } else {
                        $fk->delete();
                    }
                }
            }
            if ($newfotodoc) {
                foreach ($newfotodoc as $key => $fk) {
                    $fk->user_id = $user->id;
                    if ($fk->validate()) {
                        $fk->save();
                    } else {
                        throw new ErrorException("Не удалось сохранить новые фотографии кухонь");
                    }
                }
            }
        } catch (ErrorException $e) {
            $transaction->rollBack();
            throw $e;
        }
        $transaction->commit();
        return true;
    }
}
