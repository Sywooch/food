<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<aside class="l-sidebar l-sidebar_left">

	<?= $this->render('/site/left', [
	]) ?>

</aside>
<div class="g-flexMiddleChild middleWrapper">

	<div class="form__border"></div>
	<div class="middleWrapper__container">
		<div class="headerBox">
			<h1 class="headerBox__title"><?= Html::encode($this->title) ?></h1>
		</div>

		<p><?= nl2br(Html::encode($message)) ?></p>
		<!-- <p><?//= nl2br(Html::encode($exception->getMessage())) ?></p> -->
		<p>Во время обработки вашего запроса произошла ошибка.</p>
		<p>Пожалуйста, свяжитесь с нами, если вы думаете, что это ошибка сервера. Спасибо.</p>
	</div>

</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('/site/right', [
	]) ?>

</aside>