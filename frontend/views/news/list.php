<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->params['breadcrumbs'][] = ['label' => 'Новости', 'class' => 'breadcrumbs__link'];

$this->title = 'Новости';

?>

<aside class="l-sidebar l-sidebar_left">

		<?= $this->render('/site/left', [
		]); ?>

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

	<?php if (count($news)!==0): ?>
		<div class="middleWrapper__container">
			<div class="colsBox about">
				<div class="colsBox__col colsBox__col_wCalc-380">
					<ul class="preview">
						<li class="preview__item preview__item_big">
							<h2 class="preview__title"><a href="<?= Url::to(['news/view', 'id' => $news[0]->id, 'sid' => $news[0]->sid]) ?>"><?= $news[0]->header ?></a></h2>
							<h3 class="preview__subtitle"><?= date('Y-m-d', strtotime($news[0]->created_at)) ?></h3>
							<div class="preview__imgBox" href="<?= Url::to(['news/view', 'id' => $news[0]->id, 'sid' => $news[0]->sid]) ?>">
								<img src="<?= $news[0]->srcOf('full') ?>" alt="<?= $news[0]->header ?>" class="preview__img" />
								<?php if (count($news[0]->newsTag)): ?>
									<?php foreach ($news[0]->newsTag as $t): ?>
										<?= Html::a($t->header, ['news/list', 'tag' => $t->sid], ['class' => 'preview__tag']) ?>
									<?php endforeach ?>
								<?php endif ?>
								<!-- <a href="#" class="preview__tag">Событие</a> -->
							</div>
							<p class="preview__text"><?= $news[0]->introtext ?></p>
							<a href="<?= Url::to(['news/view', 'id' => $news[0]->id, 'sid' => $news[0]->sid]) ?>" class="g-link">Подробнее</a>
						</li>
						<?php for ($i=1; $i <= 10 ; $i++): ?>
							<?php if (isset($news[$i])): ?>
						<li class="preview__item">
							<h2 class="preview__title"><?= $news[$i]->header ?></h2>
							<h3 class="preview__subtitle"><?= date('Y-m-d', strtotime($news[$i]->created_at)) ?></h3>
							<div class="preview__imgBox" href="<?= Url::to(['news/view', 'id' => $news[$i]->id, 'sid' => $news[$i]->sid]) ?>">
								<img src="<?= $news[$i]->srcOf('list') ?>" alt="<?= $news[$i]->header ?>" class="preview__img" />
								<?php if (count($news[$i]->newsTag)): ?>
									<?php foreach ($news[$i]->newsTag as $t): ?>
										<?= Html::a($t->header, ['news/list', 'tag' => $t->sid], ['class' => 'preview__tag']) ?>
									<?php endforeach ?>
								<?php endif ?>
								<!-- <a href="#" class="preview__tag">Диеты</a> -->
							</div>
							<p class="preview__text"><?= $news[$i]->introtext ?></p>
							<a href="<?= Url::to(['news/view', 'id' => $news[$i]->id, 'sid' => $news[$i]->sid]) ?>" class="g-link">Подробнее</a>
						</li>
							<?php endif ?>
						<?php endfor; ?>
					</ul>
				</div>
				<div class="colsBox__col colsBox__col_w380">
					<ul class="preview">
						<?php for ($i=11; $i <= 17 ; $i++): ?>
							<?php if (isset($news[$i])): ?>
						<li class="preview__item">
							<h2 class="preview__title"><?= $news[$i]->header ?></h2>
							<h3 class="preview__subtitle"><?= date('Y-m-d', strtotime($news[$i]->created_at)) ?></h3>
							<div class="preview__imgBox" href="<?= Url::to(['news/view', 'id' => $news[$i]->id]) ?>">
								<img src="<?= $news[$i]->srcOf('list') ?>" alt="<?= $news[$i]->header ?>" class="preview__img" />
								<?php if (count($news[$i]->newsTag)): ?>
									<?php foreach ($news[$i]->newsTag as $t): ?>
										<?= Html::a($t->header, ['news/list', 'tag' => $t->sid], ['class' => 'preview__tag']) ?>
									<?php endforeach ?>
								<?php endif ?>
								<!-- <a href="#" class="preview__tag">Диеты</a> -->
							</div>
							<p class="preview__text"><?= $news[$i]->introtext ?></p>
							<a href="<?= Url::to(['news/view', 'id' => $news[$i]->id]) ?>" class="g-link">Подробнее</a>
						</li>
							<?php endif ?>
						<?php endfor; ?>
					</ul>
				</div>
			</div>
			<?= LinkPager::widget(['pagination' => $pagination,]); ?>
		</div>


	<?php else: ?>
		<p>Нет записей</p>
	<?php endif; ?>

						



</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('/site/right', [
	]); ?>

</aside>



