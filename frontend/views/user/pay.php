


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

		<?= $this->render('top-menu-cook', [
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
			<h1 class="headerBox__title">Вы можете пополнить счет через сервисы:</h1>
		</div>

		<ul class="payments">
			<li class="payments__item">
				<div class="payments__img payments__img_ya"></div>
				<div class="payments__label">Баланс:</div>
				<div class="payments__value">5000 рублей</div>
				<a href="#" class="g-link">Пополнить счёт</a>
			</li>
			<li class="payments__item">
				<div class="payments__img payments__img_visa"></div>
				<div class="payments__label">Баланс:</div>
				<div class="payments__value">5000 рублей</div>
				<a href="#" class="g-link">Пополнить счёт</a>
			</li>
			<li class="payments__item">
				<div class="payments__img payments__img_webmoney"></div>
				<div class="payments__label">Баланс:</div>
				<div class="payments__value">5000 рублей</div>
				<a href="#" class="g-link">Пополнить счёт</a>
			</li>
		</ul>
	</div>
</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('/site/right', [
	]) ?>

</aside>