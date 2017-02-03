<?php
use yii\helpers\Url;
use common\models\User;
?>

<h2 class="sidebar__title sidebar__title_nav">
	<span class="sidebar__title_text">
		<?php if (isset(User::$leftcook[substr(Yii::$app->controller->action->id,4)])): ?>
			<?= User::$leftcook[substr(Yii::$app->controller->action->id,4)]['header'] ?>
		<?php else: ?>
			Профиль
		<?php endif ?>
	</span>
</h2>
<ul class="list list_p15">
	<?php foreach (User::$leftcook as $key => $value): ?>
		<li class="list__item">
			<a href="<?= Url::to(['site/user'.$key, 'id' => $user->id]) ?>" class="list__link" <?= (Yii::$app->controller->action->id === $key)?' style="color:#EE5E29"':'' ?>><?= $value['header'] ?></a>
		</li>
	<?php endforeach ?>
</ul>