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

class ProfileCookForm extends Model
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

	public function create($profile)
	{
		// echo "<pre>";
		// print_r($this);
		// echo "</pre>";
		// die();
		$profile->icon = UploadedFile::getInstance($profile, 'icon');
		if (!$profile->validate()) {
			// echo "<pre>";
			// print_r($profile->errors);
			// echo "</pre>";
			// die();
			return null;
		}
		if (!$this->validate()) {
			// echo "<pre>";
			// print_r($this);
			// echo "</pre>";
			// die();
			return null;
		}
		$transaction = Yii::$app->db->beginTransaction(Transaction::SERIALIZABLE);
		try {
			$user = User::findOne($profile->user_id);
			$profile->save();
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
		return $profile;
	}

	public function update($user, $profile)
	{
		$profile->icon = UploadedFile::getInstance($profile, 'icon');
		if (!$profile->validate()) {
			return null;
		}
		if (!$this->validate()) {
			return null;
		}
		$transaction = Yii::$app->db->beginTransaction(Transaction::SERIALIZABLE);
		try {
			$profile->save();
		} catch (Exception $e) {
			$transaction->rollBack();
			throw $e;
		}
		$transaction->commit();
		return $profile;
	}
}
