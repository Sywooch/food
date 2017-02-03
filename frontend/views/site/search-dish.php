<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;

// use yii\widgets\Pjax;
use frontend\models\Pjax;

?>


<?php if ($products): ?>



						<ul class="dish ">
	<?php foreach ($products as $key => $p): ?>

							<li class="dish__item">
								<div href="<?= Url::to(['site/userproduct', 'id' => $p->id]) ?>" class="dish__imgWrap">
									<div class="dish__topLine">1.1 км от вас</div>
									<img src="<?= $p->getIconsrc('list') ?>" alt="" class="dish__img" />
								</div>
								<div class="dish__bottomBox">
									<div class="time time_poa time_bgcf5">
										<?php // include('../../templates/include/timer.php'); ?>

										
										<span class="time__wrap">
											<span class="time__img"></span>
											<span class="time__counter">
												<?php $hours = floor($p->dish->timefrom/60) ?>
												<?php $minutes = $p->dish->timefrom%60 ?>
												<?php if ($hours>0): ?>
													<span class="time__val"><?= $hours ?></span>
													<span class="time__lbl">ч.</span>
												<?php endif ?>
												<span class="time__val"><?= $minutes ?></span>
												<span class="time__lbl">мин.</span>
											</span>
										</span>
									</div>
									<div class="dish__innerLine">
										<div class="dish__iconBox"><?= $p->user->username ?></div>
										<div class="rateBox">
											<a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
											<a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
											<a href="#" class="rateBox__item rateBox__item_w4 js-rate"></a>
											<a href="#" class="rateBox__item js-rate"></a>
											<a href="#" class="rateBox__item js-rate"></a>
										</div>
									</div>
									<h3 class="dish__header"><?= $p->header ?></h3>
									<div class="dish__shortText"><?= $p->shortText ?></div>
									<div class="dish__bottomLine">
										<div class="dish__priceWrap">
											<span class="dish__price"><?= $p->priceCurrent ?></span><span class="dish__rouble">&#8381;</span>
										</div>
										<!-- <a class="buy" href="#">Куплено</a> -->
										<!-- <a href="#" class="g-link dish__edit">Заказать</a> -->
										<?php if ($p->isInBasket): ?>
											<a class="buy js-transformBtn inbasket">Заказать</a>
										<?php else: ?>
											<a href="<?= Url::to(['site/basketadd', 'id' => $p->id]) ?>" class="buy js-transformBtn js_product_to_basket">Заказать</a>
										<?php endif ?>
									</div>
								</div>
							</li>

	<?php endforeach ?>

						</ul>


<?php else: ?>
	<p>Нет продуктов удовлетворяющих условия поиска.</p>
<?php endif ?>


