<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="menuTop">
	<ul class="menuTop__tabs">

		<?php foreach (Yii::$app->controller->topcook as $key => $value): ?>
			<li class="menuTop__item">
				<a href="<?= Url::to(['user/'.$key]) ?>" class="menuTop__link" <?= (Yii::$app->controller->action->id === $key)?' style="color:#EE5E29"':'' ?>><?= $value['header'] ?></a>
			</li>
			
		<?php endforeach ?>

		<?php//= Html::a('Сообщения' . '<span class="g-count"><span class="g-count__val">99</span>', ['user/messages'], ['class' => 'menuTop__link']) ?>

	</ul>
	<div>
		<?= Html::a('Сменить пароль', ['user/change-password'], ['class' => 'g-link g-link_mr20']) ?>
		<?php if (Yii::$app->controller->action->id != 'profileupdate'): ?>
			<?= Html::a('Редактировать профиль', ['user/profileupdate'], ['class' => 'g-link g-link_edit g-link_mr30 g-link_pr35']) ?>
		<?php endif ?>
	</div>
</div>
