<?php

use \yii\helpers\Html;
use \yii\helpers\Url;
use common\models\Product;

$products = Product::find()
	->where([
	])
	->limit(10)
	->all();

?>
<h2 class="sidebar__heading">Сейчас готовится</h2>

<?php foreach ($products as $key => $p): ?>

<div class="middleBlog__table middleBlog__table_midCont ml15 mb15 w310">

	<a class="middleBlog__imgWrap middleBlog__imgWrap_w110" href="<?= Url::to(['site/userproduct', 'id' => $p->id]) ?>">
		<img class="middleBlog__img" src="<?= $p->getIconsrc('icon') ?>" alt="">
	</a>
	<div class="middleBlog__itemContent">
		<section class="middleBlog__topDescription">
			<h4 class="middleBlog__itemTitle"><a href="<?= Url::to(['site/userproduct', 'id' => $p->id]) ?>"><?= $p->header ?></a></h4>
		</section>
		<div class="g-cooker g-cooker_pl0 pt6 pb5">
			<div class="g-cooker__header">
				<div class="rateBox">
					<a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
					<a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
					<a href="#" class="rateBox__item rateBox__item_w4 js-rate"></a>
					<a href="#" class="rateBox__item js-rate"></a>
					<a href="#" class="rateBox__item js-rate"></a>
				</div>
			</div>
			<div class="g-cooker__line"><a href="<?= Url::to(['site/userprofile', 'id' => $p->user->id]) ?>"><?= $p->user->username ?></a></div>
			<div class="g-cooker__line g-cooker__line_orange"><a href="<?= Url::to(['site/search', 'producttype' => 'dish', 'section' => $p->kitchens[0]->sid]) ?>"><?= $p->kitchens[0]->header ?></a></div>
		</div>
	</div>
	<div class="dishTools">
		<div class="time time_bgGrey">
			<span class="time__wrap">
				<span class="time__img"></span>
				<span class="time__counter">
					<?php $hours = floor($p->dish->timefrom/60) ?>
					<?php $minutes = $p->dish->timefrom%60 ?>
					<?php if ($hours>0): ?>
						<div class="time__val"><?= $hours ?></div>
						<div class="time__lbl">ч.</div>
					<?php endif ?>
						<span class="time__val"><?= $minutes ?></span>
						<span class="time__lbl">мин.</span>
				</span>
			</span>
		</div>
		<a href="#" class="g-link">Заказать</a>
		<div class="priceBox pt8 pr15">
			<span class="priceBox__price"><?= $p->price ?></span><span class="priceBox__currency">₽</span>
		</div>
	</div>
</div>
<?php endforeach ?>