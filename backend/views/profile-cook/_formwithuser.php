<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProfileCook */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-cook-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //= $form->field($model, 'user_id')->textInput() ?>
    <?= $form->field($model, 'user_id')->hiddenInput(['value'=>$model->user_id])->label(false) ?>

    <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'about')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'costmin')->textInput(['maxlength' => true, 'value' => is_null($model->costmin)?100:$model->costmin]) ?>

    <?= $form->field($model, 'costfree')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'costdelivery')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pickup')->checkBox() ?>

    <?= $form->field($model, 'workhome')->checkBox() ?>

    <?= $form->field($model, 'workevent')->checkBox() ?>

    <?= $form->field($model, 'callfrom')->textInput(['maxlength' => true, 'placeholder' => '0000', 'value' => is_null($model->callfrom)?'0000':$model->callfrom]) ?>

    <?= $form->field($model, 'callto')->textInput(['maxlength' => true, 'placeholder' => '2359', 'value' => is_null($model->callto)?'2359':$model->callto]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
