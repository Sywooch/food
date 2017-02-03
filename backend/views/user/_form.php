<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $modelform backend\models\CreateUserForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php if ($modelform->e): ?>
        <p><?= $modelform->e->getMessage() ?></p>
    <?php endif ?>

    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

    <?= $form->field($modelform, 'username') ?>
    <?= $form->field($modelform, 'email')->textInput(['type'=>'email', 'autocomplete'=>'off']) ?>
    <?= $form->field($modelform, 'newpassword')->passwordInput() ?>
    <?= $form->field($modelform, 'newpasswordrepeat')->passwordInput() ?>
    <?= $form->field($modelform, 'status')->radioList(User::$statusName) ?>
    <?= $form->field($modelform, 'usertype')->radioList(User::$usertypeName) ?>
    <?= $form->field($modelform, 'role')->radioList(User::$roleName) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
