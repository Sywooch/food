<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

$this->title = Html::encode($publication->header);

$this->params['breadcrumbs'][] = ['label' => 'Блог', 'url' => ['user/blog'], 'class' => 'breadcrumbs__link'];
$this->params['breadcrumbs'][] = ['label' => Html::encode($publication->header)];

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
			<a href="<?= Url::to(['user/publication-update', 'id' => $publication->id]) ?>" class="g-link g-link_mr20">Редактировать публикацию</a>
			<a href="<?= Url::to(['user/publication-create']) ?>" class="g-link g-link_mr20">Добавить публикацию</a>
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
			<h1 class="headerBox__title">Блог кулинара</h1>
		</div>

		<div class="blog">
			<div class="blog__item section_810">
				<div class="blog__lineBox">
					<h3 class="blog__header"><?= $publication->header ?></h3>
					<div class="g-cooker__favorite"></div>
				</div>
				<h4 class="blog__line"><?= date('Y-m-d H:i:s', strtotime($publication->created_at)) ?></h4>
				<img class="blog__img" src="<?= $publication->getSource('full') ?>" alt="" />
				<p class="blog__text"><?= nl2br(Html::encode($publication->text)) ?></p>
				<div class="blog__border blog__border_mb20"></div>
				<div class="pb15">
					<section class="oddBox oddBox_pr30">
						<h3 class="oddBox__title">Поделиться в соц. сетях</h3>
						<div class="socialBox">
							<a href="#" class="socialBox__icon socialBox__icon_mail">mail.ru</a>
							<a href="#" class="socialBox__icon socialBox__icon_mail">mail.ru</a>
							<a href="#" class="socialBox__icon socialBox__icon_mail">mail.ru</a>
							<a href="#" class="socialBox__icon socialBox__icon_mail">mail.ru</a>
							<a href="#" class="socialBox__icon socialBox__icon_mail">mail.ru</a>
						</div>
					</section>
					<section class="oddBox">
						<h3 class="oddBox__title">Оценить</h3>
						<div class="g-cooker__favorite g-cooker__favorite_big"></div>
					</section>
				</div>
				<?php if ($publication->publicationtags): ?>
					<div class="form__subtitle form__subtitle_pb15">Теги</div>
					<div class="blog__tagsBox">
						<?php foreach ($publication->publicationtags as $key => $pt): ?>
							<div class="blog__tag blog__tag_edit">
								<div class="blog__tagText"><?= $pt->header ?></div>
							</div>
						<?php endforeach ?>
					</div>
				<?php endif ?>
			</div>
			<div class="form__section form__section_pt0px">
				<div class="form__subtitle form__subtitle_pb15">Похожие статьи</div>
				<ul class="blog">
					<?php for ($i=0; $i < 5 ; $i++) { ?>
					<li class="blog__item blog__item_preview">
						<div class="blog__lineBox ">
							<h3 class="blog__header">Запись в блоге</h3>
							<div class="g-cooker__favorite"></div>
						</div>
						<h4 class="blog__line">16.01.16</h4>
						<img class="blog__img blog__img_h160" src="../../images/pizza.png" alt="" />
						<p class="blog__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio quis, quasi fugit! Sapiente veniam, 
						temporibus incidunt nobis dolorem, quisquam mollitia voluptas et aut ipsum, unde totam sint nam</p>
					</li>
					<?php }	?>
				</ul>
			</div>
			<div class="form__section form__section_pt0px">
				<div class="form__line">
					<div class="form__subtitle form__subtitle_db form__subtitle_pb15">Комментарии</div>
					<input type="button" class="g-button" value="Написать" />
				</div>
				<div class="form__line">

					<div class="review">

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