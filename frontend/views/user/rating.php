


<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

$this->params['breadcrumbs'][] = ['label' => 'Профиль'];

$this->title = 'Профиль';

?>

<aside class="l-sidebar l-sidebar_left">

	<?= $this->render('left'.$user->usertype, [
	]) ?>

</aside>
<div class="g-flexMiddleChild middleWrapper">

	<div class="menuTop">

		<?= $this->render('top-menu-'.$user->usertype, [
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

							<div class="headerBox headerBox_inline">
								<h1 class="headerBox__title">Ваш рейтинг:</h1>
								<div class="headerBox__rightBox ">
									<div class="list__rightBox">
										<div class="g-cooker__favorite g-cooker__favorite_big"></div>
										<div class="g-cooker__favoriteCount g-cooker__favoriteCount_big">0.6</div>
										<div class="g-date g-date_b0">15.15.16</div>
									</div>
								</div>
							</div>

							<div class="rating">
								<div class="section_810">
									<div class="rating__descr">
										<div class="rating__header">Как рассчитывается рейтинг:</div>
										<p class="rating__text"><span>Lorem ipsum</span> dolor sit amet, consectetur adipisicing elit. Consequuntur, est dignissimos, possimus qui rerum commodi, sint voluptate optio fuga reiciendis sunt mollitia ea quia nam excepturi. Numquam quia sed enim?</p>
										<p class="rating__text"><span class="g-bold">Lorem ipsum dolor</span> sit amet, consectetur adipisicing elit. Consequuntur, est dignissimos, possimus qui rerum commodi, sint voluptate optio fuga reiciendis sunt mollitia ea quia nam excepturi. Numquam quia sed enim?</p>
										<p class="rating__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, est dignissimos, possimus qui rerum commodi, sint voluptate optio fuga reiciendis sunt mollitia ea quia nam excepturi. Numquam quia sed enim?</p>
									</div>
									<table class="table">
										<thead class="table__head">
											<tr class="table__row">
												<td class="table__cell table__cell_bordered">Численный рейтинг</td>
												<td class="table__cell table__cell_bordered">Рейтинг в звёздах</td>
											</tr>
										</thead>
										<tbody>
											<tr class="table__row">
												<td class="table__cell table__cell_bordered">от 0 до 0,19</td>
												<td class="table__cell table__cell_bordered"><div class="g-cooker__favorite"></div></td>
											</tr>
											<tr class="table__row">
												<td class="table__cell table__cell_bordered">от 0,2 до 0,39</td>
												<td class="table__cell table__cell_bordered"><div class="g-cooker__favorite"></div></td>
											</tr>
											<tr class="table__row">
												<td class="table__cell table__cell_bordered">от 0,4 до 0,59</td>
												<td class="table__cell table__cell_bordered"><div class="g-cooker__favorite"></div></td>
											</tr>
											<tr class="table__row">
												<td class="table__cell table__cell_bordered">от 0,6 до 0,79</td>
												<td class="table__cell table__cell_bordered"><div class="g-cooker__favorite"></div></td>
											</tr>
											<tr class="table__row">
												<td class="table__cell table__cell_bordered">от 0,8 до 1</td>
												<td class="table__cell table__cell_bordered"><div class="g-cooker__favorite"></div></td>
											</tr>
										</tbody>
									</table>
									<div class="rating__rightBox">
										<div class="rating__calculation"></div>
										<p class="rating__text">В соответствии с которой рейтинг определяется тремя параметрами:</p>
										<p class="rating__text">Качество аккаунта повара <span class="g-bold">Rq</span>;</p>
										<p class="rating__text">Количеством оценок пользователей <span class="g-bold">K</span>.</p>
									</div>
									<div class="rating__descr">
										<div class="rating__header">Пользовательская составляющая</div>
										<p class="rating__text">Оценка повара пользователями Ru может принимать любые значения от 0 до 1</p>
									</div>
									<table class="table">
										<thead class="table__head">
											<tr class="table__row">
												<td class="table__cell table__cell_bordered">Оценка пользователей</td>
												<td class="table__cell table__cell_bordered">Значение</td>
											</tr>
										</thead>
										<tbody>
											<tr class="table__row">
												<td class="table__cell table__cell_bordered"><div class="g-cooker__favorite"></div></td>
												<td class="table__cell table__cell_bordered">0</td>
											</tr>
											<tr class="table__row">
												<td class="table__cell table__cell_bordered"><div class="g-cooker__favorite"></div></td>
												<td class="table__cell table__cell_bordered">0,25</td>
											</tr>
											<tr class="table__row">
												<td class="table__cell table__cell_bordered"><div class="g-cooker__favorite"></div></td>
												<td class="table__cell table__cell_bordered">0,5</td>
											</tr>
											<tr class="table__row">
												<td class="table__cell table__cell_bordered"><div class="g-cooker__favorite"></div></td>
												<td class="table__cell table__cell_bordered">0,75</td>
											</tr>
											<tr class="table__row">
												<td class="table__cell table__cell_bordered"><div class="g-cooker__favorite"></div></td>
												<td class="table__cell table__cell_bordered">1</td>
											</tr>
										</tbody>
									</table>
									<div class="rating__descr">
										<div class="rating__header">Качество аккаунта повара</div>
										<div class="rating__header">Пользовательская составляющая</div>
										<div class="rating__calculation_2"></div>
										<div class="rating__text">где:</div>
										<div class="rating__text rating__text_pb4"><span class="g-bold">Rc</span> - количество статей/рецептов за последний месяц</div>
										<div class="rating__text rating__text_pb4"><span class="g-bold">Rage</span> - бонус за размещение аккаунта</div>
										<div class="rating__text rating__text_pb4"><span class="g-bold">Ra</span> - показатель заполненности профиля</div>
										<div class="rating__text rating__text_pb4"><span class="g-bold">Rc</span> - количество статей/рецептов за последний месяц</div>
										<div class="rating__text rating__text_pb4"><span class="g-bold">Rage</span> - бонус за размещение аккаунта (бонус за размещение за полгода - 0,5, за год - 1)</div>
										<div class="rating__text rating__text_pb4"><span class="g-bold">Ra</span> - показатель заполненности профиля (процентное соотношение заполненности профиля)</div>
									</div>
								</div>
							</div>
						</div>
</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('/site/right', [
	]) ?>

</aside>