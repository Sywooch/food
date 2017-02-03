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

    <?= $form->field($profileUser, 'user_id')->textInput() ?>

    <?php if ($profileUser->iconsrc): ?>
        <p>Аватар: </p>
        <p><?= Html::img(Yii::getAlias('@webfrontend') . $profileUser->iconsrc, ['class'=>'img-responsive']) ?></p>
        <div class="btn-group" data-toggle="buttons">
            <?= Html::activeCheckbox($profileUser, 'del_icon',['uncheck' => null, 'label' => 'Удалить аватар', 'labelOptions' => ['class'=>"btn btn-primary"]]) ?>
        </div>
    <?php endif ?>

    <?= $form->field($profileUser, 'icon')->fileInput(['accept' => 'image/*'])->label('Загрузить аватар') ?>

    <?= $form->field($profileUserForm, 'kitchen')->dropDownList($kitchens,['multiple' => 'true','size'=>10]) ?>

    <div class="form-group">
        <?= Html::submitButton($profileUser->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $profileUser->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
