<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['news/list'], 'class' => 'breadcrumbs__link'];

$this->params['breadcrumbs'][] = ['label' => $news->header];

$this->title = $news->header;

?>

<aside class="l-sidebar l-sidebar_left">

	<?= $this->render('/site/left', [
	]) ?>

</aside>
<div class="g-flexMiddleChild middleWrapper">
	
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
		<div class="colsBox about">
			<div class="colsBox__col colsBox__col_wCalc-380">
				<ul class="preview">
					<li class="preview__item preview__item_big">
						<h2 class="preview__title"><?= $news->header ?></h2>
						<h3 class="preview__subtitle"><?= date('Y-m-d', strtotime($news->created_at)) ?></h3>
						<div class="preview__imgBox">
							<img src="<?= $news->srcOf('full') ?>" alt="<?= $news->header ?>" class="preview__img" />
							<?php if (count($news->newsTag)): ?>
								<?php foreach ($news->newsTag as $t): ?>
									<?= Html::a($t->header, ['news/list', 'tag' => $t->sid], ['class' => 'preview__tag']) ?>
								<?php endforeach ?>
							<?php endif ?>
						</div>
						<?= $news->text ?>
					</li>
				</ul>
			</div>
		</div>
	</div>

</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('/site/right', [
	]) ?>

</aside>