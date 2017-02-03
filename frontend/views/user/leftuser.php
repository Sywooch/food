<?php
use yii\helpers\Url;
use common\models\User;
?>

<!-- <h2 class="sidebar__title sidebar__title_nav"> -->
<h2 class="sidebar__titleBox">
	<!-- <span class="sidebar__title__text"> -->
		<?php if (isset(User::$leftuser[Yii::$app->controller->action->id])): ?>
			<?= User::$leftuser[Yii::$app->controller->action->id]['header'] ?>
		<?php elseif (isset(User::$topuser[Yii::$app->controller->id.'/'.Yii::$app->controller->action->id])): ?>
			<?= User::$topuser[Yii::$app->controller->id.'/'.Yii::$app->controller->action->id]['header'] ?>
		<?php else: ?>
			Профиль
		<?php endif ?>
	<!-- </span> -->
</h2>
<ul class="list list_p15">
	<?php foreach (User::$leftuser as $key => $value): ?>
		<li class="list__item">
			<a href="<?= Url::to(['user/'.$key]) ?>" class="list__link" <?= (Yii::$app->controller->action->id === $key)?' style="color:#EE5E29"':'' ?>><?= $value['header'] ?></a>
		</li>
	<?php endforeach ?>
</ul>