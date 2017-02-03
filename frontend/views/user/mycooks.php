<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

$this->params['breadcrumbs'][] = ['label' => 'Мои повара'];

$this->title = 'Мои повара';

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
		<div class="headerBox">
			<h1 class="headerBox__title">Мои повара</h1>
		</div>

		<?php if ($cooks): ?>
			<ul class="favoriteCookers">
				<?php foreach ($cooks as $key => $c): ?>
<li class="favoriteCookers__item">
	<div class="list__innerWrapper">
		<a href="#" class="list__img">
			<img class="list__innerImg" src="<?= $c->getIconsrc('icon') ?>" alt="">
			<span class="list__status list__status_active"></span>
		</a>
		<div class="g-cooker g-cooker_w170">
			<div class="g-cooker__header">
				<div class="g-cooker__favorite"></div>
			</div>
			<div class="g-cooker__line"><?= $c->username ?></div>
			<?php if ($c->kitchenCook): ?>
				<div class="g-cooker__line g-cooker__line_orange"><?= $c->kitchenCook[0]->header ?></div>
			<?php endif ?>
		</div>
	</div>
	<a href="<?= Url::to(['site/blogs', 'id' => $c->id]) ?>" class="g-button g-button_ml15 g-button_mr15">Блог</a>
	<a href="<?= Url::to(['site/usermenu', 'id' => $c->id]) ?>" class="g-button g-button_mr15">Меню</a>
	<a href="#" class="g-button g-button_mr15">Написать отзыв</a>
	<a href="<?= Url::to(['user/mycooks', 'delid' => $c->id]) ?>" class="favoriteCookers__remove">Удалить</a>
</li>
				<?php endforeach ?>
			</ul>
			
		<?php else: ?>
			<p>Нет избранных поваров.</p>
		<?php endif ?>


	</div>




</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('/site/right', [
	]) ?>

</aside>