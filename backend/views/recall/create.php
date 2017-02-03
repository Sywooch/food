<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Recall */

$this->title = 'Добавление отзыва покупателя';
$this->params['breadcrumbs'][] = ['label' => 'Отзывы покупателей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recall-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
