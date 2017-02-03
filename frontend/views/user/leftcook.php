<?php
use yii\helpers\Url;
use common\models\User;
?>

<h2 class="sidebar__titleBox">
		<?php if (isset(User::$leftcook[Yii::$app->controller->action->id])): ?>
			<?= User::$leftcook[Yii::$app->controller->action->id]['header'] ?>
		<?php elseif (isset(User::$topcook[Yii::$app->controller->id.'/'.Yii::$app->controller->action->id])): ?>
			<?= User::$topcook[Yii::$app->controller->id.'/'.Yii::$app->controller->action->id]['header'] ?>
		<?php else: ?>
			Профиль
		<?php endif ?>
</h2>
<ul class="list list_p15">
	<?php foreach (User::$leftcook as $key => $value): ?>
		<li class="list__item">
			<a href="<?= Url::to(['user/'.$key]) ?>" class="list__link" <?= (Yii::$app->controller->action->id === $key)?' style="color:#EE5E29"':'' ?>><?= $value['header'] ?></a>
		</li>
	<?php endforeach ?>
</ul>