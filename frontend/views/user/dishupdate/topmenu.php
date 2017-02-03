<?php
use yii\helpers\Html;
?>

<div class="menuTop">
	<ul class="menuTop__tabs">
		<li class="menuTop__item">
			<?= Html::a('Уведомления', ['user/notice'], ['class' => 'menuTop__link']) ?>
		</li>
		<li class="menuTop__item">
			<?= Html::a('Сообщения' . '<span class="g-count"><span class="g-count__val">99</span>', ['user/messages'], ['class' => 'menuTop__link']) ?>
		<li class="menuTop__item">
			<?= Html::a('Отзывы', ['user/reviews'], ['class' => 'menuTop__link']) ?>
		</li>
		<li class="menuTop__item">
			<?= Html::a('Заказы', ['user/orders'], ['class' => 'menuTop__link']) ?>
		</li>
		<li class="menuTop__item">
			<?= Html::a('Рейтинг', ['user/rating'], ['class' => 'menuTop__link']) ?>
		</li>
	</ul>
</div>
