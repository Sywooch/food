<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Phonenumber */

$this->title = 'Редактирование номера телефона: ' . $model->code . '-' . $model->number ;
$this->params['breadcrumbs'][] = ['label' => 'Номера телефонов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code . '-' . $model->number , 'url' => ['view', 'code' => $model->code, 'number' => $model->number, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="phonenumber-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
