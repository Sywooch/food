<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

$this->params['breadcrumbs'][] = ['label' => 'Профиль'];

$this->title = 'Профиль';

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

		<div>
			<?= Html::a('Сменить пароль', ['user/change-password'], ['class' => 'g-link g-link_mr20']) ?>
			<?php if (Yii::$app->controller->action->id != 'profileupdate'): ?>
				<?= Html::a('Редактировать профиль', ['user/profileupdate'], ['class' => 'g-link g-link_edit g-link_mr30 g-link_pr35']) ?>
			<?php endif ?>
		</div>

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
		<div class="colsBox">
			<div class="colsBox__col colsBox__col_w280">

				<div class="form__photo form__photo_w250 form__photo_h300 form__photo_mb15 form__photo_mid" href="#">
					<img class="form_mainPhoto" src="<?= $profile->iconsrc ?>" alt="" />
				</div>
				
				<div class="colsBox__preview">

<?php if ($products): ?>
	<h2 class="colsBox__lbl colsBox__lbl_mb10">Фирменные блюда</h2>
	<ul class="dish dish_p0">
	<?php foreach ($products as $key => $p): ?>
		<li class="dish__item">
			<div href="#" class="dish__imgWrap">
				<img src="<?= $p->getIconsrc('list') ?>" alt="" class="dish__img">
			</div>
			<div class="dish__bottomBox">
				<div class="time time_poa time_bgcf5">
					<div class="time__wrap">
						<div class="time__img"></div>
						<div class="time__counter">
							<?php $hours = floor($p->dish->timefrom/60) ?>
							<?php $minutes = $p->dish->timefrom%60 ?>
							<?php if ($hours>0): ?>
								<div class="time__val"><?= $hours ?></div>
								<div class="time__lbl">ч.</div>
							<?php endif ?>
							<div class="time__val"><?= $minutes ?></div>
							<div class="time__lbl">мин.</div>
						</div>
					</div>
				</div>
				<h3 class="dish__header"><?= $p->header ?></h3>
				<div class="dish__shortText"><?= $p->dish->text ?></div>
				<div class="dish__bottomLine">
					<div class="dish__priceWrap"><span class="dish__price"><?= floor($p->price) ?></span><span class="dish__rouble">&#8381;</span></div>
					<a href="<?= Url::to(['user/menuupdate', 'id' => $p->id]) ?>" class="g-link dish__edit">Редактировать</a>
				</div>
			</div>
		</li>
	<?php endforeach ?>
<?php endif ?>








					</ul>
				</div>
			</div>
			<div class="colsBox__col colsBox__col_w530">
				<div class="titleBox">
					<h1 class="titleBox__title"><?= $user->username ?></h1>
					<div class="g-cooker__favorite"></div>
				</div>
<?php if ($address): ?>
	<div class="colsBox__line">
		<div class="colsBox__lbl">Адрес</div>
		<div class="colsBox__val colsBox__val_pb5">
			<?= $address->address ?><?= $address->description?' (' . $address->description . ')':'' ?>
		</div>
		<?php if ($address->metro_id): ?>
			<div class="metroBox">
				<div class="metroIcon metroIcon_green"></div>
				<div class="metroBox__name"><?= $address->metrostation->header ?></div>
			</div>
		<?php endif ?>
	</div>
<?php endif ?>

<?php foreach ($phonenumbers as $key => $p): ?>
	<div class="colsBox__line">
		<div class="colsBox__lbl colsBox__lbl_midCont">Телефон 
			<?php if ($p->whatsapp&&($p->whatsappnumber == $p->phonenumber)): ?>
				<div class="whatsUp whatsUp_ml10"></div>
			<?php endif ?>
			<?php if ($p->viber&&($p->vibernumber == $p->phonenumber)): ?>
				<div class="viber viber_ml10"></div>
			<?php endif ?>
		</div>
		<div class="colsBox__val">+<?= $p->phonenumber ?></div>
	</div>
	<?php if ($p->whatsapp&&($p->whatsappnumber != $p->phonenumber)): ?>
		<div class="colsBox__line">
			<div class="colsBox__lbl colsBox__lbl_midCont">Телефон what's up <div class="whatsUp whatsUp_ml10"></div></div>
			<div class="colsBox__val">+<?= $p->whatsappnumber ?></div>
		</div>
	<?php endif ?>
	<?php if ($p->viber&&($p->vibernumber != $p->phonenumber)): ?>
		<div class="colsBox__line">
			<div class="colsBox__lbl colsBox__lbl_midCont">Телефон viber <div class="viber viber_ml10"></div></div>
			<div class="colsBox__val">+<?= $p->vibernumber ?></div>
		</div>
	<?php endif ?>
<?php endforeach ?>

				<div class="colsBox__line">
					<div class="colsBox__lbl">Удобное время для связи</div>
					<div class="colsBox__val"><?= $profile->callfrom ?> - <?= $profile->callto ?></div>
				</div>
				<div class="colsBox__line colsBox__line_mb0">
					<div class="colsBox__lbl">Почта</div>
					<div class="colsBox__val"><?= $user->email ?></div>
				</div>
				<div class="spacer spacer_mb20 spacer_pt20"></div>
				<div class="colsBox__line colsBox__line_mb0">
					<div class="colsBox__lbl colsBox__lbl_mb10">Кухни повара</div>



<?php if ($cookkitchens): ?>
	<?php foreach ($cookkitchens as $key => $ck): ?>
		<div class="tagBox"><span class="tagBox__name"><?= $ck['header'] ?></span></div>
	<?php endforeach ?>
<?php else: ?>
	<p class="colsBox__val colsBox__val_fz14">Нет ни одного блюда, создайте свое <a href="<?= Url::to(['user/menu']) ?>">меню</a></p>
<?php endif ?>



				</div>
				<div class="spacer spacer_mb20 spacer_pt20"></div>
				<div class="colsBox__line colsBox__line_mb0">
					<div class="colsBox__lbl colsBox__lbl_mb10">Варианты оплаты</div>
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
				<div class="colsBox__line colsBox__line_mb0">
					<div class="colsBox__lbl colsBox__lbl_mb10">Область доставки</div>
					<!-- <iframe class="iframe" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d35975.261577014695!2d37.82586455!3d55.6984825!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sru!4v1466150247992" width="100%" height="180" frameborder="0" style="border:0" allowfullscreen></iframe> -->

<input id="js_profilecookmap_inputregion" type="hidden" value="<?= $profile->region ?>" />
<div id="map_region" style="height: 420px; width: 840px"></div>
<?php $this->registerJsFile('https://api-maps.yandex.ru/2.1/?lang=ru_RU', ['depends' => [frontend\assets\MainAsset::className()]]); ?>
<?php $this->registerJsFile('/js/profilecookmapview.js', ['depends' => [frontend\assets\MainAsset::className()]]); ?>

				</div>
				<div class="spacer spacer_mb20 spacer_pt20"></div>
				<div class="colsBox__line colsBox__line_awt">
					<div>
						<div class="colsBox__line">
							<div class="colsBox__lbl">Минимальная сумма заказа:</div>
							<div class="colsBox__val"><?= floor($profile->costmin) ?> Руб.</div>
						</div>
						<div class="colsBox__line">
							<div class="colsBox__lbl">Бесплатная доставка от:</div>
							<div class="colsBox__val"><?= floor($profile->costfree) ?> Руб.</div>
						</div>
						<div class="colsBox__line">
							<div class="colsBox__lbl">Стоимость доставки:</div>
							<div class="colsBox__val"><?= floor($profile->costdelivery) ?> Руб.</div>
						</div>
					</div>
					<div class="checkOptions">
						<div class="checkOptions__wrap">
							<label class="messenger__wrap messenger__wrap_mr7">
								<?php if ($profile->pickup): ?>
									<div class="messenger__checked"></div>
								<?php endif ?>
							</label>
							<div class="checkOptions__name">Самовывоз</div>
						</div>
						<div class="checkOptions__wrap">
							<label class="messenger__wrap messenger__wrap_mr7">
								<?php if ($profile->workhome): ?>
									<div class="messenger__checked"></div>
								<?php endif ?>
							</label>
							<div class="checkOptions__name">Выезд на дом</div>
						</div>
						<div class="checkOptions__wrap">
							<label class="messenger__wrap messenger__wrap_mr7">
								<?php if ($profile->workevent): ?>
									<div class="messenger__checked"></div>
								<?php endif ?>
							</label>
							<span class="checkOptions__name">Работа на мероприятиях</span>
						</div>
					</div>
				</div>
				<div class="spacer spacer_mb20"></div>
				<div class="colsBox__line">
					<div class="colsBox__lbl">Обо мне</div>
					<?php if ($profile->about): ?>
						<p class="colsBox__val colsBox__val_fz14"><?= nl2br(Html::encode($profile->about)) ?></p>
					<?php else: ?>
						<p class="colsBox__val colsBox__val_fz14">Не указано.</p>
					<?php endif ?>
				</div>
				<div class="spacer spacer_mb20 spacer_pt10"></div>
				<div class="colsBox__line">
					<div class="colsBox__lbl">Видео</div>
					<?php if ($profile->video): ?>
						<a class="videoBox videoBox_h280" href="#">
							<iframe src="<?= $profile->video ?>" allowfullscreen="" width="100%" height="100%" frameborder="0"></iframe>
						</a>
					<?php else: ?>
						<p class="colsBox__val colsBox__val_fz14">Не добавлено.</p>
					<?php endif ?>
				</div>
				<div class="spacer spacer_mb20 spacer_pt10"></div>
				<div class="colsBox__line colsBox__line_mb0">

					<div class="colsBox__lbl">Фотографии кухни</div>
					<ul class="form__list">
<?php if ($fotokitchens): ?>
	<?php foreach ($fotokitchens as $key => $fk): ?>
		<li class="form__photos">
			<div class="form__photo">
				<a href="<?= $fk->source ?>"><img class="form__img" src="<?= $fk->getSource('icon') ?>" alt="" /></a>
			</div>
		</li>
	<?php endforeach ?>
<?php else: ?>
	<p class="colsBox__val colsBox__val_fz14">Не добавлены.</p>
<?php endif ?>

					</ul>

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
				<div class="colsBox__line">
					<div class="colsBox__lbl">Поделиться в соц сетях</div>
					<div class="socialBox">
						<a class="socialBox__icon socialBox__icon_mail" href="#">mail.ru</a>
						<a class="socialBox__icon socialBox__icon_mail" href="#">mail.ru</a>
						<a class="socialBox__icon socialBox__icon_mail" href="#">mail.ru</a>
						<a class="socialBox__icon socialBox__icon_mail" href="#">mail.ru</a>
						<a class="socialBox__icon socialBox__icon_mail" href="#">mail.ru</a>
					</div>
				</div>
			</div>
			<div class="colsBox__col colsBox__col_wCalc-810">
				<div class="toolsBox toolsBox_mb30">
					<div class="toolsBox__item">
						<div class="toolsBox__count toolsBox__count_orange">258</div>
						<div class="toolsBox__name">Выполненных заказов</div>
					</div>
					<div class="toolsBox__item">
						<a class="toolsBox__count" href="#">178</a>
						<a class="toolsBox__name" href="#">Отзывов</a>
					</div>
				</div>
			</div>
		</div>
	</div>





</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('/site/right', [
	]) ?>

</aside>