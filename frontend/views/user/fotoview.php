<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
use frontend\assets\MainAsset;

use yii\widgets\Pjax;

$this->params['breadcrumbs'][] = ['label' => 'Альбомы', 'url' => ['user/foto'], 'class' => 'breadcrumbs__link'];

$this->params['breadcrumbs'][] = ['label' => 'Альбом: ' . $album->header];

$this->title = 'Альбом: ' . $album->header;

$this->registerJsFile('/js/foto.js', ['depends' => [MainAsset::className()]]);

?>

<aside class="l-sidebar l-sidebar_left">

	<?= $this->render('leftcook', [
	]) ?>

</aside>
<div class="g-flexMiddleChild middleWrapper">

	<div class="menuTop">

		<?= $this->render('top-menu-cook', [
		]) ?>

		<div>
			<span class="g-link g-link_mr20" id="js_foto_showpopup">Добавить фото</span>
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
		<div class="headerBox">
			<h1 class="headerBox__title"><?= $album->header ?></h1>
		</div>
			<?php if (count($album->fotos)): ?>
				<form action="<?= Url::to(['user/fotoview', 'id' => $album->id]) ?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
					<div class="photo">
						<ul class="photo__list">
							<h2 class="photo__header"><?= $album->header ?></h2>
							<h3 class="photo__line"><?= $album->created_at ?></h3>

						</ul>
					</div>
					<?php foreach ($album->fotos as $key => $foto): ?>
						<li class="photo__item">
							<div class="photo__imgBox" href="#">
								<img class="photo__img" src="<?= $foto->getSource('list') ?>" alt="" />
								<?= ($foto->id === $album->foto_id)?'<div class="photo__favoriteMain">Главная фотография</div>':'' ?>
								<div class="photo__hiddenBox">
									<label class="photo__favorite">Сделать главной
										<input name="fotocover" type="submit" value="<?= $foto->id ?>" style="display: none">
									</label>
									<label class="photo__remove">Удалить
										<input name="fotodel" type="submit" value="<?= $foto->id ?>" style="display: none">
									</label>
								</div>
							</div>
							<p class="photo__text">
								<?= $foto->text ?>
							</p>
							<a href="<?= Url::to(['user/fotoupdate', 'album_id' => $album->id, 'foto_id' => $foto->id,]) ?>" class="g-link photo__but">Редактировать</a>
						</li>
					<?php endforeach ?>
				</form>
			<?php else: ?>
				<div class="antiReset">
					<p>Нет фотографий</p>
				</div>
			<?php endif ?>
	</div>



<div class="popup" id="js_foto_popup">
	<div class="popup__wrap">
		<?php Pjax::begin(); ?>
			<div class="popup__exit" id="js_foto_closeadd">Выход</div>
			<div class="popup__mainWrap">
				<img class="popup__img" src="" alt="" />
			</div>
			<form class="popup__form" action="<?= Url::to(['user/fotoview', 'id' => $album->id]) ?>" method="post" enctype="multipart/form-data" data-pjax>
				<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
				<label for="" class="popup__label">Описание фотографии:</label>
				<textarea name="FotoForm[text]" class="popup__textarea" id="" placeholder="Lorem ipsum."></textarea>
				<div class="popup__line popup__line_widthCenter">
					<div>
						<label class="g-button g-m_r15">Загрузить фотографию
							<input name="FotoForm[file]" type="file" style="display: none">
						</label>
					</div>
					<div>
						<label for="" class="popup__label popup__label_pb0">Перенести в альбом:</label>
						<!-- <div class="searchBox__wrapper">
							<input name="FotoForm[album_id]" type="hidden" value="<? //= $album->id ?>">
							<input type="text" class="g-input g-input_mr0 g-input_300px" placeholder="Название альбома" />
							<a class="searchBox__select searchBox__select_r10px" href="#">Выбрать</a>
						</div> -->
						<label class="select_default">
						<select name="FotoForm[album_id]">
							<?php foreach ($albums as $a): ?>
								<option value="<?= $a->id ?>" <?= ($a->id==$album->id)?' selected':'' ?>><?= $a->header ?></option>
							<?php endforeach ?>
						</select>
						</label>
					</div>
				</div>
				<div class="popup__border"></div>
				<div class="popup__line popup__line_center">
					<input name="FotoForm[fotoadd]" type="submit" class="g-button g-button_green g-m_r15" value="Сохранить">
					<input type="button" class="g-button g-button_orange" value="Отмена">
				</div>
			</form>
		<?php Pjax::end(); ?>
	</div>
</div>


</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('right', [
	]) ?>

</aside>