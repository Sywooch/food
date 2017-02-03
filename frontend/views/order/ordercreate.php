<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use common\models\Order;

$this->title = 'Оформление заказа';

$this->params['breadcrumbs'][] = ['label' => 'Оформление заказа'];

?>

<aside class="l-sidebar l-sidebar_left">

	<?= $this->render('/user/leftuser', [
	]) ?>

</aside>
<div class="g-flexMiddleChild middleWrapper">

	<div class="menuTop">

		<?= $this->render('/user/top-menu-user', [
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
			<h1 class="headerBox__title">Оформление заказа</h1>
		</div>
	</div>
	<div class="form__border"></div>
	<form class="form" id="form-signup" action="/signup/" method="post" role="form">
		<h4 class="form__header">Вход и регистрация</h4>
		<div class="form__colWrapper form__colWrapper_pl0 form__colWrapper_mb0">
			<div class="form__leftCol form__leftCol_w65">
				<div class="form__section">
					<div class="form__line form__line_centeredContent">
						<label for="" class="form__label">Ваше имя:</label>
						<input name="OrderCreateForm[username]" class="form__val section_500" readonly="" type="text" value="<?= $orderCreateForm->username ?>">
						<div class="form__edit form__edit_order js-form__edit_order"></div>
						<?php if ($orderCreateForm->errors&&isset($orderCreateForm->errors['username'])): ?>
							<div class="error">
								<?php foreach ($orderCreateForm->errors['username'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					</div>
					<div class="form__line form__line_centeredContent">
						<label for="" class="form__label">Ваш телефон:</label>
						<input name="OrderCreateForm[phonenumber]" class="form__val section_500" readonly="" type="text" value="<?= $orderCreateForm->phonenumber ?>">
						<div class="form__edit form__edit_order js-form__edit_order"></div>
						<?php if ($orderCreateForm->errors&&isset($orderCreateForm->errors['phonenumber'])): ?>
							<div class="error">
								<?php foreach ($orderCreateForm->errors['phonenumber'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					</div>
					<div class="form__line form__line_centeredContent">
						<label for="" class="form__label">Ваш e-mail:</label>
						<input name="OrderCreateForm[email]" class="form__val section_500" readonly="" type="text" value="<?= $orderCreateForm->email ?>">
						<div class="form__edit form__edit_order js-form__edit_order"></div>
						<?php if ($orderCreateForm->errors&&isset($orderCreateForm->errors['email'])): ?>
							<div class="error">
								<?php foreach ($orderCreateForm->errors['email'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					</div>
				</div>
				<?php foreach ($orders as $key => $o): ?>
				<div class="form__border"></div>
				<h4 class="form__header">Мой заказ</h4>
					<!-- ============================================================================== -->
				<div class="form__section pl70">
					<div class="form__line form__line_centeredWidth mb10">
						<h3 class="form__subtitle form__subtitle_fz20">Заголовок заказа</h3>
						<a href="<?= Url::to(['site/userprofile', 'id' => $o->cook->id]) ?>" class="imgBox">
							<span class="imgBox__wrap">
								<span class="imgBox__status imgBox__status_active"></span>
								<span class="imgBox__inner">
									<img class="imgBox__img" src="<?= $o->cook->getIconsrc('icon') ?>" alt="">
								</span>
							</span>
							<span class="imgBox__val"><?= $o->cook->username ?></span>
						</a>
					</div>
					<div class="form__border mb10"></div>
					<div class="form__line form__line_centeredContent form__line_top mb15">
						<label class="form__label form__label_w180" for="">Способ доставки:</label>
						<div class="checkOptions">
							<?php if ($o->cook->profile->pickup): ?>
								<div class="checkOptions__wrap">
									<label class="messenger__wrap messenger__wrap_mr7">
										<input name="Order[$key][delivery]" class="messenger__check" type="radio" value="<?= Order::DELIVERY_PICKUP ?>" />
										<div class="messenger__bg"></div>
									</label>
									<div class="checkOptions__name">Самовывоз<span class="checkOptions__subName">(бесплатно)</span></div>
								</div>
							<?php endif ?>
							<div class="checkOptions__wrap">
								<label class="messenger__wrap messenger__wrap_mr7">
									<input name="Order[$key][delivery]" class="messenger__check" type="radio" value="<?= Order::DELIVERY_COURIER ?>">
									<div class="messenger__bg"></div>
								</label>
								<div class="checkOptions__name">Курьер<span class="checkOptions__subName">(??? руб.)</span></div>
							</div>
						</div>
					</div>
					<div class="contentRight mb15">
						<div class="spacer__right"></div>
					</div>
					<div class="form__line form__line_centeredContent form__line_top mb15">
						<label class="form__label form__label_w180" for="">Адрес:</label>
						<div class="checkOptions section_wcalc230">
							<?php foreach ($user->address as $keyAddress => $a): ?>
								<div class="checkOptions__wrap mb0">
									<label class="messenger__wrap messenger__wrap_mr7">
										<input name="Order[$key][address]" class="messenger__check" type="radio" value="<?= $a->address ?>" />
										<div class="messenger__bg"></div>
									</label>
									<div class="checkOptions__name"><?= $a->description ?></div>
								</div>
								<div class="spacer mb5"></div>
								<div class="checkOptions__info"><?= $a->address ?></div>
							<?php endforeach ?>
						</div>
					</div>
					<div class="form__line form__line_centeredContent form__line_top mb15">
						<label class="form__label form__label_w180 pt10" for="">Добавить адрес:</label>
						<div class="section_wcalc180">
							<input class="g-input g-input_mr0 g-input_w100 g-input_search" placeholder="Поиск ..." type="text" />
							<div class="sectAdress">
								<div class="metroBox">
									<div class="metroIcon metroIcon_grey"></div>
									<div class="metroBox__name">Петровско-Разумовская</div>
								</div>
								<a class="mapLink" href="#">На карте</a>
							</div>
						</div>
					</div>
					<div class="contentRight mb15">
						<div class="spacer__right"></div>
					</div>
					<div class="form__line form__line_centeredContent form__line_top mb15">
						<label class="form__label form__label_w180" for=""></label>
						<div class="boxAwt section_wcalc180">
							<div class="checkOptions">
								<div class="checkOptions__wrap">
									<label class="messenger__wrap messenger__wrap_mr7">
										<input class="messenger__check" type="checkbox" />
										<div class="messenger__bg"></div>
									</label>
									<div class="checkOptions__name">Доставка до метро<span class="checkOptions__subName">(0 руб.)</span></div>
								</div>
							</div>
							<div class="innerRightBox">
								<div class="searchBox searchBox_m0 mr10">
									<div class="searchBox__wrapper">
										<input class="g-input g-input_mr0 g-input_w235 js_searchMetroHeader_input" placeholder="Метро" type="text">
									</div>
								</div>
								<a class="mapLink" href="#">На карте</a>
							</div>
						</div>
					</div>
					<div class="contentRight mb15">
						<div class="spacer__right"></div>
					</div>
					<div class="form__line form__line_centeredContent form__line_top mb15">
						<label class="form__label form__label_w180" for="">Способ оплаты:</label>
						<div class="checkOptions">
							<div class="checkOptions__wrap">
								<label class="messenger__wrap messenger__wrap_mr7">
									<input class="messenger__check" type="checkbox">
									<div class="messenger__bg"></div>
								</label>
								<div class="checkOptions__name">Наличными</div>
							</div>
							<div class="checkOptions__wrap">
								<label class="messenger__wrap messenger__wrap_mr7">
									<input class="messenger__check" type="checkbox">
									<div class="messenger__bg"></div>
								</label>
								<div class="checkOptions__name">Вэбмани</div>
							</div>
						</div>
					</div>
					<div class="form__line form__line_centeredContent form__line_top mb15">
						<label class="form__label form__label_w180" for=""></label>
						<div class="section_wcalc180">
							<div class="innerRightBox">
								<input class="g-input g-input_300px g-input_mr0" placeholder="Промокод" type="text">
								<input class="g-input g-input_w115 g-input_h35 g-input_black g-input_tac g-input_ml20 g-input_mr0 g-input_curp g-input_fz14" value="Добавить" type="text">
							</div>
						</div>
					</div>
					<div class="form__line">
						<label for="" class="form__label form__label_w180">Комментарий:</label>
						<textarea class="form__val section_wcalc180 form__val_big setComment" name="" placeholder="..."></textarea>
					</div>
				</div>
				<?php endforeach ?>
			</div>
			<div class="form__rightCol form__rightCol_w35 form__rightCol_tac">



<div class="orderList">
	<div class="orderList__header">Мой заказ</div>
	<?php for ($i=0; $i<2; $i++) { ?>
	<div class="orderList__body">
		<div class="orderList__headingBox">
			<a href="#" class="imgBox">
				<span class="imgBox__wrap">
					<span class="imgBox__status imgBox__status_active"></span>
					<span class="imgBox__inner">
						<img class="imgBox__img" src="../../images/cooker.png" alt="">
					</span>
				</span>
				<span class="imgBox__val">Александр Македонский</span>
			</a>
		</div>
		<div class="orderList__cont">
			<div class="orderList__line">
				<div class="orderList__lbl">Пицца 4 сыра Пицца 4 сыра</div>
				<div class="orderList__val">150000<span class="rouble rouble_black">&#8381;</span></div>
			</div>
			<div class="orderList__line">
				<div class="orderList__lbl">Пицца 4 сыра</div>
				<div class="orderList__val">150<span class="rouble rouble_black">&#8381;</span></div>
			</div>
		</div>
	</div>
	<?php } ?>
	<div class="orderList__bottomBox">
		<div class="orderList__cont">
			<div class="orderList__line orderList__line_h40">
				<div class="orderList__lbl orderList__lbl_post orderList__lbl_cr">Стоимость доставки:</div>
				<div class="orderList__val">150000<span class="rouble rouble_black">&#8381;</span></div>
			</div>
			<div class="orderList__line orderList__line_h40">
				<div class="orderList__lbl orderList__lbl_post orderList__lbl_cr">Итого</div>
				<div class="orderList__val">150<span class="rouble rouble_black">&#8381;</span></div>
			</div>
		</div>
	</div>
	<div class="orderList__footer">
		<a class="g-link g-link_m10-0" href="#">Редактировать</a>
	</div>
</div>






				<div class="banner banner_w330 banner_m25"></div>
			</div>
		</div>
	</form>


















						<!-- <div class="middleWrapper__container">
							<div class="headerBox">
								<h1 class="headerBox__title">Оформление заказа</h1>
							</div>
						</div>
						<div class="form__border"></div>
						<form class="form" id="form-signup" action="<?//= Url::to(['order/ordercreate', 'id' => $cook->id]) ?>" method="post" role="form">
							<input type="hidden" name="_csrf" value="<?//=Yii::$app->request->getCsrfToken()?>" />
							<input type="hidden" name="cookid" value="<?//= $cookid ?>" />
							<h4 class="form__header">???</h4>
							<div class="form__colWrapper form__colWrapper_pl0 form__colWrapper_mb0">
								<div class="form__leftCol form__leftCol_w65">
									<div class="form__section">
										<div class="form__line">
											<label class="form__label" for="">Покупатель:</label>
											<input name="Order[username]" class="form__val section_500" type="text" value="<?//= $user->username ?>" readonly />
										</div>
										<div class="form__line form__line_centeredContent form__line_top">
											<label class="form__label" for="">Способ доставки:</label>
											<div class="checkOptions">
												<div class="checkOptions__wrap">
													<label class="messenger__wrap messenger__wrap_mr7">
														<input class="messenger__check" name="Order[delivery]" type="radio" value="<?//= Order::DELIVERY_PICKUP ?>">
														<div class="messenger__bg"></div>
													</label>
													<div class="checkOptions__name">Самовывоз<span class="checkOptions__subName">(бесплатно)</span></div>
												</div>
												<div class="checkOptions__wrap">
													<label class="messenger__wrap messenger__wrap_mr7">
														<input class="messenger__check" name="Order[delivery]" type="radio" value="<?//= Order::DELIVERY_COURIER ?>">
														<div class="messenger__bg"></div>
													</label>
													<div class="checkOptions__name">Курьер<span class="checkOptions__subName">(190 руб.)</span></div>
												</div>
												<div class="checkOptions__wrap">
													<label class="messenger__wrap messenger__wrap_mr7">
														<input class="messenger__check" name="Order[delivery]" type="radio" value="<?//= Order::DELIVERY_METRO ?>">
														<div class="messenger__bg"></div>
													</label>
													<div class="checkOptions__name">Доставка до метро<span class="checkOptions__subName">(0 руб.)</span></div>
												</div>
												<?//php if ($order->errors&&isset($order->errors['delivery'])): ?>
													<div class="error">
														<?//php foreach ($order->errors['delivery'] as $error): ?>
															<p><?//= $error ?></p>
														<?//php endforeach ?>
													</div>
												<?//php endif ?>
											</div>
											<div class="searchBox searchBox_m0 searchBox_rightBox">
												<div class="searchBox__wrapper">
													<input class="js-hidden_input" type="hidden">
													<input name="OrderCreateForm[metroheader]" class="g-input g-input_mr0 g-input_300px js-input_searchBox" placeholder="Метро" type="text">
													<div class="searchBox__select searchBox__select_r10px js-searchBox__arr">Выбрать</div>
													<ul class="searchBox__list" style="display: none;">
														<li data-value="1" class="searchBox__listItem">Петровско-Разумовская</li>
														<li data-value="2" class="searchBox__listItem">Петровско-Разумовская</li>
														<li data-value="3" class="searchBox__listItem">Петровско-Разумовская</li>
														<li data-value="4" class="searchBox__listItem">Петровско-Разумовская</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="form__border"></div>
									<h4 class="form__header">Адрес доставки</h4>
									<div class="form__section">
										<div class="form__line form__line_centeredContent">
											<label for="" class="form__label">Адрес:</label>
											<input class="form__val section_500 form__val_ph" placeholder="г. Москва, ул. Автозаводская д. 13" type="text" value="<?//= $user->address[0]->address ?>">
											<div class="form__add">Plus</div>
										</div>
										<div class="js-hiddenBox form__line">
											<div class="form__line form__line_centeredContent g-m_b25">
												<label for="" class="form__label">Добавить метро:</label>
												<input class="g-input g-input_search section_500" placeholder="Поиск ..." type="text">
											</div>
											<div class="form__line form__line_centeredContent">
												<label for="" class="form__label">Добавить адрес:</label>
												<input class="g-input g-input_search section_500" placeholder="Поиск ..." type="text">
											</div>
											<div class="metroBox metroBox_pl230">
												<div class="metroInner">
													<div class="metroIcon metroIcon_grey"><div class="metroSymb">Метро</div></div>
													<div class="metroName">Петровско-Разумовская</div>
												</div>
												<a href="#" class="metroMap">На карте</a>
											</div>
										</div>
										<div class="form__line form__line_ml230 section_500 form__line_centeredContent">
											<input class="form__val form__val_italic form__val_wide" placeholder="Комментарий (дом/работа)" type="text" value="<?//= $user->address[0]->description ?>">
											<div class="section_500 g-textAlign_right">
												<input class="g-button" value="Добавить" type="button">
											</div>
										</div>
									</div>
								</div>
								<div class="form__rightCol form__rightCol_w35 form__rightCol_tac">
									<div class="orderList">
										<div class="orderList__header">Мой заказ</div>
										<div class="orderList__cont">
											<?//php $fullsum = 0; ?>
											<?//php foreach ($basket as $productid => $b): ?>
												<?//php if ($b['cookid']==$cookid): ?>
													<?//php $fullsum+= $b['sum']; ?>
													<div class="orderList__line">
														<div class="orderList__lbl"><?//= $products[$productid]->header ?></div>
														<div class="orderList__val"><?//= $b['sum'] ?><span class="rouble">&#8380;</span></div>
													</div>
												<?//php endif ?>
											<?//php endforeach ?>
										</div>
										<div class="orderList__cont">
											<div class="orderList__line">
												<div class="orderList__lbl orderList__lbl_cr">Стоимость доставки:</div>
												<div class="orderList__val"><?//= round($cook->profile->costdelivery) ?><span class="rouble">&#8381;</span></div>
												<?//php $fullsum+= $cook->profile->costdelivery; ?>
											</div>
											<div class="orderList__line">
												<div class="orderList__lbl orderList__lbl_cr">Итого</div>
												<input name="Order[amount]" type="hidden" value="<?//= $fullsum ?>" />
												<div class="orderList__val"><?//= $fullsum ?><span class="rouble">&#8381;</span></div>
											</div>
										</div>
										<div class="orderList__footer">
											<a class="g-link g-link_m10-0" href="<?//= Url::to(['site/basket']) ?>">Редактировать</a>
										</div>
									</div>
									<div class="banner banner_w330 banner_m25"></div>
								</div>
							</div>
							<div class="form__border"></div>
							<h4 class="form__header">Способ оплаты</h4>
							<div class="form__section">
								<div class="form__line form__line_centeredContent form__line_top form__line_ml230">
									<div class="checkOptions">
										<?//php foreach (Order::$payName as $key => $pn): ?>
											<div class="checkOptions__wrap">
												<label class="messenger__wrap messenger__wrap_mr7">
													<input name="Order[pay]" class="messenger__check" type="radio" value="<?//= $key ?>">
													<div class="messenger__bg"></div>
												</label>
												<div class="checkOptions__name"><?//= $pn ?></div>
											</div>
										<?//php endforeach ?>
										<?//php if ($order->errors&&isset($order->errors['pay'])): ?>
											<div class="error">
												<?//php foreach ($order->errors['pay'] as $error): ?>
													<p><?//= $error ?></p>
												<?//php endforeach ?>
											</div>
										<?//php endif ?>
									</div>
								</div>
								<div class="form__line form__line_centeredWidth section_500 form__line_ml230">
									<input class="g-input g-input_300px g-input_mr0 g-input_wflex" placeholder="Промокод" type="text">
									<input class="g-input g-input_w115 g-input_h35 g-input_black g-input_tac g-input_ml20 g-input_mr0 g-input_curp" type="text" value="Добавить">
								</div>
							</div>
							<div class="form__border"></div>
							<h4 class="form__header">Комментарий к заказу</h4>
							<div class="form__section">
								<div class="form__line">
									<textarea class="form__placeholder form__placeholder_centBig" placeholder="Комментарий к заказу"></textarea>
								</div>
							</div>
							<div class="form__border"></div>
							<div class="form__section form__section_pt25">
								<div class="form__line form__line_center">
									<input class="g-button g-button_big" value="Подтвердить заказ" type="submit">
								</div>
							</div>
						</form> -->





</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('/site/right', [
	]) ?>

</aside>