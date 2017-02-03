<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

$this->title = 'Редактирование статьи';

$this->params['breadcrumbs'][] = ['label' => 'Блог', 'url' => ['user/blog'], 'class' => 'breadcrumbs__link'];
$this->params['breadcrumbs'][] = ['label' => Html::encode($publication->header), 'url' => ['user/publication-view', 'id' => $publication->id], 'class' => 'breadcrumbs__link'];
$this->params['breadcrumbs'][] = ['label' => 'Редактирование'];

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
			<h1 class="headerBox__title">Редактирование статьи</h1>
		</div>

		<div class="blog">
			<form action="<?= Url::to(['user/publication-update', 'id' => $publication->id]) ?>" method="post" enctype="multipart/form-data">
				<input name="_csrf" type="hidden" value="<?=Yii::$app->request->getCsrfToken()?>" />
				<div class="blog__item section_810">
					<div class="form__line form__line_centeredWidth">
						<label class="form__label form__label_wa">Название:</label>
						<input name="Publication[header]" class="g-input g-input_mr0 g-input_wflex" placeholder="Введите название ..." type="text" value="<?= $publication->header ?>">
						<?php if ($publication->errors && isset($publication->errors['header'])): ?>
							<div class="error">
								<?php foreach ($publication->errors['header'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					</div>
					<!-- <img class="blog__img" src="" /> -->
					<div class="blog__buttons">
						<label>Загрузить фото
							<input name="Publication[file]" type="file" class="g-button g-m_r15">
							<?php if ($publication->errors && isset($publication->errors['file'])): ?>
								<div class="error">
									<?php foreach ($publication->errors['file'] as $error): ?>
										<p><?= $error ?></p>
									<?php endforeach ?>
								</div>
							<?php endif ?>
						</label>
						<input name="Publication[video]" type="text" class="g-button" placeholder="Ссылка на видео" value="<?= $publication->video ?>">
						<?php if ($publication->errors && isset($publication->errors['video'])): ?>
							<div class="error">
								<?php foreach ($publication->errors['video'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					</div>
					<div class="blog__border blog__border_mb20"></div>
					<div class="blog__tagsBox" id="js_publicationtag_tagplace">

						<?php if ($publication->publicationtags): ?>
							<?php foreach ($publication->publicationtags as $key => $pt): ?>
								<div class="blog__tag blog__tag_edit js_publicationtag_tag">
									<input name="tagheader[]" type="hidden" val="<?= $pt->header ?>" />
									<div class="blog__tagText"><?= $pt->header ?></div><div class="blog__delete js_publicationtag_deletetag"></div>
								</div>
							<?php endforeach ?>
						<?php endif ?>

					</div>
					<div class="form__line form__line_centeredWidth">
						<label class="form__label form__label_wa">Введите теги:</label>
						<input id="js_publicationtag_inputheader" class="g-input g-input_mr0 g-input_wflex js-addTag" placeholder="Введите название ..." type="text" list="js_publicationtag_tagdatalist" />
						<datalist id="js_publicationtag_tagdatalist"></datalist>
						<div class="blog__add ml20 js-addTagPlus">Добавить тег</div>
					</div>
					<textarea name="Publication[text]" class="blog__textarea" placeholder="Введите текст"><?= $publication->text ?></textarea>
					<div class="blog__border"></div>
					<?php if ($publication->errors && isset($publication->errors['text'])): ?>
						<div class="error">
							<?php foreach ($publication->errors['text'] as $error): ?>
								<p><?= $error ?></p>
							<?php endforeach ?>
						</div>
					<?php endif ?>
				</div>
				<div class="blog__buttons">
					<input type="submit" name="submitform" class="g-button g-button_green g-m_r15" value="Сохранить">
				</div>
			</form>

			<div id="js_publicationtag_template" style="display: none;">
				<div class="blog__tag blog__tag_edit js_publicationtag_tag">
					<input name="tagheader[]" type="hidden" value="??header??" />
					<div class="blog__tagText">??header??</div><div class="blog__delete js_publicationtag_deletetag"></div>
				</div>
			</div>

		</div>



	</div>





</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('/site/right', [
	]) ?>

</aside>