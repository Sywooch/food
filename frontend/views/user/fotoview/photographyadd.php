<?php
use yii\helpers\Url;
?>

<div class="popup__exit" id="js_foto_closeadd">Выход</div>
<div class="popup__mainWrap">
	<img class="popup__img" src="" alt="" />
</div>
<form class="popup__form" action="<?= Url::to(['user/fotoview', 'id' => $album->id]) ?>" method="post" enctype="multipart/form-data" data-pjax>
	<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
	<?php if (isset($fotoform->errors)&&count($fotoform->errors)): ?>
		<?php if (isset($fotoform->errors['model'])): ?>
			<div class="antiReset">
				<?php foreach ($fotoform->errors['model'] as $error): ?>
					<p><?= $error ?></p>
				<?php endforeach ?>
			</div>
		<?php endif ?>
	<?php endif ?>

	<label for="" class="popup__label">Описание фотографии:</label>
	<textarea name="FotoForm[text]" class="popup__textarea" id="" placeholder="Lorem ipsum."><?= $fotoform->text ?></textarea>
	<?php if (isset($fotoform->errors)&&count($fotoform->errors)): ?>
		<?php if (isset($fotoform->errors['text'])): ?>
			<div class="antiReset">
				<?php foreach ($fotoform->errors['text'] as $error): ?>
					<p><?= $error ?></p>
				<?php endforeach ?>
			</div>
		<?php endif ?>
	<?php endif ?>
	<div class="popup__line popup__line_widthCenter">
		<div>
			<label class="g-button g-m_r15">Загрузить фотографию
				<input name="FotoForm[file]" type="file">
			</label>
		</div>
		<?php if (isset($fotoform->errors)&&count($fotoform->errors)): ?>
			<?php if (isset($fotoform->errors['file'])): ?>
				<div class="antiReset">
					<?php foreach ($fotoform->errors['file'] as $error): ?>
						<p><?= $error ?></p>
					<?php endforeach ?>
				</div>
			<?php endif ?>
		<?php endif ?>
		<div>
			<label for="" class="popup__label popup__label_pb0">Перенести в альбом:</label>
			<div class="searchBox__wrapper">
				<input name="FotoForm[album_id]" type="hidden" value="<?= $album->id ?>">
				<input type="text" class="g-input g-input_mr0 g-input_300px" placeholder="Название альбома" />
				<a class="searchBox__select searchBox__select_r10px" href="#">Выбрать</a>
			</div>
		</div>
		<?php if (isset($fotoform->errors)&&count($fotoform->errors)): ?>
			<?php if (isset($fotoform->errors['album_id'])): ?>
				<div class="antiReset">
					<?php foreach ($fotoform->errors['album_id'] as $error): ?>
						<p><?= $error ?></p>
					<?php endforeach ?>
				</div>
			<?php endif ?>
		<?php endif ?>
	</div>
	<div class="popup__border"></div>
	<div class="popup__line popup__line_center">
		<input name="FotoForm[fotoadd]" type="submit" class="g-button g-button_green g-m_r15" value="Сохранить">
		<input type="button" class="g-button g-button_orange" value="Отмена">
	</div>
</form>
