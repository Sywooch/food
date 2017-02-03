<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

$this->params['breadcrumbs'][] = ['label' => 'Профиль'];

$this->title = 'Профиль';

?>

<aside class="l-sidebar l-sidebar_left">

		<?= $this->render('profileuser/left', [
		]) ?>

</aside>
<div class="g-flexMiddleChild middleWrapper">

	<?= $this->render('top'.$user->usertype, [
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






						<div class="middleWrapper__container">


							<div class="colsBox">
								<div class="colsBox__col colsBox__col_w280">
									<div class="form__photo form__photo_w250 form__photo_h300 form__photo_mb15 form__photo_mid" href="#">
										<img class="form_mainPhoto" src="<?= $user->getIconsrc('full') ?>" alt="" />
									</div>
								</div>
								<div class="colsBox__col colsBox__col_w530">
									<div class="titleBox">
										<h1 class="titleBox__title"><?= $user->username ?></h1>
									</div>
<?php if ($addresses): ?>
	<div class="colsBox__line">
		<?php foreach ($addresses as $key => $a): ?>
			<div class="colsBox__lbl">Адрес</div>
			<div class="colsBox__val colsBox__val_pb5"><?= $a->address ?></div>
			<?php if ($a->metro_id): ?>
				<div class="metroBox">
					<div class="metroIcon metroIcon_green"></div>
					<div class="metroBox__name"><?= $a->metrostation->header ?></div>
				</div>
			<?php endif ?>
		<?php endforeach ?>
	</div>
<?php endif ?>


<?php if ($phonenumbers): ?>
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
<?php endif ?>
									<div class="colsBox__line">
										<div class="colsBox__lbl">Удобное время для связи</div>
										<div class="colsBox__val"><?= $profile->callfrom ?> - <?= $profile->callto ?></div>
									</div>
									<div class="colsBox__line colsBox__line_mb0">
										<div class="colsBox__lbl">Почта</div>
										<div class="colsBox__val"><?= $user->email ?></div>
									</div>
									<div class="spacer spacer_mb20 spacer_pt20"></div>
									<div class="colsBox__lbl">Избранные кухни</div>

<?php if ($kitchens): ?>
	<div class="colsBox__line colsBox__line_mb0">
	<div class="colsBox__lbl colsBox__lbl_mb10">Кухня</div>
		<?php foreach ($kitchens as $key => $k): ?>
			<div class="tagBox"><span class="tagBox__name"><?= $k->header ?></span></div>
		<?php endforeach ?>
	</div>
<?php else: ?>
			<p class="colsBox__val colsBox__val_fz14">Нет избранных кухонь.</p>
<?php endif ?>
									<div class="spacer spacer_mb20"></div>
									<div class="colsBox__line">
										<div class="colsBox__lbl">Обо мне</div>
										<?php if ($profile->about): ?>
											<p class="colsBox__val colsBox__val_fz14"><?= nl2br(Html::encode($profile->about)) ?></p>
										<?php else: ?>
											<p class="colsBox__val colsBox__val_fz14">Не заполнено.</p>
										<?php endif ?>
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
								</div>
							</div>
						</div>














<!-- 	<div class="antiReset">

		<p>Имя пользователя <?//= $user->username ?></p>
		<p>Аватар</p>
		<p><img src="<?//= $user->profile->iconsrc?$user->profile->getIconsrc():'/images/avatar.png' ?>"></p>
		<p>Телефоны:</p>
		<?//php foreach ($user->phonenumber as $key => $phonenumber): ?>
			<p>Телефон <?//= $phonenumber->phonenumber ?></p>
			<p>Whatsapp: <?//= $phonenumber->whatsapp ?></p>
			<p>WhatsappNumber: <?//= $phonenumber->whatsappnumber ?></p>
			<p>Viber: <?//= $phonenumber->viber ?></p>
			<p>ViberNumber: <?//= $phonenumber->vibernumber ?></p>
			<p>Show: <?//= $phonenumber->show ?></p>
			<p>Checked: <?//= $phonenumber->checked ?></p>
			<hr>
		<?//php endforeach ?>
		<p>Почта: <?//= $user->email ?></p>
		<p>Адреса:</p>
		<?//php foreach ($user->address as $address): ?>
			<p><?//= $address->address ?></p>
			<p><?//= $address->metro_id?$address->metrostation->header:null ?></p>
			<p><?//= $address->description ?></p>
		<?//php endforeach ?>
		<hr>
		<p>Кухни</p>
		<?//php foreach ($user->kitchen as $key => $kitchen): ?>
			<p><?//= $kitchen->header ?></p>
		<?//php endforeach ?>

	</div> -->

</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('right', [
	]) ?>

</aside>