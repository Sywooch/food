<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\helpers\Url;
// use yii\bootstrap\ActiveForm;

$this->title = 'Запрос на изменения пароля';
$this->params['breadcrumbs'][] = $this->title;
?>


<aside class="l-sidebar l-sidebar_left">

    <?= $this->render('left', [
    ]); ?>

</aside>
<div class="g-flexMiddleChild middleWrapper">


    <div class="middleWrapper__container">
        <div class="headerBox">
            <h1 class="headerBox__title"><?= Html::encode($this->title) ?></h1>
        </div>
        <?php if ($message): ?>
            <p><?= $message ?></p>
        <?php endif ?>
        <form method="post" action="<?= Url::to(['site/request-password-reset']) ?>">
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
            <input type="text" id="passwordresetrequestform-email" class="form-control" name="PasswordResetRequestForm[email]" autofocus="">
            <button type="submit" class="btn btn-primary">Send</button>
        </form>

    </div>


</div>
<aside class="l-sidebar l-sidebar_right">

    <?= $this->render('right', [
    ]); ?>

</aside>
