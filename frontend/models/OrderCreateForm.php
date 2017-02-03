<?php
namespace frontend\models;

use yii\helpers\Html;
use yii\base\Model;
use yii\base\ErrorException;
use yii\db\Transaction;
use Yii;
use common\models\Order;
use common\models\Orderproduct;
use common\models\Notice;

class OrderCreateForm extends Model
{
	public $username;
	public $phonenumber;
	public $email;
	public $metroheader;

	public function rules()
	{
		return [
			['username', 'required'],
			['username', 'string'],

			['phonenumber', 'required'],
			['phonenumber', 'string'],

			['email', 'required'],
			['email', 'string'],

			['metroheader', 'string'],
		];
	}

	public function attributeLabels()
	{
		return [
			'metroheader' => 'Наименование метро',
		];
	}


	public function create($order,$products,$user,$cook,$basket)
	{
		$order->user_id = $user->id;
		$order->cook_id = $cook->id;
		$order->status = Order::STATUS_NEW;
		switch ($order->delivery) {
			case Order::DELIVERY_PICKUP:
				$order->costdelivery = 0;
				break;
			default:
				$order->costdelivery = $cook->profile->costdelivery;
				break;
		}

		$orderValidate = $order->validate();
		$thisValidate = $this->validate();
		if ( !$thisValidate || !$orderValidate ) {
			// echo "<pre>";
			// print_r($order->errors);
			// print_r($this->errors);
			// echo "</pre>";
			// die();
			return null;
		}

        $transaction = Yii::$app->db->beginTransaction(Transaction::SERIALIZABLE);
        try {
        	if ($order->validate()) {
        		$order->save();
        	} else {
        		throw new ErrorException("Не удалось сохранить заказ.");
        	}
        	foreach ($basket as $key => $b) {
        		if ($b['cookid'] == $cook->id) {
        			$orderproduct = new Orderproduct();
        			$orderproduct->order_id = $order->id;
        			$orderproduct->product_id = $key;
        			$orderproduct->quantity = $b['count'];
        			$orderproduct->amount = $b['sum'];
        			if ($orderproduct->validate()) {
        				$orderproduct->save();
        			} else {
        				throw new ErrorException("Не удалось сохранить объект корзины в заказ.");
        			}
        		}
        	}
        	$notice = new Notice();
        	$notice->user_id = $cook->id;
        	$notice->author_id = $user->id;
        	$notice->text = 'От пользователя поступил ' . Html::a('заказ', ['order/view', 'id' => $order->id]);
        	if ($notice->validate()) {
        		$notice->save();
        	} else {
				throw new ErrorException("Не удалось сформировать уведомление для повара.");
        	}
        } catch (ErrorException $e) {
            $transaction->rollBack();
            throw $e;
        }
        $transaction->commit();
        return $order;
	}
}
