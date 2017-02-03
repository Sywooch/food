<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Mainpage */

$this->title = 'Create Mainpage';
$this->params['breadcrumbs'][] = ['label' => 'Mainpages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mainpage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
