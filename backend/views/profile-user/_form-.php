<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\ProfileUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-user-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?php if ($model->iconsrc && file_exists(Yii::getAlias('@frontend/web/', $model->iconsrc))): ?>
        <p>Аватар: </p>
        <?= Html::img(Yii::getAlias('@webfrontend') . $model->iconsrc, ['class'=>'img-responsive']) ?>
        <div class="btn-group" data-toggle="buttons">
            <?= Html::activeCheckbox($model,'del_file',['uncheck' => null, 'label' => 'Удалить аватар', 'labelOptions' => ['class'=>"btn btn-primary"]]) ?>
        </div>
    <?php endif ?>

    <?= $form->field($model, 'icon')->fileInput(['accept' => 'image/*'])->label('Загрузить аватар') ?>

    <?= $form->field($model, 'kitchen')->dropDownList($kitchens,['multiple' => 'true','size'=>10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isCreate ? 'Добавить' : 'Сохранить', ['class' => $model->isCreate ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
