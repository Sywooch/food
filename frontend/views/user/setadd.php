<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = ['label' => 'Профиль', 'url' => ['user/profile'], 'class' => 'breadcrumbs__link'];

$this->params['breadcrumbs'][] = ['label' => 'Меню'];

$this->title = 'Меню';

?>

<aside class="l-sidebar l-sidebar_left">

	<?= $this->render('leftcook', [
	]) ?>

</aside>
<div class="g-flexMiddleChild middleWrapper">

	<?= $this->render('menu/topmenu', [
	]) ?>

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

	<div class="antiReset">
		
	    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	    <?= $form->field($product, 'header')->textInput() ?>
	    <?= $form->field($product, 'price')->textInput() ?>
	    <?= $form->field($product, 'pricesale')->textInput() ?>
		<?= $form->field($set, 'text')->textarea(['rows' => 6]) ?>
        <?= Html::submitButton($product->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $product->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    <?php ActiveForm::end(); ?>

	</div>


	<div class="menuProfile">
		<form class="popup__form" action="<?= Url::to(['user/menu']) ?>" method="post" data-pjax>
			<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
			<div class="menuProfile__titleWrap">
				<h2 class="menuProfile__title">
					<label class="menuProfile__titleText active">
						Домашняя кухня
						<input name="kind" type="radio" value="kithcen">
					</label>
				</h2>
				<h2 class="menuProfile__title">
					<label href="#" class="menuProfile__titleText">
						Диеты
						<input name="kind" type="radio" value="diet">
					</label>
				</h2>
			</div>
			<div class="linksBox linksBox_bb linksBox_pt10b5">
				<?php foreach ($dishtypes as $key => $dt): ?>
					<label class="linksBox__item"><?= $dt->header ?>
						<input name="dishtype" type="submit" value="<?= $dt->id ?>">
					</label>
				<?php endforeach ?>
			</div>
		</form>
	</div>
	<div class="searchBox">
		<div class="searchBox__wrapper">
			<input type="text" class="g-input g-input_h35 g-input_w250" placeholder="Сортировка" />
			<a class="searchBox__select" href="#">Выбрать</a>
		</div>
		<input type="text" class="g-input g-input_h35 g-input_black g-input_searchBlack g-input_w380" placeholder="Поиск по блюдам" />
		<a href="#" class="g-link g-loc_right">Архив блюд</a>
	</div>
	<ul class="dish">
		<?php foreach ($products as $key => $p): ?>
			<li class="dish__item">
				<div href="#" class="dish__imgWrap">
					<img src="/images/pizza.png" alt="" class="dish__img">
					<div class="dish__hiddenBox">
						<div class="dish__top dish__top_width">
							<div class="dish__hide dish__hide_ml7">В архив</div>
							<div class="dish__but dish__remove dish__remove_mr7">Удалить</div>
						</div>
					</div>
				</div>
				<div class="dish__bottomBox">
					<div class="time time_poa time_bgcf5">
						<div class="time__wrap">
							<div class="time__img"></div>
							<div class="time__counter">
								<div class="time__val">1</div>
								<div class="time__lbl">ч.</div>
								<div class="time__val">15</div>
								<div class="time__lbl">мин.</div>
							</div>
						</div>
					</div>
					<h3 class="dish__header"><a href="<?= Url::to(['user/menuview', 'id' => $p['id']]) ?>"><?= $p['header'] ?></a></h3>
					<div class="dish__shortText"><?= $p['text'] ?></div>
					<div class="dish__bottomLine">
						<div class="dish__priceWrap"><span class="dish__price"><?= round(($p['pricesale'])?$p['pricesale']:$p['price']) ?></span><span class="dish__rouble">&#8381;</span></div>
						<!-- <input type="button" class="g-button dish__edit" value="Редактировать"> -->
						<a href="<?= Url::to(['user/menuupdate', 'id' => $p['id']]) ?>" class="g-link dish__edit">Редактировать</a>
					</div>
				</div>
			</li>
		<?php endforeach ?>
	</ul>
</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('right', [
	]) ?>

</aside>