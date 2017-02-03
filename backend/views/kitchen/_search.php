<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KitchenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kitchen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sid') ?>

    <?= $form->field($model, 'header') ?>

    <div class="form-group">
        <?= Html::submitButton('Найи', ['class' => 'btn btn-primary']) ?>
        <?php //= Html::resetButton('Сбросить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
