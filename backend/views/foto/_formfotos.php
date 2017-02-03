<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Foto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="foto-form">

    <?php if ($model->e): ?>
        <p><?= $model->e->getMessage(); ?></p>
    <?php endif ?>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'album_id')->hiddenInput(['value'=>$album->id])->label(false) ?>

    <?= $form->field($model, 'file[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label('Добавить фотографии') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
