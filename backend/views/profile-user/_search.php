<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProfileUserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'phone') ?>

    <div class="form-group">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сбросить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
