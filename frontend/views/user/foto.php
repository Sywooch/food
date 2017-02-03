<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

$this->params['breadcrumbs'][] = ['label' => 'Альбомы'];

$this->title = 'Альбомы';

?>

<aside class="l-sidebar l-sidebar_left">

	<?= $this->render('left'.$user->usertype, [
	]) ?>

</aside>
<div class="g-flexMiddleChild middleWrapper">

	<div class="menuTop">

		<?= $this->render('top-menu-cook', [
			'user' => $user,
		]) ?>

		<div>
			<a href="<?= Url::to(['user/fotoadd']) ?>" class="g-link g-link_mr20">Добавить альбом</a>
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
			<h1 class="headerBox__title">Альбомы</h1>
		</div>

		<?php if (count($model)): ?>
			<div class="photo">
				<ul class="photo__list">

				<?php foreach ($model as $key => $album): ?>

					<li class="photo__item photo__item_h415">
						<h2 class="photo__header"><?= $album->header ?></h2>
						<h3 class="photo__line"><?= $album->created_at ?></h3>
						<div class="photo__imgBox" href="#">
							<img class="photo__img" src="<?= ($album->foto_id)?$album->getSource('list'):'' ?>" alt="" />
							<div class="photo__hiddenBox">
								<a href="<?= Url::to(['user/fotodel', 'id' => $album->id]) ?>" class="photo__remove">Удалить</a>
							</div>
						</div>
						<p class="photo__text">
							<?= $album->text ?>
						</p>
						<a href="<?= Url::to(['user/fotoview', 'id' => $album->id]) ?>" class="g-link photo__but">Редактировать</a>
					</li>

				<?php endforeach ?>

				</ul>
			</div>
			
		<?php else: ?>
			<div class="antiReset">
				Нет альбомов
			</div>
		<?php endif ?>

	</div>



</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('/site/right', [
	]) ?>

</aside>