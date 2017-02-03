<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use common\models\Order;

$this->title = 'Редактирование заказа';

$this->params['breadcrumbs'][] = ['label' => 'Редактирование заказа'];

?>

<aside class="l-sidebar l-sidebar_left">

	<?= $this->render('/user/leftcook', [
	]) ?>

</aside>
<div class="g-flexMiddleChild middleWrapper">

	<div class="menuTop">

		<?= $this->render('/user/top-menu-cook', [
			'user' => $user,
		]) ?>

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
			<h1 class="headerBox__title"><span class="headerBox__orange">Заказ <?= $order->id ?></span> от <?= date('d.m.Y', strtotime($order->created_at)) ?></h1>
		</div>
	</div>
	<form action="<?= Url::to(['order/update', 'id' => $order->id]) ?>" class="form" method="post">
		<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
		<div class="form__border"></div>
		<h4 class="form__header">Общая информация</h4>
		<div class="form__section">
			<div class="form__colWrapper">
				<div class="form__leftCol form__leftCol_w65">
					<div class="form__line form__line_centeredContent">
						<label for="" class="form__label">Клиент:</label>
						<input name="Order[username]" type="text" class="form__val section_500" value="<?= $order->user->username ?>" readonly />
						<div class="form__edit form__edit_order js-form__edit_order"></div>
					</div>
					<div class="form__line form__line_centeredContent">
						<label for="" class="form__label">E-mail:</label>
						<input name="Order[email]" type="text" class="form__val section_500" value="<?= $order->user->email ?>" readonly />
						<div class="form__edit form__edit_order js-form__edit_order"></div>
					</div>
					<div class="form__line form__line_centeredContent">
						<label for="" class="form__label">Телефон:</label>
						<input name="Order[phonenumber]" type="text" class="form__val section_500" value="<?= $order->phonenumber ?>" readonly />
						<div class="form__edit form__edit_order js-form__edit_order"></div>
					</div>
					<div class="form__line form__line_centeredContent">
						<label for="" class="form__label">Доставка:</label>
						<input name="Order[deliverytext]" type="text" class="form__val section_500" value="<?= $order->deliverytext ?>" readonly />
						<div class="form__edit form__edit_order js-form__edit_order"></div>
						<div class="form__mapIcon"></div>
					</div>
					<div class="form__line form__line_centeredContent">
						<label for="" class="form__label">Комментарий:</label>
						<input name="Order[deliverydescription]" type="text" class="form__val section_500" value="<?= $order->deliverydescription ?>" readonly />
						<div class="form__edit form__edit_order js-form__edit_order"></div>
					</div>

				</div>
				<div class="form__rightCol form__rightCol_w35">
					<div class="searchBox searchBox_m0-0-20">
						<div class="searchBox__wrapper">
							<!-- <input type="text" class="g-input g-input_mr0 g-input_w235 js-input_searchBox" placeholder="Кухня ..." /> -->
							<!-- <input class="js-hidden_input" type="hidden">
							<div class="searchBox__header js-searchBox__header js-input_searchBox">Статус заказа ...</div>
							<div class="searchBox__select searchBox__select_r10px js-searchBox__arr">Выбрать</div>
							<ul class="searchBox__list" style="display: none;">
								<li data-value="1" class="searchBox__listItem">Готовится</li>
								<li data-value="2" class="searchBox__listItem">Приготовлен</li>
								<li data-value="3" class="searchBox__listItem">В пути</li>
								<li data-value="4" class="searchBox__listItem">Доставлен</li>
							</ul> -->
							<label class="select_default">
								<select name="Order[status]">
									<?php foreach (Order::$statusName as $key => $sn): ?>
										<option value="<?= $key ?>"<?= ($order->status == $key)?' selected':'' ?>><?= $sn ?></option>
									<?php endforeach ?>
								</select>
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form__border"></div>
		<h4 class="form__header">Содержание заказа</h4>
		<div class="form__section">
			<div class="form__colWrapper">
				<div class="form__leftCol form__leftCol_tac form__leftCol_w65">

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

	<?php foreach ($order->orderproducts as $key => $op): ?>
		
		<tr class="table__row">
			<td class="table__cell table__cell_w55 table__cell_h55 table__cell_p0 table__cell_bordered table__cell_fz0"><img class="table__img" src="<?= $op->product->productfoto->getSource('icon') ?>" alt=""></td>
			<td class="table__cell table__cell_minW155 table__cell_plr20 table__cell_h55 table__cell_bordered"><?= $op->product->header ?></td>
			<td class="table__cell table__cell_minW155 table__cell_plr20 table__cell_h55 table__cell_bordered"><?= $op->product->pricesale?$op->product->pricesale:$op->product->price ?> руб.</td>
			<td class="table__cell table__cell_minW155 table__cell_p0 table__cell_h55 table__cell_bordered">
				<input name="Orderproduct[<?= $key ?>][quantity]" class="table__count" type="text" value="<?= $op->quantity ?>">
				<div class="table__toolsBox">
					<div class="table__btn table__btn_more js-table__btn_more"></div>
					<div class="table__btn table__btn_less js-table__btn_less"></div>
				</div>
			</td>
			<td class="table__cell table__cell_minW155 table__cell_p0 table__cell_h55 table__cell_bordered">
				<div class="table__count"><?= $op->amount ?> руб.</div>
				<div class="table__toolsBox table__toolsBox_t13">
					<div class="form__edit form__edit_order js-form__edit_price"></div>
				</div>
			</td>
			<td class="table__cell table__cell_wa table__cell_plr20 table__cell_h55 table__cell_bgn"><div class="table__remove"></div></td>
		</tr>

	<?php endforeach ?>

	</tbody>
</table>

					<div class="form__section">
						<div class="form__line form__line_centeredEnd form__line_mb15 form__line_pr39">
							<label for="" class="form__label form__label_mainColor">Стоимость заказа:</label>
							<input class="form__val form__val_bbn form__val_order" value="1600 руб." readonly="" type="text">
							<div class="form__edit form__edit_order js-form__edit_order"></div>
						</div>
						<div class="form__line form__line_centeredEnd form__line_mb15 form__line_pr39">
							<label for="" class="form__label form__label_mainColor">Стоимость доставки:</label>
							<input name="Order[costdelivery]" class="form__val form__val_bbn form__val_order" value="<?= $order->costdelivery ?>" readonly="" type="text">
							<div class="form__edit form__edit_order js-form__edit_order"></div>
						</div>
						<div class="form__line form__line_centeredEnd form__line_mb15 form__line_pr39">
							<label for="" class="form__label form__label_mainColor">Бонусы:</label>
							<input class="form__val form__val_bbn form__val_order" value="999999999999999999999 руб." readonly="" type="text">
							<div class="form__edit form__edit_order js-form__edit_order"></div>
						</div>
						<div class="form__line form__line_centeredEnd form__line_mb15 form__line_pr39">
							<label for="" class="form__label">Итого:</label>
							<input name="Order[amount]" class="form__val form__val_bbn form__val_order form__val_bold" value="<?= $op->amount ?>" readonly="" type="text">
							<div class="form__edit form__edit_order js-form__edit_order"></div>
						</div>
					</div>
				</div>
				<div class="form__rightCol form__rightCol_w35">
					<a href="#" class="g-link">Добавить блюдо</a>
				</div>
			</div>
			<div class="form__border"></div>
			<h4 class="form__header">Комментарии для повара</h4>
			<div class="form__section">
				<div class="form__colWrapper">
					<div class="form__leftCol form__leftCol_tac form__leftCol_w65 pl24">
						<textarea type="text" class="form__placeholder" placeholder="Введите комментарий"></textarea>
					</div>
				</div>
			</div>
		</div>
		<div class="form__border"></div>
		<div class="form__section">
			<div class="form__line form__line_centeredContent pl55">
				<input name="submit" type="submit" class="g-button g-button_green g-m_r15" value="Сохранить">
			</div>
		</div>
	</form>




</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('/site/right', [
	]) ?>

</aside>