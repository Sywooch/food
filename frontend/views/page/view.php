<?php

use common\components\ztree\Ztree;
use yii\widgets\Breadcrumbs;

end($branch);
$endkey = key($branch);
foreach ($branch as $key => $value) {
	if ($key!==$endkey)
	{
		$this->params['breadcrumbs'][] = ['label' => $value['header'], 'url' => ['page/view', 'sid' => $value['sid']]];
	}
	else
	{
		$this->params['breadcrumbs'][] = ['label' => $value['header']];
	}
}

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
				<div class="colsBox__col colsBox__col_w280">

				</div>
				<div class="colsBox__col colsBox__col_w530">
				<?php if ($page->pretext != NULL): ?>
					<div class="headingBox">
				<?php endif; ?>
						<h1 class="title">
							<span class="title__line"><h1><?= $page->header ?></h1></span>
							<span class="title__line">COOKERY<span class="title__orange">ONE</span></span>
						</h1>
						<?php if ($page->pretext != NULL): ?>
						<div class="colsBox__line antiReset">
							<?= $page->pretext ?>
							<p><a href="#" class="g-link">Перейти к регистрации</a></p>
						</div>
					</div>
				<?php endif; ?>
					<?= $page->text ?>
				</div>
				<div class="colsBox__col colsBox__col_wCalc-810">
					<div class="about__lbl">3546</div>
					<div class="about__val">Поваров на портале</div>
					<div class="about__lbl">3546</div>
					<div class="about__val">Заказов сегодня</div>
				</div>
			</div>
		</div>

</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('/site/right', [
	]) ?>

</aside>