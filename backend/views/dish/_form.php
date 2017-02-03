<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Dish */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dish-form">

    <?php $form = ActiveForm::begin([
        // 'enableAjaxValidation' => true,
    ]); ?>

    <?php if (!$model->isNewRecord): ?>
        <?= $form->field($model, 'product_id')->textInput() ?>
    <?php endif ?>

    <?= $form->field($model->product, 'user_id')->textInput()->label('Блюдо от пользователя с Ид.') ?>

    <?= $form->field($model->product, 'header')->textInput() ?>

    <?= $form->field($model->product, 'price')->textInput() ?>

    <?= $form->field($model->product, 'pricesale')->textInput() ?>

    <?= $form->field($model, 'dishmode_id')->radioList($dishmodes) ?>

    <?= $form->field($model, 'diet_id')->dropDownList($diets,['prompt' => 'Выберите вид диеты…']) ?>

    <?= $form->field($model, 'kitchens')->dropDownList($kitchens,['multiple' => 'true','size'=>8]) ?>

    <?= $form->field($model, 'dishtype_id')->dropDownList($dishtypes,['prompt' => 'Выберите тип блюда…']) ?>

    <?= $form->field($model->product, 'time')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
