<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;

?>





<aside class="l-sidebar l-sidebar_left">

	<?= $this->render('left', [
	]); ?>

</aside>
<div class="g-flexMiddleChild middleWrapper">
	
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
			<h1 class="headerBox__title">Корзина</h1>
		</div>

		<?php if ($basket): ?>
			<?php $first = true; ?>
			<?php $lastcook = false; ?>
			<?php $fullsum = 0; ?>
			<?php foreach ($basket as $key => $b): ?>
				<?php if ($b['cookid']!==$lastcook): ?>
					<?php if ($first): ?>
						<?php $first = false; ?>
					<?php else: ?>
</tbody>
</table>
<div class="form__section">
<div class="form__section">
<div class="form__line form__line_centeredEnd form__line_mb15 pr66">
<label for="" class="form__label">Итого:</label>
<input class="form__val form__val_bbn form__val_order form__val_bold" value="<?= $fullsum ?> руб." readonly="" type="text">
</div>
<div class="form__line form__line_centeredEnd form__line_mb15 pr81">
<input type="submit" name="submit" class="g-button mr44" value="Оформить заказ">
</div>
</div>
</div>
</div>
</div>
</div>
</form>
						<?php $fullsum = 0; ?>
					<?php endif ?>
					<p>От повара: <?= $products[$key]->user->username ?></p>
					<form action="<?= Url::to(['order/ordercreate', 'id' => $products[$key]->user->id]) ?>" method="post">
					<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
					<input type="hidden" name="cookid" value="<?= $products[$key]->user->id ?>" />

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
					<?php $lastcook = $b['cookid']; ?>
				<?php endif ?>
					<tr class="table__row">
						<td class="table__cell table__cell_w55 table__cell_h55 table__cell_p0 table__cell_bordered table__cell_fz0"><img class="table__img" src="<?= $products[$key]->getIconsrc('icon') ?>" alt=""></td>
						<td class="table__cell table__cell_minW155 table__cell_plr20 table__cell_h55 table__cell_bordered"><?= $products[$key]->header ?>
							<input type="hidden" name="productid[]" value="<?= $products[$key]->id ?>">
						</td>
						<?php $price = round($products[$key]->pricesale?$products[$key]->pricesale:$products[$key]->price); ?>
						<td class="table__cell table__cell_minW155 table__cell_plr20 table__cell_h55 table__cell_bordered"><?= $price ?> руб.</td>
						<td class="table__cell table__cell_minW155 table__cell_p0 table__cell_h55 table__cell_bordered">
							<!-- <div class="table__count"><?//= $b['count'] ?></div> -->
							<input class="table__count" name="count[]" type="text" value="<?= $b['count'] ?>" />
							<div class="table__toolsBox">
								<div class="table__btn table__btn_more js-table__btn_more"></div>
								<div class="table__btn table__btn_less js-table__btn_less"></div>
							</div>
						</td>
						<td class="table__cell table__cell_minW155 table__cell_p0 table__cell_h55 table__cell_bordered">
							<div class="table__count"><?= $b['sum'] ?> руб.</div>
							<?php $fullsum+= $b['sum']; ?>
							<!-- <input class="table__count" type="text" name="sum[]" value="<?//= $b['sum'] ?>"> руб. -->
							<!-- <div class="table__toolsBox table__toolsBox_t13">
								<div class="form__edit form__edit_order js-form__edit_price"></div>
							</div> -->
						</td>
						<td class="table__cell table__cell_wa table__cell_plr20 table__cell_h55 table__cell_bgn"><div class="table__remove"></div></td>
					</tr>
			<?php endforeach ?>
				</tbody>
			</table>
			<div class="form__section">
				<div class="form__section">
					<div class="form__line form__line_centeredEnd form__line_mb15 pr66">
						<label for="" class="form__label">Итого:</label>
						<input class="form__val form__val_bbn form__val_order form__val_bold" value="<?= $fullsum ?> руб." readonly="" type="text">
					</div>
					<div class="form__line form__line_centeredEnd form__line_mb15 pr81">
						<input type="submit" name="submit" class="g-button mr44" value="Оформить заказ">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
			</form>
		<?php else: ?>
			<p>Корзина пуста.</p>
		<?php endif ?>
	</div>

</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('right', [
	]); ?>

</aside>
