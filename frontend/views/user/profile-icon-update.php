<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;

use frontend\assets\JcropAsset;
use frontend\assets\MainAsset;


?>

	<div class="popup__wrap">
		<div class="popup__exit" id="js_profilefoto_exit">Выход</div>
		<form class="popup__form" action="<?= Url::to(['user/profile-icon-update']) ?>" method="post" enctype="multipart/form-data" id="js_profilefoto_form">
			<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
				<div class="popup__mainWrap">
					<?php if ($user->iconsrc): ?>
						<img id="js_profilefoto_img" class="popup__img" src="<?= $user->getIconsrc('full') ?>?hash=<?= rand() ?>" alt="" />
					<?php else: ?>
						<img id="js_profilefoto_img" class="popup__img" src="/images/no-icon-250.png" alt="" />
					<?php endif ?>
				</div> 
			<div class="antiReset" id="filediv" style="display:none">
				<p>Выделите область на фотографии если необходимо</p>
				<!-- <img src="" id="fileimg"> -->
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
			</div>
			<div class="popup__border"></div>
			<div class="popup__line popup__line_widthCenter">
				<div>
					<label class="g-button g-m_r15">Загрузить фотографию
						<input name="<?= StringHelper::basename(get_class($user->profile)) ?>[icon]" id="js_profilefoto_file" type="file" style="visibility: hidden; position: absolute;">
					</label>
					<input name="del_icon" class="g-button" type="submit" value="Удалить фотографию" />
				</div>
				<div>
					<input name="submitform" type="submit" class="g-button g-button_green g-m_r15" value="Сохранить">
					<!-- <input type="button" class="g-button g-button_orange" value="Отмена" id="js_profilefoto_cancel"> -->
				</div>
			</div>
		</form>
	</div>
