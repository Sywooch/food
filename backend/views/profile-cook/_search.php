<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProfileCookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-cook-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'region') ?>

    <?= $form->field($model, 'about') ?>

    <?= $form->field($model, 'costmin') ?>

    <?= $form->field($model, 'costfree') ?>

    <?php // echo $form->field($model, 'costdelivery') ?>

    <?php // echo $form->field($model, 'pickup') ?>

    <?php // echo $form->field($model, 'workhome') ?>

    <?php // echo $form->field($model, 'workevent') ?>

    <?php // echo $form->field($model, 'callfrom') ?>

    <?php // echo $form->field($model, 'callto') ?>

    <div class="form-group">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сбросить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
