<?php

/* @var $this \yii\web\View */
/* @var $content string */

// use yii\helpers\Html;
// use yii\widgets\Breadcrumbs;
// use common\widgets\Alert;
use frontend\assets\MainAsset;



MainAsset::register($this);
?>

<?php $this->beginPage() ?>
<?= $this->render('_head') ?>
<?php $this->beginBody() ?>
<div class="l-mainWrapper">
	<?= $this->render('_header') ?>
	<div class="l-mainContainer">
		<div class="g-flexContainer g-mainSection">

		<?= $content ?>

		</div>
		<?= $this->render('_prefooter') ?>
	</div>
</div>

<?= $this->render('_footer') ?>

<?php $this->endBody() ?>
<?= $this->render('_foot') ?>
<?php $this->endPage() ?>
