<?php
use yii\helpers\Url;
?>

<h2 class="sidebar__title sidebar__title_nav">
	<span class="sidebar__title__text">
		<?php if (isset(Yii::$app->controller->leftuser[Yii::$app->controller->action->id])): ?>
			<?= Yii::$app->controller->leftuser[Yii::$app->controller->action->id]['header'] ?>
		<?php elseif (isset(Yii::$app->controller->topuser[Yii::$app->controller->action->id])): ?>
			<?= Yii::$app->controller->topuser[Yii::$app->controller->action->id]['header'] ?>
		<?php else: ?>
			Профиль
		<?php endif ?>
	</span>
</h2>
<ul class="list list_p15">
	<?php foreach (Yii::$app->controller->leftuser as $key => $value): ?>
		<li class="list__item">
			<a href="<?= Url::to(['user/'.$key]) ?>" class="list__link" <?= (Yii::$app->controller->action->id === $key)?' style="color:#EE5E29"':'' ?>><?= $value['header'] ?></a>
		</li>
	<?php endforeach ?>
</ul>