<?php
use yii\helpers\Html;
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

		<?= $this->render('leftcook', [
		]) ?>

</aside>
<div class="g-flexMiddleChild middleWrapper">

	<div class="menuTop">

		<?= $this->render('top-menu-cook', [
			'user' => $user,
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
							<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
							<input name="ProfileCookForm[loadEmpty]" type="hidden" value="1">
							<div class="form__section">
								<div class="form__colWrapper">
									<div class="form__leftCol form__leftCol_w65">
										<div class="form__line">
											<label for="" class="form__label">ФИО:</label>
											<span class="form__val section_500"><?= $user->username ?></span>
										</div>

										<?= $this->render('profilecookupdate/phonenumber', [
											'phonenumber' => $phonenumber,
											'newphonenumber' => $newphonenumber,
										]) ?>

										<div class="form__line js-before">
											<label for="" class="form__label">E-mail:</label>
											<input name="User[email]" type="text" class="form__val section_500" placeholder="123@yandex.ru" value="<?= $user->email ?>" />
										</div>
										<?php if (isset($user->errors)&&count($user->errors)): ?>
											<?php if (isset($user->errors['email'])): ?>
												<div class="error">
													<?php foreach ($user->errors['email'] as $error): ?>
														<p><?= $error ?></p>
													<?php endforeach ?>
												</div>
											<?php endif ?>
										<?php endif ?>
										<div class="form__line">
											<label for="" class="form__label">Связаться с/до:</label>
											<input name="ProfileCook[callfrom]" type="text" class="form__val section_500 form__val_two" placeholder="9:00" value="<?= $profile->callfrom ?>" />
											<div class="minus"></div>
											<input name="ProfileCook[callto]" type="text" class="form__val section_500 form__val_two" placeholder="18:00" value="<?= $profile->callto ?>" />
										</div>
										<?php if (isset($profile->errors)&&count($profile->errors)): ?>
											<?php if (isset($profile->errors['callfrom'])): ?>
												<div class="error">
													<?php foreach ($profile->errors['callfrom'] as $error): ?>
														<p><?= $error ?></p>
													<?php endforeach ?>
												</div>
											<?php endif ?>
										<?php endif ?>
										<?php if (isset($profile->errors)&&count($profile->errors)): ?>
											<?php if (isset($profile->errors['callto'])): ?>
												<div class="error">
													<?php foreach ($profile->errors['callto'] as $error): ?>
														<p><?= $error ?></p>
													<?php endforeach ?>
												</div>
											<?php endif ?>
										<?php endif ?>
										<div class="form__line form__line_mb0">
											<label for="" class="form__label">О себе:</label>
											<textarea name="ProfileCook[about]" class="form__val section_500 form__val_big" placeholder="..."><?= $profile->about ?></textarea>
										</div>
										<?php if (isset($profile->errors)&&count($profile->errors)): ?>
											<?php if (isset($profile->errors['about'])): ?>
												<div class="error">
													<?php foreach ($profile->errors['about'] as $error): ?>
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
											<input name="ProfileCook[icon]" id="fileinput" type="file" style="display:none">
										</label> -->
										<!-- <div class="error" id="filediv" style="display:none">
											<p>Выделите область на фотографии если необходимо</p>
											<img src="" id="fileimg">
												<input type="hidden" id="filesize" name="filesize">
												<input type="hidden" id="filetype" name="filetype">

												<input type="hidden" id="iw" name="iw">
												<input type="hidden" id="ih" name="ih">
												<input type="hidden" id="pw" name="pw">
												<input type="hidden" id="ph" name="ph">

												<input type="hidden" id="aw" name="aw">
												<input type="hidden" id="ah" name="ah">
												<input type="hidden" id="x1" name="x1">
												<input type="hidden" id="y1" name="y1">
												<input type="hidden" id="x2" name="x2">
												<input type="hidden" id="y2" name="y2">
										</div> -->
										<?php if (isset($model->errors)&&count($model->errors)): ?>
											<?php if (isset($model->errors['iconfile'])): ?>
												<div class="error">
													<?php foreach ($model->errors['iconfile'] as $error): ?>
														<p><?= $error ?></p>
													<?php endforeach ?>
												</div>
											<?php endif ?>
										<?php endif ?>

									</div>
								</div>
								<div class="form__line form__line_centeredContent">
									<label for="" class="form__label form__label_w260">Адрес:</label>
									<input name="Address[address]" type="text" class="form__val section_810 form__val_ph" placeholder="г. Москва, ул. Автозаводская д. 13" value="<?= $address?$address->address:'' ?>" id="js_profilecookmap_inputaddress" autocomplete="off" />
									<input name="Address[latitude]" type="hidden" value="<?= $address->latitude ?>" placeholder="широта" id="js_profilecookmap_inputlatitude" />
									<input name="Address[longitude]" type="hidden" value="<?= $address->longitude ?>" placeholder="долгота" id="js_profilecookmap_inputlongitude" />
								</div>
								<?php if (isset($address->errors)&&count($address->errors)): ?>
									<?php if (isset($address->errors['address'])): ?>
										<div class="error">
											<?php foreach ($address->errors['address'] as $error): ?>
												<p><?= $error ?></p>
											<?php endforeach ?>
										</div>
									<?php endif ?>
								<?php endif ?>

<div id="map_canvas" style="height: 420px; width: 840px"></div>
<?php $this->registerJsFile('https://api-maps.yandex.ru/2.1/?lang=ru_RU', ['depends' => [frontend\assets\MainAsset::className()]]); ?>
<?php $this->registerJsFile('/js/profilecookmap.js', ['depends' => [frontend\assets\MainAsset::className()]]); ?>



								<div class="form__line form__line_centeredContent g-m_b25">
									<label for="" class="form__label form__label_w260">Метро:</label>
									<input name="Address[metro_id]" type="text" class="form__val section_810" placeholder="Авиамоторная" value="<?= ($address&&$address->metro_id)?$address->metrostation->header:'' ?>" list="datametrostation" />
									<datalist id="datametrostation">
										<?php foreach ($metrostations as $m): ?>
											<option><?= $m->header ?></option>
										<?php endforeach ?>
									</datalist>
									<?php if (isset($address->errors)&&count($address->errors)): ?>
										<?php if (isset($address->errors['metro_id'])): ?>
											<div class="error">
												<?php foreach ($address->errors['metro_id'] as $error): ?>
													<p><?= $error ?></p>
												<?php endforeach ?>
											</div>
										<?php endif ?>
									<?php endif ?>
								</div>
								<div class="form__line section_810 form__center form__line_centeredContent">
									<input name="Address[description]" type="text" class="form__val form__val_italic form__val_wide" placeholder="Комментарий (дом/работа)" value="<?= $address->description ?>" />
								</div>
								<?php if (isset($address->errors)&&count($address->errors)): ?>
									<?php if (isset($address->errors['description'])): ?>
										<div class="error">
											<?php foreach ($address->errors['description'] as $error): ?>
												<p><?= $error ?></p>
											<?php endforeach ?>
										</div>
									<?php endif ?>
								<?php endif ?>

							</div>
							<div class="form__border"></div>
							<h4 class="form__header">Параметры заказа, доставки</h4>
							<div class="form__section">
								<div class="g-space_between_top form__line form__center section_810">
									<div>
										<label for="" class="form__label form__label_min">Минимальная сумма заказа:</label>
										<input name="ProfileCook[costmin]" class="g-input g-input_300px g-m_b25" type="text" placeholder="100 Руб." value="<?= $profile->costmin ?>">
									<?php if (isset($profile->errors)&&count($profile->errors)): ?>
										<?php if (isset($profile->errors['costmin'])): ?>
											<div class="error">
												<?php foreach ($profile->errors['costmin'] as $error): ?>
													<p><?= $error ?></p>
												<?php endforeach ?>
											</div>
										<?php endif ?>
									<?php endif ?>
										<label for="" class="form__label form__label_min">Бесплатная доставка от:</label>
										<input name="ProfileCook[costfree]" class="g-input g-input_300px g-m_b25" type="text" placeholder="100 Руб." value="<?= $profile->costfree ?>">
									<?php if (isset($profile->errors)&&count($profile->errors)): ?>
										<?php if (isset($profile->errors['costfree'])): ?>
											<div class="error">
												<?php foreach ($profile->errors['costfree'] as $error): ?>
													<p><?= $error ?></p>
												<?php endforeach ?>
											</div>
										<?php endif ?>
									<?php endif ?>
										<label for="" class="form__label form__label_min">Стоимость доставки:</label>
										<input name="ProfileCook[costdelivery]" class="g-input g-input_300px g-m_b25" type="text" placeholder="100 Руб." value="<?= $profile->costdelivery ?>">
										<?php if (isset($profile->errors)&&count($profile->errors)): ?>
											<?php if (isset($profile->errors['costdelivery'])): ?>
												<div class="error">
													<?php foreach ($profile->errors['costdelivery'] as $error): ?>
														<p><?= $error ?></p>
													<?php endforeach ?>
												</div>
											<?php endif ?>
										<?php endif ?>
									</div>
									<div class="checkOptions">
										<div class="checkOptions__wrap">
											<label class="messenger__wrap messenger__wrap_mr7">
												<input name="ProfileCook[pickup]" type="hidden" value="0" />
												<input name="ProfileCook[pickup]" type="checkbox" class="messenger__check" value="1"<?= $profile->pickup?' checked':'' ?> />
												<div class="messenger__bg"></div>
											</label>
											<div class="checkOptions__name">Самовывоз</div>
										</div>
										<?php if (isset($profile->errors)&&count($profile->errors)): ?>
											<?php if (isset($profile->errors['pickup'])): ?>
												<div class="error">
													<?php foreach ($profile->errors['pickup'] as $error): ?>
														<p><?= $error ?></p>
													<?php endforeach ?>
												</div>
											<?php endif ?>
										<?php endif ?>
										<div class="checkOptions__wrap">
											<label class="messenger__wrap messenger__wrap_mr7">
												<input name="ProfileCook[workhome]" type="hidden" value="0" />
												<input name="ProfileCook[workhome]" type="checkbox" class="messenger__check" value="1"<?= $profile->workhome?' checked':'' ?> />
												<div class="messenger__bg"></div>
											</label>
											<div class="checkOptions__name">Выезд на дом</div>
										</div>
										<?php if (isset($profile->errors)&&count($profile->errors)): ?>
											<?php if (isset($profile->errors['workhome'])): ?>
												<div class="error">
													<?php foreach ($profile->errors['workhome'] as $error): ?>
														<p><?= $error ?></p>
													<?php endforeach ?>
												</div>
											<?php endif ?>
										<?php endif ?>
										<div class="checkOptions__wrap">
											<label class="messenger__wrap messenger__wrap_mr7">
												<input name="ProfileCook[workevent]" type="hidden" value="0" />
												<input name="ProfileCook[workevent]" type="checkbox" class="messenger__check" value="1"<?= $profile->workevent?' checked':'' ?> />
												<div class="messenger__bg"></div>
											</label>
											<span class="checkOptions__name">Работа на мероприятиях</span>
										</div>
										<?php if (isset($profile->errors)&&count($profile->errors)): ?>
											<?php if (isset($profile->errors['workevent'])): ?>
												<div class="error">
													<?php foreach ($profile->errors['workevent'] as $error): ?>
														<p><?= $error ?></p>
													<?php endforeach ?>
												</div>
											<?php endif ?>
										<?php endif ?>
									</div>
								</div>
								<div class="form__line form__line_centeredContent">
									<label for="" class="form__label form__label_w260">Район доставки:</label>
									<input name="ProfileCook[region]" type="hidden" id="js_profilecookmap_inputregion" class="form__val section_810 form__val_ph" value="<?= $profile->region ?>" />
									<div id="map_region" style="height: 420px; width: 840px"></div>
								</div>
							</div>
							<div class="form__border"></div>
							<h4 class="form__header">Кухня</h4>
							<div class="form__section">
								<div class="form__line">
									<!-- <label for="" class="form__label">Фото кухни:</label> -->
									<div class="section_dib section_810">

<?php if ($fotokitchen): ?>
	<ul class="form__list">
		<?php foreach ($fotokitchen as $key => $fk): ?>
			<li class="form__photos js_fotokitchen_item">
				<div class="form__photo">
					<img class="form__img" src="<?= $fk->getSource('icon') ?>" alt="" />
					<input name="ProfileCookForm[leftfotokitchen][]" type="hidden" value="<?= $fk->id ?>">
					<div class="form__hiddenBox form__hiddenBox_tar">
						<div class="form__remove form__remove_mt5 js_fotokitchen_del">Удалить</div>
					</div>
				</div>
			</li>
		<?php endforeach ?>
	</ul>
<?php endif; ?>

									</div>
									<div class="form__line form__line_centeredContent form__center">
										<label class="g-link">Добавить фотографии кухни
											<input name="ProfileCookForm[fotokitchen][]" type="file" accept="image/jpeg,image/png" style="display:none" multiple>
										</label>
									</div>
									<?php if ($newfotokitchen): ?>
										<?php foreach ($newfotokitchen as $key => $fk): ?>
											<?php if ($fk->errors): ?>
												<div class="error">
													<?php foreach ($fk->errors as $key => $errors): ?>
														<?php foreach ($errors as $key => $errorText): ?>
															<p><?= $errorText ?></p>
														<?php endforeach ?>
													<?php endforeach ?>
												</div>
											<?php endif ?>
										<?php endforeach ?>
									<?php endif ?>
								</div>
							</div>
							<div class="form__border"></div>
							<h4 class="form__header">Видеопрезентация</h4>
							<div class="form__section">
								<div class="form__line section_810">
									<div class="form__line">
										<label for="" class="form__label form__label_w260">Ссылка на видео:</label>
										<input name="ProfileCook[video]" type="text" class="form__val section_500" placeholder="https://www.youtube.com/embed/Kr9-BKK7CKY" value="<?= $profile->video ?>" />
									</div>
									<?php if ($profile->errors): ?>
										<?php if (isset($profile->errors['video'])): ?>
											<div class="error">
												<?php foreach ($user->errors['video'] as $error): ?>
													<p><?= $error ?></p>
												<?php endforeach ?>
											</div>
										<?php endif ?>
									<?php endif ?>
									<?php if ($profile->video): ?>
										<label for="" class="form__label form__label_w260"></label>
										<div class="form__video form__video_wcalc260 section_dib section_810">
											<a href="#" class="form__video">
												<iframe width="100%" height="100%" src="<?= $profile->video ?>" frameborder="0" allowfullscreen></iframe>
											</a>
										</div>
									<?php endif ?>
								</div>
							</div>
							<div class="form__border"></div>
							<h4 class="form__header">Сертификаты</h4>
							<div class="form__section">
								<div class="form__line">
									<!-- <label for="" class="form__label">:</label> -->
									<div class="section_dib section_810">


<?php if (count($fotodoc)): ?>
	<ul class="form__list">
		<?php foreach ($fotodoc as $key => $fd): ?>
			<li class="form__photos js_fotodoc_item">
				<div class="form__photo">
					<img class="form__img" src="<?= $fd->getSource('icon') ?>" alt="" />
					<input name="ProfileCookForm[leftfotodoc][]" type="hidden" value="<?= $fd->id ?>">
					<div class="form__hiddenBox form__hiddenBox_tar">
						<div class="form__remove form__remove_mt5 js_fotodoc_del">Удалить</div>
					</div>
				</div>
			</li>
		<?php endforeach ?>
	</ul>
<?php endif ?>


									</div>
									<div class="form__line form__line_centeredContent form__center">
										<label class="g-link">Добавить сканы сертификатов
											<input name="ProfileCookForm[fotodoc][]" type="file" accept="image/jpeg,image/png" style="display:none" multiple>
										</label>
									</div>
									<?php if ($newfotodoc): ?>
										<?php foreach ($newfotodoc as $key => $fd): ?>
											<?php if ($fd->errors): ?>
												<div class="error">
													<?php foreach ($fd->errors as $key => $errors): ?>
														<?php foreach ($errors as $key => $errorText): ?>
															<p><?= $errorText ?></p>
														<?php endforeach ?>
													<?php endforeach ?>
												</div>
											<?php endif ?>
										<?php endforeach ?>
									<?php endif ?>
								</div>
							</div>
							<div class="form__border"></div>
							<div class="form__section">
								<div class="form__line form__line_centeredContent form__center">
									<input type="submit" class="g-button g-button_green g-m_r15" name="submit" value="Сохранить">
									<input type="button" class="g-button g-button_orange" value="Отмена">
								</div>
							</div>
						</form>









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