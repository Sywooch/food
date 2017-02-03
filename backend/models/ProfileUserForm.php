<?php
namespace backend\models;

use yii\base\Model;
use common\models\User;
use common\models\Kitchen;
use common\models\ProfileUser;
use yii\web\UploadedFile;
use yii\db\Transaction;
use Yii;
use Exception;

class ProfileUserForm extends Model
{
	public $user_id;
	public $iconsrc;
	public $del_icon;
	public $kitchen;
	public $icon;

	public function rules()
	{
		return [
			['kitchen', 'each', 'rule' => [
				'exist',
				'targetClass' => Kitchen::className(),
				'targetAttribute' => 'id',
			]],
		];
	}

	public function attributeLabels()
	{
		return [
			'user_id' => 'Ид. покупателя',
			'kitchen' => 'Предпочтение к кухням',
			'icon' => 'Загрузить аватар',
			'del_icon' => 'Удалить аватар',
		];
	}

	public function create($profileUser)
	{
		$profileUser->icon = UploadedFile::getInstance($profileUser, 'icon');
		if (!$profileUser->validate()) {
			return null;
		}
		if (!$this->validate()) {
			return null;
		}
		$transaction = Yii::$app->db->beginTransaction(Transaction::SERIALIZABLE);
		try {
			$user = User::findOne($profileUser->user_id);
			$profileUser->save();
			if (!empty($this->kitchen)) {
				foreach ($this->kitchen as $key => $k) {
					$kitchen = Kitchen::findOne($k);
					$user->link('kitchen', $kitchen);
				}
			}
		} catch (Exception $e) {
			$transaction->rollBack();
			throw $e;
		}
		$transaction->commit();
		return $profileUser;
	}

	public function update($user, $profileUser)
	{
		$profileUser->icon = UploadedFile::getInstance($profileUser, 'icon');
		if (!$profileUser->validate()) {
			return null;
		}
		if (!$this->validate()) {
			return null;
		}
		$transaction = Yii::$app->db->beginTransaction(Transaction::SERIALIZABLE);
		try {
			$profileUser->save();
			$user->unlinkAll('kitchen', true);
			if (!empty($this->kitchen)) {
				foreach ($this->kitchen as $key => $k) {
					$kitchen = Kitchen::findOne($k);
					$user->link('kitchen', $kitchen);
				}
			}
		} catch (Exception $e) {
			$transaction->rollBack();
			throw $e;
		}
		$transaction->commit();
		return $profileUser;
	}
}
