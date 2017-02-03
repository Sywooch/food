<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

$this->params['breadcrumbs'][] = ['label' => 'Блог'];

$this->title = 'Блог';

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
			<h1 class="headerBox__title">Блог</h1>
		</div>

		<div class="sort">
			<h3 class="sort__title">Сортировка:</h3>
			<a href="#" class="sort__item sort__item_bottom">По новизне</a>
		</div>

		<?php if ($publications): ?>
			<ul class="blog">
				<?php foreach ($publications as $key => $p): ?>
					<li class="blog__item section_810">
						<div class="blog__lineBox ">
							<h3 class="blog__header"><?= Html::encode($p->header) ?></h3>
							<div class="g-cooker__favorite"></div>
						</div>
						<h4 class="blog__line"><?= date('Y-m-d', strtotime($p->created_at)) ?></h4>
						<img class="blog__img" src="<?= $p->getSource('full') ?>" alt="" />
						<?php if ($p->publicationtags): ?>
							<div class="blog__tagsBox">
								<?php foreach ($p->publicationtags as $key => $pt): ?>
									<div class="blog__tag"><?= $pt->header ?></div>
								<?php endforeach ?>
							</div>
						<?php endif ?>
						<p class="blog__text"><?= nl2br(Html::encode($p->shorttext)) ?></p>
						<div class="blog__lineBox blog__lineBox_pb20">
							<a href="<?= Url::to(['user/publication-view', 'id' => $p->id]) ?>" class="g-link">Подробнее</a>
							<a href="<?= Url::to(['user/publication-update', 'id' => $p->id]) ?>" class="g-link g-link_edit g-p_r35">Редактировать</a>
						</div>
						<div class="blog__border"></div>
					</li>
				<?php endforeach ?>
			</ul>
			<?= LinkPager::widget(['pagination' => $pagination,]); ?>
		<?php else: ?>
			<p>Нет публикаций.</p>
		<?php endif ?>
	</div>





</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('/site/right', [
	]) ?>

</aside>