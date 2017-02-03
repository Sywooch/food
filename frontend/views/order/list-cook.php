<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
use common\models\Order;

$this->title = 'Заказы';

$this->params['breadcrumbs'][] = ['label' => 'Заказы'];

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
								<h1 class="headerBox__title">Мои заказы</h1>
							</div>

							<div class="orderHistory">
								<div class="orderHistory__links">
									<a href="#" class="g-link orderHistory__link">Новые</a>
									<a href="#" class="g-link orderHistory__link">В работе</a>
									<a href="#" class="g-link orderHistory__link">Выполненные</a>
									<a href="#" class="g-link orderHistory__link">Отменён</a>
									<a href="#" class="g-link orderHistory__link">Все</a>
								</div>
								<table class="table">
									<thead class="table__head">
										<tr class="table__row">
											<td class="table__cell table__cell_bordered">Статус</td>
											<td class="table__cell table__cell_bordered">Номер заказаНомер заказаНомер заказаНомер заказаНомер заказаНомер заказаНомер заказа</td>
											<td class="table__cell table__cell_bordered">Заказчик</td>
											<td class="table__cell table__cell_bordered">Дата</td>
											<td class="table__cell table__cell_bordered">Сумма</td>
											<td class="table__cell table__cell_bordered">Действие</td>
											<td class="table__cell table__cell_bordered">Обсуждение заказа</td>
										</tr>
									</thead>
									<tbody>

										<?php foreach ($orders as $key => $o): ?>
											<tr class="table__row">
												<td class="table__cell table__cell_plr20 table__cell_bordered"><?= Order::$statusName[$o->status] ?></td>
												<td class="table__cell table__cell_plr20 table__cell_bordered"><a href="<?= Url::to(['order/orderview', 'id' => $o->id]) ?>"><?= $o->id ?></a></td>
												<td class="table__cell table__cell_plr20 table__cell_bordered"><?= $o->username ?> (<?= $o->user->username ?>)</td>
												<td class="table__cell table__cell_plr20 table__cell_bordered"><?= date('Y-m-d', strtotime($o->created_at)) ?></td>
												<td class="table__cell table__cell_plr20 table__cell_bordered"><?= $o->amount ?> руб.</td>
												<td class="table__cell table__cell_plr20 table__cell_bordered"><a class="table__link" href="<?= Url::to(['order/orderupdate', 'id' => $o->id]) ?>">Редактировать</a></td>
												<td class="table__cell table__cell_plr20 table__cell_bordered"><a class="table__link" href="#">2 комментария</a></td>
												<td class="table__cell table__cell_wa table__cell_plr20 table__cell_h55 table__cell_bgn"><div class="table__remove"></div></td>
											</tr>
										<?php endforeach ?>

										<!-- <tr class="table__row">
											<td class="table__cell table__cell_plr20 table__cell_bordered">Новый</td>
											<td class="table__cell table__cell_plr20 table__cell_bordered">23653</td>
											<td class="table__cell table__cell_plr20 table__cell_bordered">Иванов Илья</td>
											<td class="table__cell table__cell_plr20 table__cell_bordered">26.03</td>
											<td class="table__cell table__cell_plr20 table__cell_bordered">1250 р.</td>
											<td class="table__cell table__cell_plr20 table__cell_bordered"><a class="table__link" href="#">Редактировать</a></td>
											<td class="table__cell table__cell_plr20 table__cell_bordered"><a class="table__link" href="#">2 комментария</a></td>
											<td class="table__cell table__cell_wa table__cell_plr20 table__cell_h55 table__cell_bgn"><div class="table__remove"></div></td>
										</tr> -->

									</tbody>
								</table>
							</div>
						</div>












</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('/site/right', [
	]) ?>

</aside>