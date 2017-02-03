<?php
use yii\helpers\Url;
?>

<h2 class="sidebar__title sidebar__title_nav"><span class="sidebar__title__text">Профиль</span></h2>
<ul class="list list_p15">

	<?php
	// echo "<pre>";
	// print_r(Yii::$app->controller->action->id);
	// echo "</pre>";
	// die();
	?>
	
	<?php foreach (Yii::$app->controller->leftuser as $key => $value): ?>
		<li class="list__item">
			<a href="<?= Url::to(['user/'.$key]) ?>" class="list__link" <?= (Yii::$app->controller->action->id === $key)?' style="color:#EE5E29"':'' ?>><?= $value['header'] ?></a>
		</li>
	<?php endforeach ?>
</ul>