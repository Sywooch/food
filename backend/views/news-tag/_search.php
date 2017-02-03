<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\NewsTagSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-tag-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <h2>Поиск</h2>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sid') ?>

    <?= $form->field($model, 'header') ?>

    <div class="form-group">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сбросить', ['class' => 'btn btn-default', 'type'=>'reset']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
