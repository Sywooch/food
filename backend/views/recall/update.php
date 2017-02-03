<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Recall */

$this->title = 'Редактирование отзыва покупателя с ид.: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Отзывы покупателей', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="recall-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
