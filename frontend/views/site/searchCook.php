<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;

?>


		<aside class="l-sidebar l-sidebar_left">
			<div class="toggleBox">
				<div class="toggleBox__box">
					<div class="toggleBox__content toggleBox__content_brown js-toggleBox__box">
						<h2 class="toggleBox__title"><a href="<?= Url::to(['site/search', 'producttype' => 'dish']) ?>">Домашняя кухня</a></h2>
						<span class="toggleBox__text">Вы можете заказать еду  у лучших поваров, которые готовят дома. Быстро и недорого!</span>
					</div>
					<div class="toggleBox__toggle toggleBox__toggle_brown js-toggleBox__toggle">
						<div class="toggleBox__arr"></div>
					</div>
				</div>
				<div class="toggleBox__box js-toggleBox__hiddenBox">
					<a class="toggleBox__content toggleBox__content_green js-toggleBox__box" href="<?= Url::to(['site/search', 'producttype' => 'diet']) ?>">
						<h2 class="toggleBox__title">Диеты</h2>
						<span class="toggleBox__text">Вы предерживаетесь особой диеты? Закажите ее прямо домой быстро и недорого!</span>
					</a>
					<div class="toggleBox__toggle toggleBox__toggle_green js-toggleBox__toggle">
						<div class="toggleBox__arr"></div>
					</div>
				</div>
			</div>
			<div class="middleBlog__bottomBox middleBlog__bottomBox_w100">
				<ul>
					<?php foreach ($kitchens as $key => $k): ?>
						<li class="middleBlog__listItem middleBlog__listItem_sidebar"><a class="middleBlog__listLink middleBlog__listLink_sidebar middleBlog__listLink_brown" href="<?= Url::to(['site/search', 'producttype' => 'dish', 'section' => $k->sid]) ?>"><?= $k->header ?></a></li>
					<?php endforeach ?>
				</ul>
			</div>
			<div class="spacer spacer_pt20 spacer_mb20"></div>
			<form class="formSlidesBox" action="" method="post">
				<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
				<div class="slidesBox slidesBox_flex slidesBox_pb5">
					<div class="slidesBox__header slidesBox__header_center">
						<label class="slidesBox__label slidesBox__label_center" for="amount">Минимальная сумма заказа</label>
						<input name="costdeliveryfrom" class="slidesBox__val slidesBox__val_orange" type="text" id="amountMin_order" value="<?= $bindedValues['costdeliveryfrom'] ?>" />
						<input name="costdeliveryto" class="slidesBox__val slidesBox__val_orange" type="text" value="<?= $bindedValues['costdeliveryto'] ?>" />
						<div class="slidesBox__val slidesBox__val_unit">руб.</div>
					</div>
					<div class="slidesBox__range" id="slider-range_order"></div>
				</div>
				<input name="submitform" type="submit" value="submit" />
			</form>
			<div class="spacer spacer_pt20 spacer_mb20"></div>
			<form action="" method="post">
				<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
				<div class="slidesBox slidesBox_flex slidesBox_pb5">
					<div class="slidesBox__header slidesBox__header_center">
						<label class="slidesBox__label slidesBox__label_center">Стоимость блюда</label>
						<input name="price_from" class="slidesBox__val slidesBox__val_orange" type="text" value="<?= $bindedValues['price_from'] ?>" />
						<input name="price_to" class="slidesBox__val slidesBox__val_orange" type="text" value="<?= $bindedValues['price_to'] ?>" />
						<div class="slidesBox__val slidesBox__val_unit">руб.</div>
					</div>
				</div>
				<input name="submitform" type="submit" value="submit" />
			</form>
			<div class="spacer spacer_pt20 spacer_mb20"></div>
			<form class="formSlidesBox" action="<?php 

// if (Yii::$app->get) {
// 	# code...
// }

			 ?>" method="post">
				<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
				<div class="checkOptions checkOptions_p10-30">
					<div class="checkOptions__wrap">
							<input name="pickup" class="messenger__check" type="checkbox" value="0" checked="">
						<label class="messenger__wrap messenger__wrap_mr7">
							<input name="pickup" class="messenger__check" type="checkbox" value="1"<?= $bindedValues['pickup']?' checked':'' ?>>
							<div class="messenger__bg"></div>
						</label>
						<div class="checkOptions__name">Самовывоз</div>
					</div>
					<div class="checkOptions__wrap">
						<label class="messenger__wrap messenger__wrap_mr7">
							<input class="messenger__check" type="checkbox">
							<div class="messenger__bg"></div>
						</label>
						<div class="checkOptions__name">Доставка</div>
					</div>
					<div class="checkOptions__wrap">
							<input name="workhome" type="checkbox" value="0" checked="">
						<label class="messenger__wrap messenger__wrap_mr7">
							<input name="workhome" class="messenger__check" type="checkbox" value="1"<?= $bindedValues['workhome']?' checked':'' ?>>
							<div class="messenger__bg"></div>
						</label>
						<div class="checkOptions__name">Выезд на дом</div>
					</div>
					<div class="checkOptions__wrap">
						<label class="messenger__wrap messenger__wrap_mr7">
							<input class="messenger__check" type="checkbox">
							<div class="messenger__bg"></div>
						</label>
						<span class="checkOptions__name">Обслуживание мероприятий</span>
					</div>
				</div>
				<input name="submitform" type="submit" class="antiReset" value="submit" />
			</form>
			<div class="searchBox searchBox_sidebar">
				<div class="searchBox__wrapper">
					<input class="js-hidden_input" type="hidden">
					<input class="g-input g-input_mr0 g-input_w270 js-input_searchBox" placeholder="Метро ..." type="text">
					<div class="searchBox__select searchBox__select_r10px js-searchBox__arr">Выбрать</div>
					<ul class="searchBox__list">
						<li data-value="1" class="searchBox__listItem">Итальянская</li>
						<li data-value="2" class="searchBox__listItem">Мексиканская</li>
						<li data-value="3" class="searchBox__listItem">Японская</li>
						<li data-value="4" class="searchBox__listItem">Русская</li>
					</ul>
				</div>
			</div>
			<div class="spacer spacer_pt20 spacer_mb20"></div>
			<div class="banner">
				<a href="#"><img src="" alt=""></a>
			</div>
		</aside>
		<div class="g-flexMiddleChild middleWrapper">

			<form class="popup__form" action="" method="post" id="js_saerchpage_form">
				<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />

				<div class="menuProfile">
					<div class="linksBox linksBox_bb linksBox_pt10b5">
						<label class="radio">
							<input name="dishtype_id" type="radio" class="js_saerchpage_inputDishTypeID" value="any"<?= (0==$bindedValues['dishtype_id'])?' checked':'' ?>>
							<div>Любого типа</div>
						</label>
						<?php foreach ($dishtypes as $key => $dt): ?>
							<label class="radio">
								<input name="dishtype_id" type="radio" class="js_saerchpage_inputDishTypeID" value="<?= $dt->id ?>"<?= ($dt->id==$bindedValues['dishtype_id'])?' checked':'' ?>>
								<div><?= $dt->header ?></div>
							</label>
						<?php endforeach ?>
					</div>
				</div>

				<div class="wideSearch__header">
					<div class="wideSearch__leftBox">
						<label class="wideSearch__lbl mr10" for="lbl1">
							<input class="wideSearch__check js_saerchpage_inputViewType" id="lbl1" type="radio" name="viewType" value="cook"<?= ($bindedValues['viewType'] == 'cook')?' checked=""':'' ?>>
							<div class="wideSearch__bgCheck wideSearch__bgCheck_cooker"></div>
						</label>
						<label class="wideSearch__lbl" for="lbl2">
							<input class="wideSearch__check js_saerchpage_inputViewType" id="lbl2" type="radio" name="viewType" value="dish"<?= ($bindedValues['viewType'] == 'dish')?' checked=""':'' ?>>
							<div class="wideSearch__bgCheck wideSearch__bgCheck_dish"></div>
						</label>
					</div>
					<div class="wideSearch__rightBox">
						<input name="searchquery" class="g-input g-input_500px g-input_search" type="search" placeholder="Поиск по блюдам ..." value="<?= $bindedValues['searchquery'] ?>">
						<div class="wideSearch__more js-toggleBlog__toggle">Расширенный поиск</div>
					</div>
				</div>

			</form>

<div class="middleWrapper__container">




<?php
// echo "<pre class='antiReset'>";
// echo '$_GET '; print_r($_GET);
// echo '$_POST '; print_r($_POST);
// echo '$session '; print_r($session['dish']);
// echo '$bindedValues '; print_r($bindedValues);
// echo "</pre>";

?>


<?php if ($cooksAndProducts): ?>
<ul class="cookersList">
	<?php foreach ($cooksAndProducts as $userId => $productIds): ?>
		<li class="cookersList__item">
		<div class="cookersList__body">
			<div class="cookersList__left">
				<a class="cookersList__imgWrap" href="<?= Url::to(['site/userprofile', 'id' => $userId]) ?>">
					<img class="cookersList__img cookersList__img_round" src="<?= $cooks[$userId]->getIconsrc('icon') ?>" alt="">
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
				<a class="g-link g-link_tac g-link_plr0 g-link_w100 g-link_mt14" href="<?= Url::to(['site/usermenu', 'id' => $userId]) ?>">Меню повара</a>
			</div>
			<div class="cookersList__center">

				<div class="cookersList__arr cookersList__arr_prev js-initMainSlider__prev dn"></div>
					
				<div class="foodList">
					<ul class="foodList__inner js-initMainSlider js-mainSlider">
						<?php foreach ($productIds as $productId): ?>
							<li class="foodList__item js-initMainSlider__item">
								<a class="foodList__imgWrap" href="<?= Url::to(['site/userproduct', 'id' => $productId]) ?>">
									<img class="foodList__img" src="<?= $products[$productId]->getIconsrc('icon') ?>" alt="">
								</a>
								<h3 class="foodList__heading"><?= $products[$productId]->header ?></h3>
								<div class="spacer spacer_pt10 spacer_mb10"></div>
								<div class="priceBox priceBox_green">
									<span class="priceBox__price"><?= $products[$productId]->pricecurrent ?></span>
									<span class="priceBox__currency">₽</span>
								</div>
								<!-- <a class="buy db ma" href="#">Куплено</a> -->
								<a class="g-link g-link_hgreen" href="#">Заказать</a>
							</li>
						<?php endforeach ?>
					</ul>
				</div>

				<div class="cookersList__arr cookersList__arr_next js-initMainSlider__next dn"></div>

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
					<div class="cookersList__val">100000 ₽</div>
				</div>
				<div class="cookersList__line">
					<div class="cookersList__lbl">Доставка</div>
					<div class="cookersList__val">100000 ₽</div>
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
						<div class="tagBox tagBox_mb0"><span class="tagBox__name">Азиатская</span></div>
			<div class="tagBox green tagBox_mb0"><span class="tagBox__name">Азиатская</span></div>
						<div class="tagBox tagBox_mb0"><span class="tagBox__name">Азиатская</span></div>
			<div class="tagBox green tagBox_mb0"><span class="tagBox__name">Азиатская</span></div>
						<div class="tagBox tagBox_mb0"><span class="tagBox__name">Азиатская</span></div>
			<div class="tagBox green tagBox_mb0"><span class="tagBox__name">Азиатская</span></div>
		</div>
		</li>
	<?php endforeach ?>
</ul>
<?php else: ?>
	<p>Нет продуктов удовлетворяющих условия поиска.</p>
<?php endif ?>



<?= LinkPager::widget(['pagination' => $pagination,]); ?>


</div>
		</div>
		<aside class="l-sidebar l-sidebar_right">
			
			<?= $this->render('left') ?>

		</aside>


