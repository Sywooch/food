<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\User;
use common\models\Notice;
use common\models\Order;
use common\models\Message;

if (isset($user)) {

	$newNoticeQuantity = Notice::find()
		->where(['user_id' => $user->id, 'read' => 0])
		->count();
	User::$topcook['user/notice']['quantity'] = $newNoticeQuantity;

	$newOrderQuantity = Order::find()
		->where(['cook_id' => $user->id, 'status' => Order::STATUS_NEW])
		->count();
	User::$topcook['order/list']['quantity'] = $newOrderQuantity;

	$newMessageQuantity = Message::find()
		->where(['recipient_id' => $user->id, 'read' => '0'])
		->count();
	User::$topcook['message/list']['quantity'] = $newMessageQuantity;
}

?>

	<ul class="menuTop__tabs">

		<?php foreach (User::$topcook as $key => $value): ?>
			<li class="menuTop__item">
				<a href="<?= Url::to([$key]) ?>" class="menuTop__link" <?= (Yii::$app->controller->id.'/'.Yii::$app->controller->action->id === $key)?' style="color:#EE5E29"':'' ?>><?= $value['header'] ?>
					<?php if ($value['quantity']): ?>
						<span class="g-count"><span class="g-count__val"><?= $value['quantity'] ?></span></span>						
					<?php endif ?>
				</a>
			</li>
		<?php endforeach ?>

	</ul>
