<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
use common\models\User;
use common\models\Order;
use common\models\Metrostation;

$this->title = 'Заказ №' . $order->id;

$this->params['breadcrumbs'][] = ['label' => 'Мои заказы', 'url' => ['order/list'], 'class' => 'breadcrumbs__link'];

$this->params['breadcrumbs'][] = ['label' => 'Заказ №' . $order->id];

?>

<aside class="l-sidebar l-sidebar_left">

	<?= $this->render('/user/left'.$user->usertype, [
	]) ?>

</aside>
<div class="g-flexMiddleChild middleWrapper">

	<div class="menuTop">

		<?= $this->render('/user/top-menu-'.$user->usertype, [
			'user' => $user,
		]) ?>

		<div>
			<?php if ($user->usertype == User::TYPE_USER): ?>
				<?php if ($order->status == Order::STATUS_NEW): ?>
					<a href="<?= Url::to(['order/update', 'id' => $order->id]) ?>" class="g-link g-link_mr20">Редактировать</a>
				<?php endif ?>
			<?php endif ?>
			<?php if ($user->usertype == User::TYPE_COOK): ?>
				<?php if ( $order->status != Order::STATUS_DELETE || $order->status != Order::STATUS_PERFORM ): ?>
					<a href="<?= Url::to(['order/update', 'id' => $order->id]) ?>" class="g-link g-link_mr20">Редактировать</a>
				<?php endif ?>
			<?php endif ?>
		</div>

	</div>

	<?= Breadcrumbs::widget([
		'options' => [
			'class' => 'breadcrumbs',
		],
		'itemTemplate' => '<li class="breadcrumbs__item">{link}</li>',
		'activeItemTemplate' => '<li class="breadcrumbs__item">{link}</li>',
		'homeLink' => [
			'label' => 'Главная',
			'url' => Yii::$app->homeUrl,
			'class' => 'breadcrumbs__link',
		],
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]) ?>


	<div class="middleWrapper__container">
		<div class="headerBox">
			<h1 class="headerBox__title">Просмотр и обсуждение заказа №<?= $order->id ?> от <?= date('d.m.Y', strtotime($order->created_at)) ?></h1>
		</div>
	</div>
	<div class="form__border"></div>
	<h4 class="form__header">???</h4>
	<div class="form__colWrapper form__colWrapper_pl0 form__colWrapper_mb0">
		<div class="form__leftCol form__leftCol_w65">
			<div class="form__section">
				<div class="form__line">
					<label class="form__label" for="">Статус заказа:</label>
					<div class="form__val section_500" type="text"><?= Order::$statusName[$order->status] ?></div>
				</div>
				<div class="form__line">
					<label class="form__label" for="">Покупатель:</label>
					<div class="form__val section_500" type="text"><?= $order->user->username ?></div>
				</div>
				<div class="form__line">
					<label class="form__label" for="">Кулинар:</label>
					<div class="form__val section_500" type="text"><?= $order->cook->username ?></div>
				</div>
				<div class="form__line form__line_centeredContent form__line_top">
					<label class="form__label" for="">Способ доставки:</label>
					<div class="checkOptions">
						<div class="checkOptions__wrap">
							<div class="checkOptions__name"><?= Order::$deliveryName[$order->delivery] ?></div>
						</div>
					</div>
					<?php if ($order->metro_id): ?>
						<label class="form__label" for="">Метро:</label>
						<div class="checkOptions">
							<div class="checkOptions__wrap">
								<div class="checkOptions__name"><?= $order->metro->header ?></div>
							</div>
						</div>
					<?php endif ?>
				</div>
			</div>
			<?php if ($order->address): ?>
				<div class="form__border"></div>
				<h4 class="form__header">Адрес доставки</h4>
				<div class="form__section">
					<div class="form__line form__line_centeredContent">
						<label for="" class="form__label">Адрес:</label>
						<div class="form__val section_500 form__val_ph"><?= $order->address ?></div>
					</div>
					<?php if ($order->addressdescription): ?>
						<div class="form__line form__line_ml230 section_500 form__line_centeredContent">
							<div class="form__val form__val_italic form__val_wide"><?= $order->addressdescription ?></div>
						</div>
					<?php endif ?>
				</div>
			<?php endif ?>
		</div>
	</div>


	<div class="form__border"></div>
	<h4 class="form__header">Содержание заказа</h4>
	<div class="form__section">
		<div class="form__colWrapper">
			<table class="table">
				<thead class="table__head">
					<tr class="table__row">
						<td class="table__cell table__cell_w55 table__cell_p0 table__cell_h55 table__cell_bordered">Фото</td>
						<td class="table__cell table__cell_minW155 table__cell_plr20 table__cell_h55 table__cell_bordered">Наименование</td>
						<td class="table__cell table__cell_minW155 table__cell_plr20 table__cell_h55 table__cell_bordered">Цена за единицу</td>
						<td class="table__cell table__cell_minW155 table__cell_plr20 table__cell_h55 table__cell_bordered">Количество</td>
						<td class="table__cell table__cell_minW155 table__cell_plr20 table__cell_h55 table__cell_bordered">Стоимость общая</td>
					</tr>
				</thead>
				<tbody>
					<?php $fullsum = 0; ?>
					<?php foreach ($order->orderproducts as $key => $op): ?>
						<?php $fullsum+= $op->amount; ?>
						<tr class="table__row">
							<td class="table__cell table__cell_w55 table__cell_h55 table__cell_p0 table__cell_bordered table__cell_fz0"><img class="table__img" src="<?= $op->product->productfoto->getSource('icon') ?>" alt=""></td>
							<td class="table__cell table__cell_minW155 table__cell_plr20 table__cell_h55 table__cell_bordered"><?= $op->product->header ?></td>
							<td class="table__cell table__cell_minW155 table__cell_plr20 table__cell_h55 table__cell_bordered"><?= $op->product->pricesale?$op->product->pricesale:$op->product->price ?> руб.</td>
							<td class="table__cell table__cell_minW155 table__cell_p0 table__cell_h55 table__cell_bordered">
								<div class="table__count"><?= $op->quantity ?></div>
							</td>
							<td class="table__cell table__cell_minW155 table__cell_p0 table__cell_h55 table__cell_bordered">
								<div class="table__count"><?= $op->amount ?> руб.</div>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>

			<div class="form__section">
				<div class="form__line form__line_centeredEnd form__line_mb15 form__line_pr39">
					<label for="" class="form__label form__label_mainColor">Стоимость заказа:</label>
					<div class="form__val form__val_bbn form__val_order"><?= $fullsum ?> руб.</div>
				</div>
				<div class="form__line form__line_centeredEnd form__line_mb15 form__line_pr39">
					<label for="" class="form__label form__label_mainColor">Стоимость доставки:</label>
					<div class="form__val form__val_bbn form__val_order"><?= $order->costdelivery ?> руб.</div>
				</div>
				<div class="form__line form__line_centeredEnd form__line_mb15 form__line_pr39">
					<label for="" class="form__label form__label_mainColor">Бонусы:</label>
					<div class="form__val form__val_bbn form__val_order">999999999999 руб.</div>
				</div>
				<div class="form__line form__line_centeredEnd form__line_mb15 form__line_pr39">
					<label for="" class="form__label">Итого:</label>
					<div class="form__val form__val_bbn form__val_order form__val_bold"><?= $order->amount ?> руб.</div>
				</div>
			</div>
		</div>
	</div>

	<div class="form__border"></div>
	<h4 class="form__header">Способ оплаты</h4>
	<div class="form__section">
		<div class="form__colWrapper">
			<div class="form__line form__line_centeredContent form__line_top form__line_ml230">
				<div class="checkOptions">
					<div class="checkOptions__wrap">
						<div class="checkOptions__name"><?= Order::$payName[$order->pay] ?></div>
					</div>
				</div>
			</div>
			<?php if ($order->promocode): ?>
				<label class="form__label" for="">Промокод:</label>
				<div class="checkOptions">
					<div class="checkOptions__wrap">
						<div class="checkOptions__name"><?= $order->promocode ?></div>
					</div>
				</div>
			<?php endif ?>
		</div>
	</div>
	<?php if ($order->description): ?>
		<div class="form__border"></div>
		<h4 class="form__header">Комментарий к заказу</h4>
		<div class="form__section">
			<div class="form__line">
				<p class="form__placeholder form__placeholder_centBig"><?= $order->description ?></p>
			</div>
		</div>
	<?php endif ?>




</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('/site/right', [
	]) ?>

</aside>