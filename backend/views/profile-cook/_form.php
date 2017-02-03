<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProfileCook */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(); ?>

<?= $form->field($profileCook, 'user_id')->textInput() ?>

<p>Аватар: </p>
<?php if ($profileCook->iconsrc): ?>
    <p><?= Html::img(Yii::getAlias('@webfrontend') . $profileCook->iconsrc, ['class'=>'img-responsive']) ?></p>
    <div class="btn-group" data-toggle="buttons">
        <?= Html::activeCheckbox($profileCook,'del_icon',['uncheck' => null, 'label' => 'Удалить аватар', 'labelOptions' => ['class'=>"btn btn-primary"]]) ?>
    </div>
<?php else: ?>
    <p>Не задан</p>
<?php endif ?>

<?= $form->field($profileCook, 'icon')->fileInput(['accept' => 'image/*'])->label('Загрузить аватар') ?>

<?= $form->field($profileCook, 'region')->textInput(['maxlength' => true]) ?>

<?= $form->field($profileCook, 'about')->textarea(['rows' => 6]) ?>

<?= $form->field($profileCook, 'costmin')->textInput(['maxlength' => true, 'value' => is_null($profileCook->costmin)?100:$profileCook->costmin]) ?>

<?= $form->field($profileCook, 'costfree')->textInput(['maxlength' => true]) ?>

<?= $form->field($profileCook, 'costdelivery')->textInput(['maxlength' => true]) ?>

<?= $form->field($profileCook, 'pickup')->checkBox() ?>

<?= $form->field($profileCook, 'workhome')->checkBox() ?>

<?= $form->field($profileCook, 'workevent')->checkBox() ?>

<?= $form->field($profileCook, 'callfrom')->textInput(['maxlength' => true, 'placeholder' => '0000', 'value' => is_null($profileCook->callfrom)?'0000':$profileCook->callfrom]) ?>

<?= $form->field($profileCook, 'callto')->textInput(['maxlength' => true, 'placeholder' => '2359', 'value' => is_null($profileCook->callto)?'2359':$profileCook->callto]) ?>

<div class="form-group">
    <?= Html::submitButton($profileCook->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $profileCook->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

