<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

$this->params['breadcrumbs'][] = ['label' => 'Профиль', 'url' => ['user/profile'], 'class' => 'breadcrumbs__link'];
$this->params['breadcrumbs'][] = ['label' => 'Меню', 'url' => ['user/menu'], 'class' => 'breadcrumbs__link'];
$this->params['breadcrumbs'][] = ['label' => 'Блюдо #' . $product->id, 'url' => ['user/menuview', 'id' => $product->id], 'class' => 'breadcrumbs__link'];
$this->params['breadcrumbs'][] = ['label' => 'Редактирование блюда'];

$this->title = 'Редактирование блюда';

?>

<aside class="l-sidebar l-sidebar_left">

	<?= $this->render('leftcook', [
	]) ?>

</aside>
<div class="g-flexMiddleChild middleWrapper">

	<div class="menuTop">

		<?= $this->render('top-menu-cook', [
		]) ?>

	</div>

	<?//= $this->render('dishupdate/topmenu', []) ?>

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

    <?= $this->render('dishform', [
		'product' => $product,
		'dish' => $dish,
		'dishForm' => $dishForm,
		'kitchens' => $kitchens,
		'dishtypes' => $dishtypes,
		'diets' => $diets,
		'measures' => $measures,
    ]) ?>

</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('/site/left', [
	]) ?>

</aside>