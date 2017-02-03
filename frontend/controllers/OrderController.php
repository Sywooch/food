<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\OrderCreateForm;
use frontend\models\OrderUpdateCookForm;
use common\models\User;
use common\models\Metrostation;
use common\models\Product;
use common\models\Order;
use yii\helpers\ArrayHelper;
use yii\base\Model;

class OrderController extends Controller
{

	public function behaviors()
	{
		return [
			'access' => [
				'class' => \yii\filters\AccessControl::className(),
				'only' => ['ordercreate'],
				'rules' => [
					[
						'actions' => ['ordercreate'],
						'allow' => true,
						'matchCallback' => function ($rule, $action) {
							return Yii::$app->user->identity && (Yii::$app->user->identity->usertype === User::TYPE_USER);
						}
					],
				],
			],
		];
	}

	public function actionList()
	{
		$user = User::findOne(Yii::$app->user->identity->id);
		switch ($user->usertype) {
			case User::TYPE_USER :
				$orders = Order::find()
					->with(['cook'])
					->where(['user_id' => $user->id])
					->orderBy('created_at desc, id desc')
					->all();
				return $this->render('list-user', [
					'user' => $user,
					'orders' => $orders,
				]);
				break;
			case User::TYPE_COOK :
				$orders = Order::find()
					->with(['user'])
					->where(['cook_id' => $user->id])
					->orderBy('created_at desc, id desc')
					->all();
				return $this->render('list-cook', [
					'user' => $user,
					'orders' => $orders,
				]);
				break;
		}
	}

	public function actionView($id)
	{
		$user = User::findOne(Yii::$app->user->identity->id);
		switch ($user->usertype) {
			case User::TYPE_USER :
				$order = Order::find()->where(['user_id' => $user->id, 'id' => $id])->one();
				break;
			case User::TYPE_COOK :
				$order = Order::find()->where(['cook_id' => $user->id, 'id' => $id])->one();
				break;
		}
		return $this->render('orderview', [
			'user' => $user,
			'order' => $order,
		]);
	}

	public function actionOrdercreate()
	{
		// 
		$orderCreateForm = new OrderCreateForm();
		// $cookid = $id;
		// $cook = User::find()->where(['id'=>$cookid, 'usertype' => User::TYPE_COOK])->one();

		// $order = new Order();

		$session = Yii::$app->session;
		$basket = $session->get('basket');

		$productids = array_keys($basket);
		$products = Product::findAll($productids);
		$products = ArrayHelper::index($products, 'id');

		$cookIds = ArrayHelper::getColumn($basket, 'cookid');
		$cookIds = array_unique($cookIds);
		$cooks = User::findAll($cookIds);
		
		// if (Yii::$app->request->post('productid')) {
		// 	foreach ($basket as $productidBasket => $b) {
		// 		foreach ($_POST['productid'] as $key => $productidPost) {
		// 			if ($productidBasket == $productidPost) {
		// 				$basket[$productidBasket]['count'] = $_POST['count'][$key];
		// 				$basket[$productidBasket]['sum'] = $_POST['count'][$key]*($products[$productidBasket]->pricesale?$products[$productidBasket]->pricesale:$products[$productidBasket]->price);
		// 			}
		// 		}
		// 	}
		// 	$session->set('basket', $basket);
		// }

		$user = Yii::$app->user->identity;
		if (!$user) {
			throw new \yii\web\NotFoundHttpException('Пользователь не авторизован');
		}


		$orderCreateForm->username = $user->username;
		$orderCreateForm->phonenumber = $user->phonenumber[0]->phonenumber;
		$orderCreateForm->email = $user->email;

		foreach ($cooks as $key => $c) {
			$order = new Order();
			$order->cook_id = $c->id;
			$order->user_id = $user->id;
			$order->username = $user->username;
			$order->status = Order::STATUS_NEW;
			$cId = $c->id;
			$amount = ArrayHelper::getColumn($basket, function ($element, $cId) { return ($element['cookid']==$cId)?$element['sum']:0; });
			$order->amount = array_sum($amount);
			$orders[] = $order;
		}


		if (Yii::$app->request->post('Order')) {
			if (
				$order->load(Yii::$app->request->post()) &&
				$orderCreateForm->load(Yii::$app->request->post())
			) {
				if ($returnOrder = $orderCreateForm->create($order,$products,$user,$cook,$basket)) {
					$this->redirect(['order/view', 'id' => $returnOrder->id]);
				}
			} else {
				echo "<pre>";
				print_r('не загружено');
				echo "</pre>";
				die();
			}
		}

		return $this->render('ordercreate', [
			'orders' => $orders,
			'orderCreateForm' => $orderCreateForm,
			'user' => $user,
			'basket' => $basket,
			// 'cookid' => $cookid,
			'cooks' => $cooks,
			'products' => $products,
		]);
	}

	public function actionUpdate($id)
	{
		$user = Yii::$app->user->identity;
		switch ($user->usertype) {
			case User::TYPE_USER:
				$order = Order::find()->where(['user_id' => $user->id, 'id' => $id])->one();
				return $this->render('update-user', [
					'user' => $user,
					'order' => $order,
				]);
				break;
			case User::TYPE_COOK:
				$order = Order::find()
					->with(['user', 'cook', 'orderproducts'])
					->where(['cook_id' => $user->id, 'id' => $id])->one();
				$orderUpdateCookForm = new OrderUpdateCookForm();
				if (Yii::$app->request->post()) {
					if (
						$order->load(Yii::$app->request->post()) &&
						Model::loadMultiple($order->orderproducts, Yii::$app->request->post())
					) {
						if ($returnOrder = $orderUpdateCookForm->update($order)) {
							$this->redirect(['order/orderview', 'id' => $returnOrder->id]);
						}
					} else {
						echo "<pre>";
						print_r('не загружено');
						print_r($_POST);
						echo "</pre>";
						die();
					}
				}
				return $this->render('update-cook', [
					'user' => $user,
					'order' => $order,
				]);
				break;
		}
	}

}