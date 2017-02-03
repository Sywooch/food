<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;

// use yii\widgets\Pjax;
use frontend\models\Pjax;

?>





<?php if ($cooksAndProducts): ?>
	<ul class="cookersList">
	<?php foreach ($cooksAndProducts as $userId => $productIds): ?>
		<li class="cookersList__item">
			<div class="cookersList__body">
				<div class="cookersList__left">
					<a class="cookersList__imgWrap cookersList__imgWrap_tac" href="<?= Url::to(['site/userprofile', 'id' => $userId]) ?>">
						<img class="cookersList__img cookersList__img_round cookersList__img_bw" src="<?= $cooks[$userId]->getIconsrc('icon') ?>" alt="" />
						<span class="cookersList__checked"></span>
						<span class="cookersList__status lcookersList__status_active"></span>
					</a>
					<h3 class="cookersList__heading"><?= $cooks[$userId]->username ?></h3>
					<div class="rateBox">
						<a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
						<a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
						<a href="#" class="rateBox__item rateBox__item_w4 js-rate"></a>
						<a href="#" class="rateBox__item js-rate"></a>
						<a href="#" class="rateBox__item js-rate"></a>
					</div>
					<div class="spacer pb10 mb10"></div>
					<div class="cookersList__lbl cookersList__lbl_fz15">Не принимаю заказы</div>
					<!-- <div class="cookersList__lbl cookersList__lbl_green cookersList__lbl_fz15">Принимаю заказы</div> -->
					<a class="g-link g-link_tac g-link_plr0 g-link_w100 mt10" href="<?= Url::to(['site/usermenu', 'id' => $userId]) ?>">Меню повара</a>
				</div>
				<div class="cookersList__center">

					<div class="cookersList__arr cookersList__arr_transparent cookersList__arr_prev js-initMainSlider__prev dn"></div>

					<div class="foodList">
						<ul class="foodList__inner js-initMainSlider js-mainSlider">

							<?php foreach ($productIds as $productId): ?>

							<li class="foodList__item js-initMainSlider__item">
								<a class="foodList__imgWrap" href="<?= Url::to(['site/userproduct', 'id' => $productId]) ?>">
									<img class="foodList__img" src="<?= $products[$productId]->getIconsrc('icon') ?>" alt="" />
								</a>
								<h3 class="foodList__heading"><?= $products[$productId]->header ?></h3>
								<div class="spacer spacer_pt10 spacer_mb10"></div>
								<div class="foodList__footer js-transformBtn__wrap">
									<div class="priceBox priceBox_green">
										<span class="priceBox__price"><?= $products[$productId]->pricecurrent ?></span>
										<span class="priceBox__currency">₽</span>
									</div>
										<?php if ($products[$productId]->isInBasket): ?>
											<a class="buy js-transformBtn inbasket">Заказать</a>
										<?php else: ?>
											<a href="<?= Url::to(['site/basketadd', 'id' => $products[$productId]->id]) ?>" class="buy js-transformBtn js_product_to_basket">Заказать</a>
										<?php endif ?>
								</div>
							</li>

							<?php endforeach ?>

						</ul>
					</div>

					<div class="cookersList__arr cookersList__arr_transparent cookersList__arr_next js-initMainSlider__next dn"></div>

				</div>
				<div class="cookersList__right">
					<div class="toolsBox toolsBox_mb30">
						<div class="toolsBox__item">
							<a class="toolsBox__count" href="#">178</a>
							<a class="toolsBox__name" href="#">Отзывов</a>
						</div>
					</div>
					<div class="locBox">
						<a class="locBox__icon" href="#">0.3 км от вас</a>
					</div>
					<div class="spacer spacer_pt20 spacer_mb20"></div>
					<div class="cookersList__line">
						<div class="cookersList__lbl">Мин. заказ</div>
						<div class="cookersList__val"><?= $cooks[$userId]->profile->costmin ?> ₽</div>
					</div>
					<div class="cookersList__line">
						<div class="cookersList__lbl">Доставка</div>
						<div class="cookersList__val"><?= $cooks[$userId]->profile->costdelivery ?> ₽</div>
					</div>
					<div class="spacer spacer_pt15 spacer_mb20"></div>
					<div class="checkOptions">
						<div class="checkOptions__wrap">
							<label class="messenger__wrap messenger__wrap_mr7">
								<div class="messenger__checked"></div>
							</label>
							<div class="checkOptions__name">Самовывоз</div>
						</div>
					</div>
				</div>
			</div>
			<div class="cookersList__footer">
				<div class="cookersList__lbl cookersList__lbl_pl30 cookersList__lbl_mr10">Кухня</div>
				<?php if ($cooks[$userId]->kitchenCook): ?>
					<?php foreach ($cooks[$userId]->kitchenCook as $k): ?>
						<?php if ($producttype==='dish'): ?>
							<div class="tagBox tagBox_mb0"><span class="tagBox__name"><?= $k->header ?></span></div>
						<?php else: ?>
							<div class="tagBox green tagBox_mb0"><span class="tagBox__name"><?= $k->header ?></span></div>
						<?php endif; ?>
					<?php endforeach ?>
				<?php endif ?>
			</div>
		</li>
	<?php endforeach ?>
	</ul>
<?php else: ?>
	<p>Нет поваров удовлетворяющих условия поиска.</p>
<?php endif ?>
