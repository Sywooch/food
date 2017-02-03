<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;

use frontend\assets\MainAsset;
// use common\widgets\Alert;

MainAsset::register($this);

?>

<?php $this->beginPage() ?>
<?= $this->render('_head') ?>
<?php $this->beginBody() ?>

<div class="l-mainWrapper">
	<?= $this->render('_header') ?>
	<?= $content ?>
</div>
<?= $this->render('_footer') ?>

<?php $this->endBody() ?>
<?= $this->render('_foot') ?>
<?php $this->endPage() ?>
