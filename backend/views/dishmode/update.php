<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Dishmode */

$this->title = 'Редактирование вида блюд: ' . $model->header;
$this->params['breadcrumbs'][] = ['label' => 'Виды блюд', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->header, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="dishmode-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
