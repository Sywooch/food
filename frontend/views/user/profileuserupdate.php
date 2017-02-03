<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

use frontend\assets\JcropAsset;
use frontend\assets\MainAsset;

JcropAsset::register($this);
$this->registerJsFile('/js/favoriteKitchen.js', ['depends' => [MainAsset::className()]]);

$this->params['breadcrumbs'][] = ['label' => 'Профиль', 'url' => ['user/profile'], 'class' => 'breadcrumbs__link'];

$this->params['breadcrumbs'][] = ['label' => 'Редактирование профиля'];

$this->title = 'Редактирование профиля';

?>

<aside class="l-sidebar l-sidebar_left">

	<?= $this->render('left'.$user->usertype, [
	]) ?>

</aside>
<div class="g-flexMiddleChild middleWrapper">

	<div class="menuTop">
	
		<?= $this->render('top-menu-user', [
		]) ?>

		<div>
			<?= Html::a('Сменить пароль', ['user/change-password'], ['class' => 'g-link g-link_mr20']) ?>
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






	<h4 class="form__header">Общая информация</h4>
	<form class="form" action="/profile/update/" method="post" enctype="multipart/form-data">
		<input name="_csrf" type="hidden" value="<?=Yii::$app->request->getCsrfToken()?>" />
		<input name="ProfileUserForm[loadEmpty]" type="hidden" value="1">
		<div class="form__section">
			<div class="form__colWrapper">
				<div class="form__leftCol form__leftCol_w65">
					<div class="form__line">
						<label for="" class="form__label">ФИО:</label>
						<span class="form__val section_500"><?= $user->username ?></span>
					</div>

					<?= $this->render('profileuserupdate/phonenumber', [
						'phonenumbers' => $phonenumbers,
						'newphonenumbers' => $newphonenumbers,
						'profileUserForm' => $profileUserForm,
					]) ?>

					<div class="form__line">
						<label for="" class="form__label">Связаться с/до:</label>
						<input name="ProfileUser[callfrom]" type="text" class="form__val section_500 form__val_two" placeholder="9:00" value="<?= $profile->callfrom ?>">
						<div class="minus"></div>
						<input name="ProfileUser[callto]" type="text" class="form__val section_500 form__val_two" placeholder="18:00" value="<?= $profile->callto ?>">
					</div>
					<?php if ($profile->errors): ?>
						<?php if (isset($profile->errors['callfrom'])): ?>
							<div class="error">
								<?php foreach ($profile->errors['callfrom'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					<?php endif ?>
					<?php if ($profile->errors): ?>
						<?php if (isset($profile->errors['callto'])): ?>
							<div class="error">
								<?php foreach ($profile->errors['callto'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					<?php endif ?>
					<div class="form__line">
						<label for="" class="form__label">E-mail:</label>
						<input name="User[email]" type="text" class="form__val section_500" placeholder="123@yandex.ru" value="<?= $user->email ?>" />
					</div>
					<?php if ($user->errors): ?>
						<?php if (isset($user->errors['email'])): ?>
							<div class="error">
								<?php foreach ($user->errors['email'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					<?php endif ?>
					<div class="form__line form__line_mb0">
						<label for="" class="form__label">О себе:</label>
						<textarea name="ProfileUser[about]" class="form__val section_500 form__val_big" placeholder="..."><?= $profile->about ?></textarea>
					</div>
					<?php if ($user->errors): ?>
						<?php if (isset($user->errors['email'])): ?>
							<div class="antiReset">
								<?php foreach ($user->errors['email'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					<?php endif ?>
				</div>
				<div class="form__rightCol form__rightCol_w35">
					<div class="form__photo form__photo_w250 form__photo_h300 form__photo_mb15" href="#">
						<?php if ($user->profile->iconsrc): ?>
							<img id="js_profilefoto_profilefoto" class="form_mainPhoto" src="<?= $user->profile->getIconsrc('full') ?>" alt="" />
						<?php else: ?>
							<img id="js_profilefoto_profilefoto" class="form_mainPhoto" src="/images/no-icon-250.png" alt="" />
						<?php endif; ?>
					</div>
					<span class="g-button" id="js_profilefoto_popupshow">Редактировать фотографию</span>
					<!-- <label for="fileinput" class="g-button">Редактировать фотографию
						<input name="ProfileUser[icon]" id="fileinput" type="file" style="display:none">
					</label> -->
					<!-- <div class="antiReset" id="filediv" style="display:none">
						<p>Выделите область на фотографии если необходимо</p>
						<img src="" id="fileimg">
						<input name="filesize" type="hidden" id="filesize">
						<input name="filetype" type="hidden" id="filetype">

						<input name="iw" type="hidden" id="iw">
						<input name="ih" type="hidden" id="ih">
						<input name="pw" type="hidden" id="pw">
						<input name="ph" type="hidden" id="ph">

						<input name="aw" type="hidden" id="aw">
						<input name="ah" type="hidden" id="ah">
						<input name="x1" type="hidden" id="x1">
						<input name="y1" type="hidden" id="y1">
						<input name="x2" type="hidden" id="x2">
						<input name="y2" type="hidden" id="y2">
					</div> -->
					<?php if (isset($profileUserForm->errors)&&count($profileUserForm->errors)): ?>
						<?php if (isset($profileUserForm->errors['iconfile'])): ?>
						<div class="antiReset">
							<?php foreach ($profileUserForm->errors['iconfile'] as $error): ?>
								<p><?= $error ?></p>
							<?php endforeach ?>
						</div>
						<?php endif ?>
					<?php endif ?>
				</div>
			</div>
			<div class="form__line form__line_centeredContent form__center">
				<label for="" class="form__label form__label_tal form__label_w100 form__label_mb15">Адреса:</label>
			</div>



			<?= $this->render('profileuserupdate/address', [
				'addresses' => $addresses,
				'newaddresses' => $newaddresses,
				'metrostations' => $metrostations,
				'profileUserForm' => $profileUserForm,
			]) ?>




		</div>
		<div class="form__border"></div>
		<h4 class="form__header">Кухня</h4>
		<div class="form__section">
			<div class="form__line">
				<label for="" class="form__label form__label_w260">Избранные кухни:</label>
				<div class="tagList section_810" id="js_favoriteKitchen_place">
					<?php if ($userkitchens): ?>
						<?php foreach ($userkitchens as $key => $uk): ?>
							<div class="tagBox js_kitchentag">
								<input name="ProfileUserForm[leftkitchen][]" type="hidden" value="<?= $uk->id ?>">
								<span class="tagBox__name"><?= $uk->header ?></span>
								<span class="js-remove js_del_parent" data-value="js_kitchentag"></span>
							</div>
						<?php endforeach ?>
					<?php else: ?>
						<div class="antiReset js_favoriteKitchen_none">
							Нет избранных кухонь
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="form__line form__line_centeredContent form__center">
				<label for="" class="form__label form__label_tal form__label_w100 form__label_mb15">Добавить:</label>
				<div class="searchBox__wrapper">
					<input type="text" id="js_favoriteKitchen_add" placeholder="Кухня ..." class="g-input g-input_mr0 g-input_300px" list="kitchens" />
					<datalist id="kitchens">
						<?php foreach ($kitchens as $key => $k): ?>
							<option><?= $k->header ?></option>
						<?php endforeach ?>
					</datalist>
					<div class="g-link" id="js_favoriteKitchen_addtolist">Добавить к списку кухонь</div>
				</div>
			</div>
		</div>
		<div class="form__border"></div>
		<div class="form__section">
			<div class="form__line form__line_centeredContent form__center">
<input type="submit" name="submit" class="g-button g-button_green g-m_r15" value="Сохранить">
<input type="reset" name="reset" class="g-button g-button_orange" value="Отмена">
			</div>
		</div>
	</form>

<div id="js_favoriteKitchen_instance" style="display: none;">
	<div class="tagBox js_kitchentag">
		<input name="ProfileUserForm[newkitchen][]" type="hidden" value="??val??">
		<span class="tagBox__name">??val??</span>
		<span class="js-remove js_del_parent" data-value="js_kitchentag"></span>
	</div>
</div>

<div id="js_favoriteKitchen_instance_none" style="display: none;">
	<div class="antiReset js_favoriteKitchen_none">
		Нет избранных кухонь
	</div>
</div>




<div id="js_address_example" style="display: none;">
		<div class="js_address js_newaddress" data-key="??key??">
			<div class="form__line form__line_centeredContent">
				<label for="" class="form__label form__label_w260">Адрес:</label>
				<input name="Newaddress[??key??][address]" type="text" class="form__val section_810 form__val_ph" placeholder="г. Москва, ул. Автозаводская д. 13" value="">
				<div class="form_del js_del_parent" data-value="js_address"></div>
			</div>
			<div class="form__line form__line_centeredContent g-m_b25">
				<label for="" class="form__label form__label_w260">Добавить метро:</label>
				<input name="Newaddress[??key??][metro_id]" type="text" class="g-input g-input_search section_810" placeholder="Поиск ..." value="" list="datametrostationnew??key??">
				<datalist id="datametrostationnew??key??">
					<?php foreach ($metrostations as $m): ?>
						<option><?= $m->header ?></option>
					<?php endforeach ?>
				</datalist>
			</div>
			<div class="form__line section_810 form__center form__line_centeredContent">
				<input name="Newaddress[??key??][description]" type="text" class="form__val form__val_italic form__val_wide" placeholder="Комментарий (дом/работа)" value="">
			</div>
		</div>
</div>




<div id="js_phonenumber_example" style="display: none">
	<div class="js_phonenumber_exist js_phonenumber_existnew" data-key="??key??">
		<div class="form__line">
			<label for="" class="form__label">Телефон:</label>
				<input name="Newphonenumber[??key??][phonenumber]" type="text" id="input_phonenumber" class="form__val section_250" placeholder="7 495 000 00 00" value="" />

			<div class="messenger messenger_wc">
				<div class="messenger__item">
					<label class="messenger__wrap messenger__wrap_mr7">
						<input name="Newphonenumber[??key??][whatsapp]" type="hidden" value="0" />
						<input name="Newphonenumber[??key??][whatsapp]" type="checkbox" id="input_whatsapp" class="messenger__check js-messenger__check_whatsUp" value="1" />
						<div class="messenger__bg"></div>
					</label>
					<div class="messenger__whatsUp"></div>
				</div>
				<div class="messenger__item">
					<label class="messenger__wrap messenger__wrap_mr7">
						<input name="Newphonenumber[??key??][viber]" type="hidden" value="0" />
						<input name="Newphonenumber[??key??][viber]" type="checkbox" id="input_viber" class="messenger__check js-messenger__check_viber" value="1" />
						<div class="messenger__bg"></div>
					</label>
					<div class="messenger__viber"></div>
				</div>
				<div class="js_phonenumber_delete"></div>
			</div>

		</div>
		<div class="js-contentBox">
			<div class="js-hiddenBox js-hiddenBox_whatsUp form__line">
				<label for="" class="form__label">Телефон what's up:</label>
					<input name="Newphonenumber[??key??][whatsappnumber]" id="input_whatsappnumber" type="text" class="form__val section_500" placeholder="7 000 000 00 00" value="" />
			</div>
			<div class="js-hiddenBox js-hiddenBox_viber form__line">
				<label for="" class="form__label">Телефон viber:</label>
					<input name="Newphonenumber[??key??][vibernumber]" type="text" id="input_vibernumber" class="form__val section_500" placeholder="7 000 000 00 00" value="" />
			</div>
		</div>
	</div>
</div>



<div class="popup" id="js_profilefoto_popup">
	<?= $this->render('profile-icon-update', [
		'user' => $user,
	]) ?>
</div>



</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('/site/right', [
	]) ?>

</aside>