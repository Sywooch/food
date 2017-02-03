<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
use frontend\models\Pjax;


$this->title = 'Профиль ' . $user->username;

$this->params['breadcrumbs'][] = ['label' => 'Профиль ' . $user->username];


?>
<aside class="l-sidebar l-sidebar_left">

	<?= $this->render('left'.$user->usertype, [
		'user' => $user,
	]) ?>

</aside>
<div class="g-flexMiddleChild middleWrapper s_profile">

	<?php if (Yii::$app->user->identity): ?>
		<div class="menuTop">
			<ul class="menuTop__tabs">
				<li class="menuTop__item"><a class="menuTop__link" href="#">Уведомления</a></li>
				<li class="menuTop__item"><a class="menuTop__link" href="#">Сообщения<span class="g-count"><span class="g-count__val">99</span></span></a></li>
				<li class="menuTop__item"><a class="menuTop__link" href="#">Отзывы</a></li>
				<li class="menuTop__item"><a class="menuTop__link" href="#">Заказы</a></li>
				<li class="menuTop__item"><a class="menuTop__link" href="#">Рейтинг</a></li>
			</ul>
			<div class="menuTop__links">
				<a href="#" class="g-link g-link_orange g-link_colOrange g-link_mr20">Добавить фото</a>
				<a href="#" class="g-link g-link_mr20">Сменить пароль</a>
				<a href="#" class="g-link g-link_edit g-link_mr30 g-link_pr35">Редактировать профиль</a>
			</div>
		</div>
	<?php endif ?>

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

		<div class="colsBox">
			<div class="colsBox__col colsBox__col_w280 s_left_side">

				<div class="list__innerWrapper s_small_avatar">
					<span class="list__status"></span>
					<a href="#" class="list__img">
						<img class="list__innerImg" src="<?= $profile->iconsrc ?>" alt="">
					</a>
					<div class="g-cooker g-cooker_w170">
						<div class="g-cooker__line"><?= $user->name ?></div>
						<div class="rateBox">
							<a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
							<a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
							<a href="#" class="rateBox__item rateBox__item_w4 js-rate"></a>
							<a href="#" class="rateBox__item js-rate"></a>
							<a href="#" class="rateBox__item js-rate"></a>
						</div>
					</div>
				</div>


				<div class="form__photo form__photo_w250 form__photo_h300 form__photo_mb15 form__photo_mid" href="#">
					<img class="form_mainPhoto" src="<?= $profile->iconsrc ?>" alt="" />
					<div class="photoFooter">
						<div class="check mr5"></div>
						<div class="photoFooter__lbl">Статус кулинара:</div>
						<div class="photoFooter__val mr5">проверен</div>
						<div class="question question_at"></div>
					</div>
				</div>

				<div class="colsBox__line">
					<div class="colsBox__lbl colsBox__lbl_green">Принимаю заказы</div>
				</div>
				<div class="spacer spacer_mb10 s_first_space"></div>

				<div class="colsBox__col s_reviews">
					<div class="toolsBox toolsBox_mb30">
						<div class="toolsBox__item">
							<a class="toolsBox__count toolsBox__count_greenBright" href="#">178</a>
							<a class="toolsBox__name" href="#">Отзывов</a>
						</div>
					</div>
					<a class="g-link mb30" href="#">Пожаловаться</a>
					<div class="locBox">
						<a class="locBox__icon" href="#">0.3 км от вас</a>
					</div>
				</div>

				<div class="s_collapse_contacts">
					<div class="s_control js-showFallingList__toggle">
						<span>Контактная информация</span>
						<span class="s_arrow js-showFallingList__arr"></span>
					</div>

					<div class="s_show js-showFallingList__box">
						<div class="colsBox__line">
							<?php if ($address): ?>
								<div class="colsBox__lbl">Адрес</div>
								<div class="colsBox__val colsBox__val_pb5"><?= $address->address ?><?= $address->description?' (' . $address->description . ')':'' ?></div>
								<?php if ($address->metro_id): ?>
									<div class="metroBox">
										<div class="metroIcon metroIcon_green"></div>
										<div class="metroBox__name"><?= $address->metrostation->header ?></div>
									</div>
								<?php endif ?>
							<?php endif ?>
						</div>

						<?php foreach ($phonenumbers as $key => $p): ?>
							<div class="colsBox__line">
								<div class="colsBox__lbl colsBox__lbl_midCont">Телефон <div class="whatsUp whatsUp_ml10"></div><div class="viber viber_ml10"></div></div>
								<div class="colsBox__val"><?= $p->phonenumber ?></div>
							</div>
							<?php if ($p->whatsapp&&($p->whatsappnumber == $p->phonenumber)): ?>
								<div class="whatsUp whatsUp_ml10"></div>
							<?php endif ?>
							<?php if ($p->viber&&($p->vibernumber == $p->phonenumber)): ?>
								<div class="viber viber_ml10"></div>
							<?php endif ?>
						    <?php if ($p->whatsapp&&($p->whatsappnumber != $p->phonenumber)): ?>
							<div class="colsBox__line">
								<div class="colsBox__lbl colsBox__lbl_midCont">Телефон what's up <div class="whatsUp whatsUp_ml10"></div></div>
								<div class="colsBox__val"><?= $p->whatsappnumber ?></div>
							</div>
							<?php endif ?>
						    <?php if ($p->viber&&($p->vibernumber != $p->phonenumber)): ?>
							<div class="colsBox__line">
								<div class="colsBox__lbl colsBox__lbl_midCont">Телефон viber <div class="viber viber_ml10"></div></div>
								<div class="colsBox__val"><?= $p->vibernumber ?></div>
							</div>
							<?php endif ?>
							<div class="colsBox__line">
								<div class="colsBox__lbl">Удобное время для связи</div>
								<div class="colsBox__val"><?= $profile->callfrom ?> - <?= $profile->callto ?></div>
							</div>
						<?php endforeach ?>
						<div class="colsBox__line colsBox__line_mb0">
							<div class="colsBox__lbl">Почта</div>
							<div class="colsBox__val"><?= $user->email ?></div>
						</div>
					</div>
				</div>

				<?php if (Yii::$app->user->identity): ?>
					<input type="button" class="g-button g-button_db g-button_mb15 g-button_w210 s_pojal" value="Пожаловаться" />
					<input type="button" class="g-button g-button_db g-button_mb15 g-button_w210" value="Написать сообщение" />
					<?php if ($isFavorite): ?>
						<div class="g-button g-button_db g-button_mb15 g-button_w210 g-button_fav">Вы уже подписаны</div>
					<?php else: ?>
						<?php Pjax::begin(['id' => 'favorite']); ?>
						<form action="<?= Url::to(['site/userprofile', 'id' => $profile->user->id]) ?>" method="post" data-pjax="1">
							<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
							<input name="toFavorite" type="submit" class="g-button g-button_db g-button_mb15 g-button_w210 g-button_fav" value="Подписаться">
						</form>
						<?php Pjax::end(); ?>
					<?php endif ?>
				<?php endif ?>

				<div class="subscribers">
					<div class="subscribers__item subscribe">
						<div class="subscribers__lbl">Подписки</div>
						<div class="subscribers__val">(<span class="subscribers__count">12</span>)</div>
					</div>
					<div class="subscribers__item subscribers">
						<div class="subscribers__lbl">Подписчики</div>
						<div class="subscribers__val">(<span class="subscribers__count">34</span>)</div>
					</div>
				</div>

				<div class="spacer spacer_mb10"></div>
				<div class="colsBox__preview">
					<?php if ($products): ?>
					<h2 class="colsBox__lbl colsBox__lbl_mb10">Фирменные блюда</h2>
					<ul class="dish dish_p0">
						<?php foreach ($products as $key => $p): ?>
							<li class="dish__item mr0 ml0">
								<div href="#" class="dish__imgWrap">
									<img src="<?= $p->getIconsrc('list') ?>" alt="" class="dish__img" />
								</div>
								<div class="dish__bottomBox">
									<div class="time time_poa time_bgcf5">
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
									<h3 class="dish__header"><?= $p->header ?></h3>
									<div class="dish__shortText"><?= $p->dish->text ?></div>
									<div class="dish__bottomLine">
										<div class="dish__priceWrap">
											<span class="dish__price"><?= floor($p->price) ?></span><span class="dish__rouble">&#8381;</span>
										</div>
										<a href="<?= Url::to(['site/userproduct', 'id' => $p->id]) ?>" class="g-link dish__edit">Заказать</a>
									</div>
								</div>
							</li>
						<?php endforeach ?>
						<?php endif ?>
					</ul>
				</div>
			</div>
			<div class="colsBox__col colsBox__col_w530 s_info">
				<div class="s_wrap_info">
					<div class="titleBox">
						<h1 class="titleBox__title"><?= $user->name ?></h1>
						<div class="rateBox">
							<a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
							<a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
							<a href="#" class="rateBox__item rateBox__item_w4 js-rate"></a>
							<a href="#" class="rateBox__item js-rate"></a>
							<a href="#" class="rateBox__item js-rate"></a>
						</div>
					</div>
					<div class="colsBox__line">
						<div class="colsBox__lbl colsBox__lbl_green">Принимаю заказы</div>
					</div>
					<div class="spacer spacer_mb10 s_first_space"></div>

					<div class="colsBox__col s_reviews">
						<div class="toolsBox toolsBox_mb30">
							<div class="toolsBox__item">
								<a class="toolsBox__count toolsBox__count_greenBright" href="#">178</a>
								<a class="toolsBox__name" href="#">Отзывов</a>
							</div>
						</div>
						<a class="g-link mb30" href="#">Пожаловаться</a>
						<div class="locBox">
							<a class="locBox__icon" href="#">0.3 км от вас</a>
						</div>
					</div>
					<div class="colsBox__line">
						<?php if ($address): ?>
							<div class="colsBox__lbl">Адрес</div>
							<div class="colsBox__val colsBox__val_pb5"><?= $address->address ?><?= $address->description?' (' . $address->description . ')':'' ?></div>
							<?php if ($address->metro_id): ?>
								<div class="metroBox">
									<div class="metroIcon metroIcon_green"></div>
									<div class="metroBox__name"><?= $address->metrostation->header ?></div>
								</div>
							<?php endif ?>
						<?php endif ?>
					</div>
					<?php foreach ($phonenumbers as $key => $p): ?>
						<div class="colsBox__line">
							<div class="colsBox__lbl colsBox__lbl_midCont">Телефон <div class="whatsUp whatsUp_ml10"></div><div class="viber viber_ml10"></div></div>
							<div class="colsBox__val"><?= $p->phonenumber ?></div>
						</div>

						<div class="colsBox__line">
							<div class="colsBox__lbl colsBox__lbl_midCont">Телефон what's up <div class="whatsUp whatsUp_ml10"></div></div>
							<div class="colsBox__val"><?= $p->whatsappnumber ?></div>
						</div>
						<div class="colsBox__line">
							<div class="colsBox__lbl colsBox__lbl_midCont">Телефон viber <div class="viber viber_ml10"></div></div>
							<div class="colsBox__val"><?= $p->vibernumber ?></div>
						</div>
						<div class="colsBox__line">
							<div class="colsBox__lbl">Удобное время для связи</div>
							<div class="colsBox__val"><?= $profile->callfrom ?> - <?= $profile->callto ?></div>
						</div>
					<?php endforeach ?>
					<div class="colsBox__line colsBox__line_mb0">
						<div class="colsBox__lbl">Почта</div>
						<div class="colsBox__val"><?= $user->email ?></div>
					</div>
				</div>

				<?php if ($cookkitchens): ?>
					<div class="spacer spacer_mb20 spacer_pt20 s_kitchen_space "></div>
					<div class="colsBox__line colsBox__line_mb0">
						<div class="colsBox__lbl colsBox__lbl_mb10">Кухня</div>
						<?php foreach ($cookkitchens as $key => $ck): ?>
							<div class="tagBox"><span class="tagBox__name"><?= $ck['header'] ?></span></div>
						<?php endforeach ?>
					</div>
				<?php else: ?>
					<div class="spacer spacer_mb20 spacer_pt20 s_kitchen_space "></div>
					<div class="colsBox__line colsBox__line_mb0">
						<p class="colsBox__val colsBox__val_fz14">Нет ни одного блюда.</p>
					</div>
				<?php endif ?>

				<?php if ($fotokitchens): ?>
				<div class="spacer spacer_mb20 spacer_pt20"></div>
				<div class="colsBox__line colsBox__line_mb0">
					<div class="colsBox__lbl">Фото кухни</div>
					<ul class="form__list">
						<?php foreach ($fotokitchens as $key => $fk): ?>
							<li class="form__photos">
								<div class="form__photo">
									<a href="<?= $fk->source ?>"><img class="form__img" src="<?= $fk->getSource('icon') ?>" alt="" /></a>
								</div>
							</li>
						<?php endforeach ?>
					</ul>
					<?php else: ?>
						<div class="spacer spacer_mb20 spacer_pt20"></div>
						<div class="colsBox__line colsBox__line_mb0">
							<p class="colsBox__val colsBox__val_fz14">Не добавлены.</p>
						</div>
					<?php endif ?>

					<div class="spacer spacer_mb20 spacer_pt10"></div>
					<div class="checkOptions">
						<div class="checkOptions__wrap checkOptions__wrap_lined">
							<label class="messenger__wrap messenger__wrap_mr7">
								<?php if ($profile->pickup): ?>
									<div class="messenger__checked"></div>
								<?php endif ?>
							</label>
							<div class="checkOptions__name">Самовывоз</div>
						</div>
						<div class="checkOptions__wrap checkOptions__wrap_lined">
							<label class="messenger__wrap messenger__wrap_mr7">
								<<?php if ($profile->workhome): ?>
									<div class="messenger__checked"></div>
								<?php endif ?>
							</label>
							<div class="checkOptions__name">Выезд на дом</div>
						</div>
						<div class="checkOptions__wrap checkOptions__wrap_lined">
							<label class="messenger__wrap messenger__wrap_mr7">
								<?php if ($profile->workevent): ?>
									<div class="messenger__checked"></div>
								<?php endif ?>
							</label>
							<span class="checkOptions__name">Работа на мероприятиях</span>
						</div>
					</div>
					<div class="spacer spacer_mb20 spacer_pt10"></div>
					<div class="colsBox__line colsBox__line_mb0">
						<div class="colsBox__lbl mb20">Варианты доставки:</div>
						<div class="colsBox__lbl colsBox__lbl_grey mb5">Доставка в пределах МКАД</div>
						<div class="lineTable">
							<div class="lineTable__row">
								<div class="lineTable__box">
									<div class="lineTable__lbl orange">Стоимость:</div>
									<div class="lineTable__line"></div>
								</div>
								<div class="lineTable__val grey fz18"><?= floor($profile->costdelivery) ?> Руб.</div>
							</div>
							<div class="lineTable__row">
								<div class="lineTable__box">
									<div class="lineTable__lbl orange">Бесплатная доставка от:</div>
									<div class="lineTable__line"></div>
								</div>
								<div class="lineTable__val grey fz18"><?= floor($profile->costfree) ?> Руб.</div>
							</div>
						</div>
						<div class="spacer spacer_mb20 spacer_pt10"></div>
						<div class="colsBox__lbl colsBox__lbl_grey mb5">Доставка с регионом</div>
						<iframe class="iframe mb10" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d35975.261577014695!2d37.82586455!3d55.6984825!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sru!4v1466150247992" width="100%" height="180" frameborder="0" style="border:0" allowfullscreen></iframe>
						<div class="lineTable">
							<div class="lineTable__row">
								<div class="lineTable__box">
									<div class="lineTable__lbl orange">Стоимость:</div>
									<div class="lineTable__line"></div>
								</div>
								<div class="lineTable__val grey fz18"><?= floor($profile->costdelivery) ?> Руб.</div>
							</div>
							<div class="lineTable__row">
								<div class="lineTable__box">
									<div class="lineTable__lbl orange">Бесплатная доставка от:</div>
									<div class="lineTable__line"></div>
								</div>
								<div class="lineTable__val grey fz18"><?= floor($profile->costfree) ?> Руб.</div>
							</div>
						</div>
					</div>
					<div class="spacer spacer_pt10 mb15"></div>
					<div class="colsBox__line">
						<div class="colsBox__lbl colsBox__lbl_grey mb10">Доставка до метро</div>
					</div>
					<?php if ($address): ?>
						<?php if ($address->metro_id): ?>
							<div class="colsBox__line colsBox__line_alc">
								<?php //foreach ($metrobranch as $key => $fk): ?>
								<div class="metroBox mr10">
									<div class="metroIcon metroIcon_green"></div>
									<div class="metroBox__name"><?= $address->metrostation->header ?></div>
								</div>
								<?php// endforeach ?>
								<a class="popupLink" href="#">На схеме</a>
							</div>
						<?php endif ?>
					<?php endif ?>

					<div class="lineTable">
						<div class="lineTable__row">
							<div class="lineTable__box">
								<div class="lineTable__lbl orange">Стоимость:</div>
								<div class="lineTable__line"></div>
							</div>
							<div class="lineTable__val grey fz18">100 Руб.</div>
						</div>
						<div class="lineTable__row">
							<div class="lineTable__box">
								<div class="lineTable__lbl orange">Бесплатная доставка от:</div>
								<div class="lineTable__line"></div>
							</div>
							<div class="lineTable__val grey fz18">2000 Руб.</div>
						</div>
					</div>
					<div class="spacer spacer_mb10 spacer_pt10"></div>
					<div class="colsBox__line colsBox__line_mb0">
						<div class="colsBox__lbl mb0">Варианты оплаты</div>
						<ul class="payments">
							<li class="payments__item payments__item_inline">
								<div class="payments__img payments__img_mr15 payments__img_ya"></div>
							</li>
							<li class="payments__item payments__item_inline">
								<div class="payments__img payments__img_mr15 payments__img_visa"></div>
							</li>
							<li class="payments__item payments__item_inline">
								<div class="payments__img payments__img_mr15 payments__img_webmoney"></div>
							</li>
						</ul>
					</div>
					<div class="spacer spacer_mb20 spacer_pt20"></div>
					<div class="colsBox__line">
						<div class="colsBox__lbl">Видео</div>
						<?php if ($profile->video): ?>
							<a class="videoBox videoBox_h315" href="#">
								<iframe src="<?= $profile->video ?>" allowfullscreen="" width="100%" height="100%" frameborder="0"></iframe>
							</a>
						<?php endif; ?>
					</div>
					<div class="spacer spacer_mb20 spacer_pt10"></div>
					<div class="colsBox__line s_about_me">
						<div class="colsBox__lbl">Обо мне</div>
						<p class="colsBox__val colsBox__val_fz14">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo ullam obcaecati impedit deleniti cupiditate possimus blanditiis totam, iste non maxime dicta, magnam ea, asperiores id voluptas unde corporis. Repellat, ducimus! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur assumenda sapiente consectetur eligendi eaque culpa eum, odit tempore, atque optio! Blanditiis dolor, delectus quam, eligendi vel atque. Voluptatum, officia, asperiores. </p>
					</div>
					<div class="spacer spacer_mb20 spacer_pt10"></div>
					<div class="colsBox__line colsBox__line_mb0">
						<div class="colsBox__lbl">Сертификаты</div>
						<ul class="form__list">
							<?php if ($fotodocs): ?>
								<?php foreach ($fotodocs as $key => $fd): ?>
									<li class="form__photos">
										<div class="form__photo">
											<a href="<?= $fd->source ?>"><img class="form__img" src="<?= $fd->getSource('icon') ?>" alt="" /></a>
										</div>
									</li>
								<?php endforeach ?>
							<?php else: ?>
								<p class="colsBox__val colsBox__val_fz14">Не добавлены.</p>
							<?php endif ?>
						</ul>
					</div>
					<div class="spacer spacer_mb20 spacer_pt10"></div>
					<div class="colsBox__line mb20">
						<div class="colsBox__lbl">Поделиться в соц сетях</div>
						<div class="socialBox">
							<?php for ($i=0; $i < 5 ; $i++) { ?>
								<a class="socialBox__icon socialBox__icon_mail" href="#">mail.ru</a>
							<?php } ?>
						</div>
					</div>
				</div>

			</div>
			<div class="colsBox__col colsBox__col_wCalc-810 s_reviews_right">
				<div class="toolsBox toolsBox_mb30">
					<div class="toolsBox__item">
						<a class="toolsBox__count toolsBox__count_greenBright" href="#">178</a>
						<a class="toolsBox__name" href="#">Отзывов</a>
					</div>
				</div>
				<a class="g-link mb30" href="#">Пожаловаться</a>
				<div class="locBox">
					<a class="locBox__icon" href="#">0.3 км от вас</a>
				</div>
			</div>
		</div>
	</div>
</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('right', [
	]) ?>

</aside>
