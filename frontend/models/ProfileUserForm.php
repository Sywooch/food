<?php
namespace frontend\models;

use common\models\User;
use common\models\Phonenumber;
use common\models\Kitchen;
use common\models\Address;
use common\models\Metrostation;
use yii\db\Transaction;
use yii\helpers\ArrayHelper;
use yii\base\Model;
use Yii;

use yii\web\UploadedFile;

class ProfileUserForm extends Model
{
    public $loadEmpty; // fix no load
	public $leftphonenumber = [];
	public $leftaddresses = [];
	public $leftkitchen = [];
	public $newkitchen = [];

	public function rules()
	{
		return [
            ['loadEmpty', 'string', 'skipOnEmpty' => true],

			['leftphonenumber', 'safe'],
			['leftaddresses', 'safe'],
			['leftkitchen', 'safe'],
			['newkitchen', 'safe'],
		];
	}


	public function attributeLabels()
	{
		return [
		];
	}

	public function update(
		$user,
		$profile,
		$addresses,
		$newaddresses,
		$phonenumbers,
		$newphonenumbers,
		$userkitchens
	) {

		$user_id = Yii::$app->user->identity->id;
		// Файлы
		$profile->icon = UploadedFile::getInstance($profile, 'icon');

		// Валидация
		// Формы
		$vthis = $this->validate();
		// Телефонов
		if ($newphonenumbers) {
			foreach ($newphonenumbers as $key => $p) {
				$p->user_id = $user_id;
			}
		}
		$vnewphonenumbers = ($newphonenumbers)?Model::validateMultiple($newphonenumbers, [
				'phonenumber',
				'viber',
				'whatsapp',
				'vibernumber',
				'whatsappnumber',
		]):true;
		$vphonenumbers = ($phonenumbers)?Model::validateMultiple($phonenumbers):true;
		// Адресов
		if ($newaddresses) {
			foreach ($newaddresses as $key => $a) {
				$a->user_id = $user_id;
				$m = Metrostation::find()->where(['header' => $a->metro_id])->one();
				if ($m) {
					$a->metro_id = $m->id;
				} else {
					$a->metro_id = null;
				}
			}
		}
		if ($addresses) {
			foreach ($addresses as $key => $a) {
				$a->user_id = $user_id;
				$m = Metrostation::find()->where(['header' => $a->metro_id])->one();
				if ($m) {
					$a->metro_id = $m->id;
				} else {
					$a->metro_id = null;
				}
			}
		}
		$vnewaddresses = ($newaddresses)?Model::validateMultiple($newaddresses):true;
		$vaddresses = ($addresses)?Model::validateMultiple($addresses):true;
		// Юзера
		$vuser = $user->validate(['email']);
		// Профиля
		$vprofile = $profile->validate();

		// Проверка валидации, ок или показываем ошибки в форме
		if (
			!$vthis ||
			!$vphonenumbers ||
			!$vnewphonenumbers ||
			!$vaddresses ||
			!$vnewaddresses ||
			!$vuser ||
			!$vprofile
		) {

			// echo "<pre>";
			// // print_r($newaddresses->errors);
			// print_r('vphonenumbers - ' . $vphonenumbers);
			// print_r('vnewphonenumbers - ' . $vnewphonenumbers);
			// print_r('vaddresses - ' . $vaddresses);
			// print_r('vnewaddresses - ' . $vnewaddresses);
			// print_r('vuser - ' . $vuser);
			// print_r('vprofile - ' . $vprofile);


			// echo "</pre>";
			// die();



			// echo "<pre>";
			// print_r($this->errors);
			// foreach ($phonenumbers as $key => $value) {
			// 	print_r($value->errors);
			// }
			// foreach ($newphonenumbers as $key => $value) {
			// 	print_r($value->errors);
			// }
			// foreach ($addresses as $key => $value) {
			// 	print_r($value->errors);
			// }
			// foreach ($newaddresses as $key => $value) {
			// 	print_r($value->errors);
			// }
			// print_r($user->errors);
			// print_r($profile->errors);
			// echo "</pre>";
			// die();
			return null;
		}

		$transaction = Yii::$app->db->beginTransaction(Transaction::SERIALIZABLE);
		try {
			// $user->save();
			// $profile->save();
            if ($profile->validate()) {
                $profile->save();
            } else {
                throw new ErrorException("Не удалось сохранить данные профиля.");
            }
			if ($newphonenumbers) {
				foreach ($newphonenumbers as $key => $p) {
					if ($p->validate()) {
						$p->save();
					} else {
						throw new ErrorException("Не удалось сохранить новые номера телефонов.");
					}
				}
			}
			if ($phonenumbers) {
				foreach ($phonenumbers as $key => $p) {
					if (in_array($p->id, $this->leftphonenumber)) {
						if ($p->validate()) {
							$p->save();
						} else {
							throw new ErrorException("Не удалось сохранить номера телефонов.");
						}
					} else {
						$p->delete();
					}
				}
			}
            if ($phonenumbers) {
                $phonenumber_id = $phonenumbers[0]->id;
            } else {
                $phonenumber_id = $newphonenumbers[0]->id;
            }
            $user->phonenumber_id = $phonenumber_id;
            if ($user->validate()) {
                $user->save();
            } else {
                throw new ErrorException("Не удалось сохранить данные пользователя.");
            }
			if ($newaddresses) {
				foreach ($newaddresses as $key => $a) {
					if ($a->validate()) {
						$a->save();
					} else {
						throw new ErrorException("Не удалось сохранить новые адреса.");
					}
				}
			}
			if ($addresses) {
				foreach ($addresses as $key => $a) {
					if (in_array($a->id, $this->leftaddresses)) {
						if ($a->validate()) {
							$a->save();
						} else {
							throw new ErrorException("Не удалось сохранить адреса.");
						}
					} else {
						$a->delete();
					}
				}
			}
			if ($userkitchens) {
				foreach ($userkitchens as $key => $k) {
					if (in_array($k->id, $this->leftkitchen)) {
					} else {
						$user->unlink('kitchen', $k, true);
					}
				}
			}
			if ($this->newkitchen) {
				$this->newkitchen = array_unique($this->newkitchen);
				foreach ($this->newkitchen as $key => $header) {
					$k = Kitchen::find()->where(['header' => $header])->one();
					if ($k && !in_array($k->id, $this->leftkitchen)) {
						$user->link('kitchen', $k);
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
