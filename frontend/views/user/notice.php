<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

$this->title = 'Уведомления';

$this->params['breadcrumbs'][] = ['label' => 'Уведомления'];

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
			<h1 class="headerBox__title">Мои уведомления</h1>
		</div>

		<div class="alert">
			<ul class="list">
			<?php if ($notices): ?>
				<?php foreach ($notices as $key => $n): ?>
					<li class="list__item list__item_big list__item_bb list__item_pl20 js-list__item_hover<?= $n->read?'':' js-list__item_newMsg' ?>">
						<div class="list__innerWrapper list__innerWrapper_width100">
							<a href="#" class="list__img">
								<img class="list__innerImg" src="<?= $n->author->getIconsrc('icon') ?>" alt="">
								<span class="list__status list__status_active"></span>
							</a>
							<div class="g-cooker list__descr list__descr100">
								<div class="g-cooker__header g-cooker__header_bottom10 g-cooker__header_w100">
									<div class="g-cooker__line g-cooker__line_orange g-cooker__line_fz14"><?= $n->author->username ?></div>
									<div class="g-cooker__line g-cooker__line_lightGrey g-cooker__line_fz14">18:30:24</div>
								</div>
								<div class="g-cooker__line"><?= $n->text ?></div>
							</div>
						</div>
					</li>
				<?php endforeach ?>
			<?php else: ?>
				<p>Нет уведомлений.</p>
			<?php endif ?>


				<!-- <li class="list__item list__item_big list__item_bb list__item_pl20 js-list__item_hover">
					<div class="list__innerWrapper list__innerWrapper_width100">
						<a href="#" class="list__img">
							<img class="list__innerImg" src="../../images/cooker.png" alt="">
							<span class="list__status"></span>
						</a>
						<div class="g-cooker list__descr list__descr100">
							<div class="g-cooker__header g-cooker__header_bottom10 g-cooker__header_w100">
								<div class="g-cooker__line g-cooker__line_orange g-cooker__line_fz14">Геннадий</div>
								<div class="g-cooker__line g-cooker__line_lightGrey g-cooker__line_fz14">27.04.2016</div>
							</div>
							<div class="g-cooker__line">Ответил на ваш комментарий <a href="#">как правильно жарить мясо</a></div>
						</div>
					</div>
				</li>
				<li class="list__item list__item_big list__item_bb list__item_pl20 js-list__item_hover js-list__item_newMsg">
					<div class="list__innerWrapper list__innerWrapper_width100">
						<a href="#" class="list__img">
							<img class="list__innerImg" src="../../images/cooker.png" alt="">
							<span class="list__status"></span>
						</a>
						<div class="g-cooker list__descr list__descr100">
							<div class="g-cooker__header g-cooker__header_bottom10 g-cooker__header_w100">
								<div class="g-cooker__line g-cooker__line_orange g-cooker__line_fz14">Геннадий</div>
								<div class="g-cooker__line g-cooker__line_lightGrey g-cooker__line_fz14">27.04.2016</div>
							</div>
							<div class="g-cooker__line">Ответил на ваш комментарий <a href="#">как правильно жарить мясо</a></div>
						</div>
					</div>
				</li> -->
				

			</ul>
		</div>

	</div>























</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('/site/right', [
	]) ?>

</aside>