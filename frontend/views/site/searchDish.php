<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;

// use yii\widgets\Pjax;
use frontend\models\Pjax;

$this->title = 'Поиск';

$this->params['breadcrumbs'][] = $this->title;

?>

		<aside class="l-sidebar l-sidebar_left">
			<?= $this->render('right') ?>

			<!-- <div class="toggleBox">
				<div class="toggleBox__box">
					<div class="toggleBox__content toggleBox__content_brown js-toggleBox__box">
						<h2 class="toggleBox__title"><a href="<?//= Url::to(['site/search', 'producttype' => 'dish']) ?>">Домашняя кухня</a></h2>
						<span class="toggleBox__text">Вы можете заказать еду  у лучших поваров, которые готовят дома. Быстро и недорого!</span>
					</div>
					<div class="toggleBox__toggle toggleBox__toggle_brown js-toggleBox__toggle">
						<div class="toggleBox__arr"></div>
					</div>
				</div>
				<div class="toggleBox__box js-toggleBox__hiddenBox">
					<a class="toggleBox__content toggleBox__content_green js-toggleBox__box" href="<?//= Url::to(['site/search', 'producttype' => 'diet']) ?>">
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
					<?//php foreach ($kitchens as $key => $k): ?>
						<li class="middleBlog__listItem middleBlog__listItem_sidebar"><a class="middleBlog__listLink middleBlog__listLink_sidebar middleBlog__listLink_brown" href="<?//= Url::to(['site/search', 'producttype' => 'dish', 'section' => $k->sid]) ?>"><?//= $k->header ?></a></li>
					<?//php endforeach ?>
				</ul>
			</div>
			<div class="spacer spacer_pt20 spacer_mb20"></div>
			<form class="formSlidesBox" action="" method="post">
				<input type="hidden" name="_csrf" value="<?//=Yii::$app->request->getCsrfToken()?>" />
				<div class="slidesBox slidesBox_flex slidesBox_pb5">
					<div class="slidesBox__header slidesBox__header_center">
						<label class="slidesBox__label slidesBox__label_center" for="amount">Минимальная сумма заказа</label>
						<input name="costdeliveryfrom" class="slidesBox__val slidesBox__val_orange" type="text" id="amountMin_order" value="<?//= $bindedValues['costdeliveryfrom'] ?>" />
						<input name="costdeliveryto" class="slidesBox__val slidesBox__val_orange" type="text" value="<?//= $bindedValues['costdeliveryto'] ?>" />
						<div class="slidesBox__val slidesBox__val_unit">руб.</div>
					</div>
					<div class="slidesBox__range" id="slider-range_order"></div>
				</div>
				<input name="submitform" type="submit" value="submit" />
			</form>
			<div class="spacer spacer_pt20 spacer_mb20"></div>
			<form action="" method="post">
				<input type="hidden" name="_csrf" value="<?//=Yii::$app->request->getCsrfToken()?>" />
				<div class="slidesBox slidesBox_flex slidesBox_pb5">
					<div class="slidesBox__header slidesBox__header_center">
						<label class="slidesBox__label slidesBox__label_center">Стоимость блюда</label>
						<input name="price_from" class="slidesBox__val slidesBox__val_orange" type="text" value="<?//= $bindedValues['price_from'] ?>" />
						<input name="price_to" class="slidesBox__val slidesBox__val_orange" type="text" value="<?//= $bindedValues['price_to'] ?>" />
						<div class="slidesBox__val slidesBox__val_unit">руб.</div>
					</div>
				</div>
				<input name="submitform" type="submit" value="submit" />
			</form>
			<div class="spacer spacer_pt20 spacer_mb20"></div>
			<form class="formSlidesBox" action="" method="post">
				<input type="hidden" name="_csrf" value="<?//=Yii::$app->request->getCsrfToken()?>" />
				<div class="checkOptions checkOptions_p10-30">
					<div class="checkOptions__wrap">
							<input name="pickup" class="messenger__check" type="checkbox" value="0" checked="">
						<label class="messenger__wrap messenger__wrap_mr7">
							<input name="pickup" class="messenger__check" type="checkbox" value="1"<?//= $bindedValues['pickup']?' checked':'' ?>>
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
							<input name="workhome" class="messenger__check" type="checkbox" value="1"<?//= $bindedValues['workhome']?' checked':'' ?>>
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
			</div> -->
		</aside>
		<div class="g-flexMiddleChild middleWrapper">








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










						<div class="menuProfile__titleWrap">
							<a class="menuProfile__title menuProfile__title_orange<?= $producttype==='dish'?' active':'' ?>" href="<?= Url::to(['site/search', 'producttype' => 'dish']) ?>">Домашняя кухня</a>
							<a class="menuProfile__title menuProfile__title_green<?= $producttype==='diet'?' active':'' ?>" href="<?= Url::to(['site/search', 'producttype' => 'diet']) ?>">Диеты</a>
						</div>
<form action="" method="POST" id="js_saerchpage_form">
	<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
	<input type="hidden" name="form_dishtype_id" value="1" />

						<div class="categories">
							<div class="categories__btn categories__btn_prev js-moveSliderCategoriesContainer__left"></div>
							<div class="categories__inner">
								<ul class="categories__list js-moveSliderCategoriesContainer">


<?php foreach ($dishtypes as $key => $dt): ?>
	<li class="categories__item">
		<label class="categories__link categories__link_<?= $dt->id ?>">
			<input name="dishtype_id[]" type="checkbox" class="js_saerchpage_inputDishTypeID" value="<?= $dt->id ?>" style="visibility: hidden; position: absolute;"<?= ( in_array($dt->id, explode(',',$bindedValues['dishtype_id'])) )?' checked':'' ?>>
			<?= $dt->header ?>
			<?php if ( in_array($dt->id, explode(',',$bindedValues['dishtype_id'])) ): ?>
				<span style="color: red">Выбран</span>
			<?php endif ?>
		</label>
	</li>
<?php endforeach ?>


<!-- <li class="categories__item">
	<a class="categories__link categories__link_4" href="#">header</a>
</li> -->

								</ul>
							</div>
							<div class="categories__btn categories__btn_next js-moveSliderCategoriesContainer__right"></div>
						</div>
</form>

						<div class="spacer"></div>

						<div class="menuProfile">
							<div class="linksBox linksBox_bb linksBox_pt10b5">



<?php if ($producttype==='dish'): ?>
<form action="" method="POST" id="js_saerchpage_form_kitchen_ids">
	<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
	<input type="hidden" name="form_kitchen_ids" value="1" />
	<?php foreach ($kitchens as $key => $k): ?>
		<label class="linksBox__item">
			<input name="kitchen_ids[]" type="checkbox" value="<?= $k->id ?>" class="js_saerchpage_input_kitchen_ids" style="visibility: hidden; position: absolute;"<?= ( in_array($k->id, explode(',',$bindedValues['kitchen_ids'])) )?' checked':'' ?> />
			<?= $k->header ?>
		</label>
	<?php endforeach ?>
</form>
<?php elseif ($producttype==='diet'): ?>
<form action="" method="POST" id="js_saerchpage_form_kitchen_ids">
	<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
	<input type="hidden" name="form_kitchen_ids" value="1" />
	<?php foreach ($diets as $key => $d): ?>
		<label class="linksBox__item">
			<input name="kitchen_ids[]" type="checkbox" value="<?= $d->id ?>" class="js_saerchpage_input_kitchen_ids" style="visibility: hidden; position: absolute;"<?= ( in_array($d->id, explode(',',$bindedValues['kitchen_ids'])) )?' checked':'' ?> />
			<?= $d->header ?>
		</label>
	<?php endforeach ?>
</form>
<?php endif ?>

								<div class="linksBox__link">Посмотреть все...</div>

							</div>
						</div>

						<?php // include('../../templates/include/wide_search.php'); ?>

						<form class="wideSearch wideSearch_db wideSearch_h65 wideSearch_grey js-toggleBlog__parent">
							<div class="wideSearch__header">
								<div class="wideSearch__leftBox">
									<label class="wideSearch__lbl mr10" for="lbl1">
										<input class="wideSearch__check" id="lbl1" type="radio" name="lbl" value="" checked="" />
										<div class="wideSearch__bgCheck wideSearch__bgCheck_cooker"></div>
									</label>
									<label class="wideSearch__lbl" for="lbl2">
										<input class="wideSearch__check" id="lbl2" type="radio" name="lbl" value="" />
										<div class="wideSearch__bgCheck wideSearch__bgCheck_dish"></div>
									</label>
								</div>
								<div class="wideSearch__rightBox">
									<input class="g-input g-input_500px g-input_search g-input_wh" type="search" placeholder="Поиск по поварам ..." />
									<div class="wideSearch__more js-toggleBlog__toggle">Расширенный поиск</div>
								</div>
							</div>
							<div class="wideSearch__body js-toggleBlog__box">
								<div class="wideSearch__line">
									<div class="wideSearch__leftBox"></div>
									<div class="wideSearch__rightBox">
										<div class="wideSearch__toggleBox">
											<div class="wideSearch__topBox">
												<div class="tagBox tagBox_bgPlus">
													<span class="tagBox__name">Азиатская</span>
													<span class="js-remove"></span>
												</div>
												<div class="tagBox tagBox_bgMinus">
													<span class="tagBox__name">Китайская</span>
													<span class="js-remove"></span>
												</div>
												<div class="tagBox tagBox_bgPlus">
													<span class="tagBox__name">Азиатская</span>
													<span class="js-remove"></span>
												</div>
												<div class="tagBox tagBox_bgMinus">
													<span class="tagBox__name">Китайская</span>
													<span class="js-remove"></span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="wideSearch__line wideSearch__line_rows">
									<div class="wideSearch__awc section_930">
										<div class="wideSearch__leftBox">Ингридиенты:</div>
										<input class="g-input g-input_500px g-input_search" type="search" placeholder="..." />
										<div class="wideSearch__btns">
											<input class="g-input g-input_green g-input_fz14 g-input_curp pr20" type="button" value="Добавить" />
											<input class="g-input g-input_orange g-input_fz14 g-input_curp pr20 mr0" type="button" value="Исключить" />
										</div>
									</div>
									<div class="spacer section_930 mb15 pt15"></div>
									<div id="slidesBox" class="slidesBox slidesBox_awc section_930">
										<div class="slidesBox__header">
											<label class="slidesBox__label mr30" for="amount">Минимальная сумма заказа</label>
											<input class="slidesBox__val slidesBox__val_orange" type="text" id="amountMin" />
											<div class="slidesBox__separator">-</div>
											<input class="slidesBox__val slidesBox__val_orange" type="text" id="amountMax" />
											<div class="slidesBox__val slidesBox__val_unit">руб.</div>
										</div>
										<div class="slidesBox__range slidesBox__range_w450 m0" id="slider-range"></div>
										<!-- <input class="slideTime__val" type="text" value="2ч" /> -->
										<!-- <div class="slidesBox__val slidesBox__val_max">120 мин</div> -->
									</div>
									<div class="spacer section_930 mb15 pt15"></div>
									<div class="wideSearch__bottomBox section_930">
										<div class="checkOptions checkOptions_lined">
											<div class="checkOptions__wrap mb0 mr30">
												<label class="messenger__wrap messenger__wrap_mr7">
													<input class="messenger__check" type="checkbox" />
													<div class="messenger__bg"></div>
												</label>
												<div class="checkOptions__name checkOptions__name_orange">Выезд на дом</div>
											</div>
											<div class="checkOptions__wrap">
												<label class="messenger__wrap messenger__wrap_mr7">
													<input class="messenger__check" type="checkbox" />
													<div class="messenger__bg"></div>
												</label>
												<div class="checkOptions__name checkOptions__name_orange">Обслуживание мероприятий</div>
											</div>
										</div>
										<div class="searchBox searchBox_m0">
											<div class="searchBox__wrapper searchBox__wrapper_h55">
												<input class="js-hidden_input" type="hidden">
												<input class="g-input g-input_mr0 g-input_300px g-input_h55 js-input_searchBox" placeholder="Выберите метро ..." type="text" />
												<div class="searchBox__select searchBox__select_r10px js-searchBox__arr"></div>
												<ul class="searchBox__list">
													<li data-value="1" class="searchBox__listItem">Петровско-Разумовская</li>
													<li data-value="2" class="searchBox__listItem">Петровско-Разумовская</li>
													<li data-value="3" class="searchBox__listItem">Петровско-Разумовская</li>
													<li data-value="4" class="searchBox__listItem">Петровско-Разумовская</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="spacer section_930 mb3 pt15"></div>
									<div class="wideSearch__footer">
										<input class="submit" type="submit" value="Найти" />
									</div>
								</div>
							</div>
						</form>

						<div class="map">
							<div class="map__topContainer map__topContainer_h45vw js-toggleToHeight__box">
								<form class="map__form" action="">
									<div class="slidesBox slidesBox_map">
										<div class="slidesBox__header">
											<div class="slidesBox__toggle js-toggleToHeight__toggle">Свернуть карту</div>
											<div class="slidesBox__wrap">
												<label class="slidesBox__label" for="amount">Стоимость блюда</label>
												<input class="slidesBox__val slidesBox__val_orange" type="text" id="amountMin" />
												<div class="slidesBox__separator">-</div>
												<input class="slidesBox__val slidesBox__val_orange" type="text" id="amountMax" />
												<div class="slidesBox__val slidesBox__val_unit">мин</div>
											</div>
										</div>
										<div class="slidesBox__range" id="slider-range"></div>
										<div class="slidesBox__val slidesBox__val_max mr10">2ч</div>
										<div class="checkOptions">
											<div class="checkOptions__wrap">
												<label class="messenger__wrap messenger__wrap_mr7">
													<input class="messenger__check" type="checkbox">
													<div class="messenger__bg"></div>
												</label>
												<div class="checkOptions__name checkOptions__name_orange">Самовывоз</div>
											</div>
											<div class="checkOptions__wrap">
												<label class="messenger__wrap messenger__wrap_mr7">
													<input class="messenger__check" type="checkbox">
													<div class="messenger__bg"></div>
												</label>
												<div class="checkOptions__name checkOptions__name_orange">Доставка</div>
											</div>
										</div>
									</div>
								</form>
								<iframe class="map__iframe" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d287570.256858527!2d37.908402!3d55.7299625!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54afc73d4b0c9%3A0x3d44d6cc5757cf4c!2z0JzQvtGB0LrQstCw!5e0!3m2!1sru!2sru!4v1458406488119" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
							</div>
							<div class="postMapBox">
								<form class="orderStatus" action="">
									<label class="checkBox mr10">
										<input class="checkBox__input js-showOrderStatus__toggle" type="checkbox" />
										<div class="checkBox__bg"></div>
									</label>
									<div class="orderStatus__text orderStatus__text_grey orderStatus__text_fcr js-showOrderStatus__false">Поиск по всем кулинарам</div>
									<div class="orderStatus__text orderStatus__text_green orderStatus__text_fcr js-showOrderStatus__true">Поиск по кулинарам, принимающим заказы</div>
								</form>
								<h3 class="map__subHeader map__subHeader_lined">Повара рядом с вами <span class="map__orange">в радиусе 5 км</span></h3>
							</div>
							<div class="spacer"></div>
							<div class="headerBox headerBox_db p20-30">
								<div class="headerBox__subtitleBox m0">
									<div class="headerBox__subtitle"><?= $h1 ?></div>
									<div class="remove js-removeParent"></div>
								</div>
							</div>
							<div class="spacer mb20"></div>
						</div>

						<form class="form form_awc plr30 pb15" action="">
							<div class="sort sort_pb0">
								<h3 class="sort__title">Сортировка:</h3>
								<a class="sort__item sort__item_bottom" href="#">По рейтингу</a>
							</div>
							<div class="checkOptions">
								<div class="checkOptions__wrap">
									<label class="messenger__wrap messenger__wrap_mr7">
										<input class="messenger__check" type="checkbox">
										<div class="messenger__bg"></div>
									</label>
									<div class="checkOptions__name">Искать в подписках</div>
								</div>
							</div>
						</form>

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



						<div class="spacer spacer_pt20 spacer_mb20"></div>

						<button class="g-link g-link_tac g-link_ma" href="#">Показать в радиусе 10км</button>

					




























			<!-- <form class="popup__form" action="" method="post" id="js_saerchpage_form">
				<input type="hidden" name="_csrf" value="<?//=Yii::$app->request->getCsrfToken()?>" />

				<div class="menuProfile">
					<div class="linksBox linksBox_bb linksBox_pt10b5">
						<label class="radio">
							<input name="dishtype_id" type="radio" class="js_saerchpage_inputDishTypeID" value="any"<?//= (0==$bindedValues['dishtype_id'])?' checked':'' ?>>
							<div>Любого типа</div>
						</label>
						<?//php foreach ($dishtypes as $key => $dt): ?>
							<label class="radio">
								<input name="dishtype_id" type="radio" class="js_saerchpage_inputDishTypeID" value="<?//= $dt->id ?>"<?//= ($dt->id==$bindedValues['dishtype_id'])?' checked':'' ?>>
								<div><?//= $dt->header ?></div>
							</label>
						<?//php endforeach ?>
					</div>
				</div>

				<div class="wideSearch__header">
					<div class="wideSearch__leftBox">
						<label class="wideSearch__lbl mr10" for="lbl1">
							<input class="wideSearch__check js_saerchpage_inputViewType" id="lbl1" type="radio" name="viewType" value="cook"<?//= ($bindedValues['viewType'] == 'cook')?' checked=""':'' ?>>
							<div class="wideSearch__bgCheck wideSearch__bgCheck_cooker"></div>
						</label>
						<label class="wideSearch__lbl" for="lbl2">
							<input class="wideSearch__check js_saerchpage_inputViewType" id="lbl2" type="radio" name="viewType" value="dish"<?//= ($bindedValues['viewType'] == 'dish')?' checked=""':'' ?>>
							<div class="wideSearch__bgCheck wideSearch__bgCheck_dish"></div>
						</label>
					</div>
					<div class="wideSearch__rightBox">
						<input name="searchquery" class="g-input g-input_500px g-input_search" type="search" placeholder="Поиск по блюдам ..." value="<?//= $bindedValues['searchquery'] ?>">
						<div class="wideSearch__more js-toggleBlog__toggle">Расширенный поиск</div>
					</div>
				</div>

			</form> -->

<div class="middleWrapper__container">




<?php
echo "<pre class='antiReset'>";
echo '$_GET '; print_r($_GET);
echo '$_POST '; print_r($_POST);
echo '$_SESSION '; print_r($_SESSION);
echo '$session '; print_r($session['dish']);
echo '$bindedValues '; print_r($bindedValues);
echo "</pre>";

?>


<!-- <?php // if ($products): ?>
	<h2 class="colsBox__lbl colsBox__lbl_mb10">Фирменные блюда</h2>
	<ul class="dish dish_p0">
	<?php // foreach ($products as $key => $p): ?>
		<li class="dish__item">
			<div href="#" class="dish__imgWrap">
				<img src="<?php //= $p->getIconsrc('list') ?>" alt="" class="dish__img">
			</div>
			<div class="dish__bottomBox">
				<div class="time time_poa time_bgcf5">
					<div class="time__wrap">
						<div class="time__img"></div>
						<div class="time__counter">
							<?php // $hours = floor($p->dish->timefrom/60) ?>
							<?php // $minutes = $p->dish->timefrom%60 ?>
							<?php // if ($hours>0): ?>
								<div class="time__val"><?php //= $hours ?></div>
								<div class="time__lbl">ч.</div>
							<?php // endif ?>
							<div class="time__val"><?php //= $minutes ?></div>
							<div class="time__lbl">мин.</div>
						</div>
					</div>
				</div>
				<h3 class="dish__header"><a href="<?php //= Url::to(['site/userproduct', 'id'=>$p->id]) ?>"><?php //= $p->header ?></a></h3>
				<div class="dish__shortText"><?php //= $p->dish->shortText ?></div>
				<div class="dish__bottomLine">
					<div class="dish__priceWrap"><span class="dish__price"><?php //= floor($p->price) ?></span><span class="dish__rouble">&#8381;</span></div>
					

					<div id="ajax_result_ptb_<?php //= $p->id ?>">
						<?php // if ($p->isInBasket): ?>
							<?php // echo $this->render('/site/basketed') ?>
						<?php // else: ?>
							<a href="<?php //= Url::to(['site/basketadd', 'id' => $p->id]) ?>" class="g-link dish__edit js_product_to_basket" data-ajaxresult="ajax_result_ptb_<?php //= $p->id ?>">В корзину</a>
						<?php // endif ?>
					</div>

				</div>
			</div>
		</li>
	<?php // endforeach ?>
<?php // else: ?>
	<p>Нет продуктов удовлетворяющих условия поиска.</p>
<?php // endif ?> -->


<?= LinkPager::widget(['pagination' => $pagination,]); ?>


</div>
		</div>
		<aside class="l-sidebar l-sidebar_right">
			
			<?= $this->render('left') ?>

		</aside>


