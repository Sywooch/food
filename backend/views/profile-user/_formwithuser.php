<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\ProfileUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-user-form">

    <?php if ($model->e): ?>
        <?= $model->e->getMessage() ?>
    <?php endif ?>

    <?php $form = ActiveForm::begin(); ?>

    <?php //= $form->field($model, 'user_id')->textInput() ?>
    <?= $form->field($model, 'user_id')->hiddenInput(['value'=>$model->user_id])->label(false) ?>

    <?php if ($model->iconsrc && file_exists(Yii::getAlias('@frontend/web/', $model->iconsrc))): ?>
        <p>Аватар: </p>
        <?= Html::img(Yii::getAlias('@webfrontend') . $model->iconsrc, ['class'=>'img-responsive']) ?>
        <div class="btn-group" data-toggle="buttons">
            <?= Html::activeCheckbox($model,'del_file',['uncheck' => null, 'label' => 'Удалить аватар', 'labelOptions' => ['class'=>"btn btn-primary"]]) ?>
        </div>
    <?php endif ?>

    <?= $form->field($model, 'file')->fileInput(['accept' => 'image/*'])->label('Загрузить аватар') ?>

    <?= $form->field($model, 'selectedKitchen')->dropDownList($kitchenList,['multiple' => 'true','size'=>10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
