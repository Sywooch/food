<?php
namespace frontend\models;

use yii\base\Model;
use yii\base\ErrorException;
use yii\db\Transaction;
use Yii;
use common\models\Order;
use common\models\Orderproduct;

class OrderUpdateCookForm extends Model
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


	public function update($order)
	{

		$orderValidate = $order->validate();
		$orderProductsValidate = Model::validateMultiple($order->orderproducts);
		if ( !$orderProductsValidate || !$orderValidate ) {
			echo "<pre>";
			print_r($order->errors);
			print_r($order->orderproducts->errors);
			echo "</pre>";
			die();
			return null;
		}

		$transaction = Yii::$app->db->beginTransaction(Transaction::SERIALIZABLE);
		try {
			if ($order->validate()) {
				$order->save();
			} else {
				throw new ErrorException("Не удалось сохранить заказ.");
			}
			foreach ($order->orderproducts as $key => $op) {
				if ($op->validate()) {
					$op->save();
				} else {
					throw new ErrorException("Не удалось сохранить составляющие заказа.");
				}
			}
		} catch (ErrorException $e) {
			$transaction->rollBack();
			throw $e;
		}
		$transaction->commit();
		return $order;
	}
}
