<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

$this->params['breadcrumbs'][] = ['label' => 'Альбомы', 'url' => ['user/foto'], 'class' => 'breadcrumbs__link'];

$this->params['breadcrumbs'][] = ['label' => 'Добавление альбома'];

$this->title = 'Добавление альбома';

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
		<div class="headerBox">
			<h1 class="headerBox__title">Добавление альбома</h1>
		</div>
		<div class="antiReset">
			<form action="<?= Url::to(['user/fotoadd']) ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
				<div>
					Наименование<br>
					<input name="AlbumForm[header]" type="text" value="<?= $model->header ?>">
					<?php if (isset($model->errors)&&count($model->errors)): ?>
						<?php if (isset($model->errors['header'])): ?>
							<div class="antiReset">
								<?php foreach ($model->errors['header'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					<?php endif ?>
				</div>
				<div>
					Описание<br>
					<textarea name="AlbumForm[text]"><?= $model->text ?></textarea>
					<?php if (isset($model->errors)&&count($model->errors)): ?>
						<?php if (isset($model->errors['text'])): ?>
						<div class="antiReset">
							<?php foreach ($model->errors['text'] as $error): ?>
								<p><?= $error ?></p>
							<?php endforeach ?>
						</div>
						<?php endif ?>
					<?php endif ?>
				</div>
				<div>
					<label>Добавить фотографии к альбому
						<input name="AlbumForm[fotos][]" type="file" accept="image/jpeg,image/png" style="display:none" multiple>
					</label>
					<?php if (isset($model->errors)&&count($model->errors)): ?>
						<?php if (isset($model->errors['fotos'])): ?>
						<div class="antiReset">
							<?php foreach ($model->errors['fotos'] as $error): ?>
								<p><?= $error ?></p>
							<?php endforeach ?>
						</div>
						<?php endif ?>
					<?php endif ?>
				</div>
				<div>
					<input name="submit" type="submit" value="Добавить">
				</div>
			</form>
		</div>
	</div>

</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('/site/right', [
	]) ?>

</aside>