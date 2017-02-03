<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

$this->params['breadcrumbs'][] = ['label' => 'Альбомы', 'url' => ['user/foto'], 'class' => 'breadcrumbs__link'];
$this->params['breadcrumbs'][] = ['label' => 'Альбом: ' . $album->header, 'url' => ['user/fotoview', 'id' => $album->id], 'class' => 'breadcrumbs__link'];
$this->params['breadcrumbs'][] = ['label' => 'Фото: ' . $foto->id];

$this->title = 'Фото: ' . $foto->id;

?>

<aside class="l-sidebar l-sidebar_left">

	<?= $this->render('leftcook', [
	]) ?>

</aside>
<div class="g-flexMiddleChild middleWrapper">

	<div class="menuTop">

		<?= $this->render('top-menu-cook', [
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
		<img src="<?= $foto->source ?>">
		<form class="popup__form" action="<?= Url::to(['user/fotoupdate', 'album_id' => $album->id, 'foto_id' => $foto->id]) ?>" method="post" enctype="multipart/form-data" data-pjax>
			<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
			<input type="hidden" name="FotoForm[id]" value="<?= $foto->id ?>" />
			<label for="" class="popup__label">Описание фотографии:</label>
			<textarea name="FotoForm[text]" class="popup__textarea" id="" placeholder="Lorem ipsum."><?= $foto->text ?></textarea>
			<div class="popup__line popup__line_widthCenter">
				<div>
					<label class="g-button" style="display: table-cell; vertical-align: middle;">Загрузить фотографию
						<input name="FotoForm[file]" type="file" style="display: none">
					</label>
				</div>
				<div>
					<label for="" class="popup__label popup__label_pb0">Перенести в альбом:</label>
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
	</div>





</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('right', [
	]) ?>

</aside>