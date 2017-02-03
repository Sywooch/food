<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>


<aside class="l-sidebar l-sidebar_left">

    <?= $this->render('left', [
    ]); ?>

</aside>
<div class="g-flexMiddleChild middleWrapper">
    
    <div class="middleWrapper__container">
        <div class="headerBox">
            <h1 class="headerBox__title">Вход</h1>
        </div>
    </div>
    <div class="form__border"></div>
    <h4 class="form__header">Общая информация</h4>
    <form class="form" id="form-signup" action="<?= Url::to(['site/login']) ?>" method="post" role="form">
        <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        <div class="form__section">
        <div class="headerBox headerBox_centered">
            <div class="socialBox socialBox_midCont">
                <a class="socialBox__title" href="#">Войти с помощью соц. сетей</a>
                <a class="socialBox__icon socialBox__icon_mail" href="#">mail.ru</a>
                <a class="socialBox__icon socialBox__icon_mail" href="#">mail.ru</a>
                <a class="socialBox__icon socialBox__icon_mail" href="#">mail.ru</a>
                <a class="socialBox__icon socialBox__icon_mail" href="#">mail.ru</a>
                <a class="socialBox__icon socialBox__icon_mail" href="#">mail.ru</a>
            </div>
        </div>
        </div>
        <div class="form__border"></div>
        <h4 class="form__header">Общая информация</h4>
        <div class="form__section">
            <div class="form__colWrapper">
                <div class="form__leftCol form__leftCol_w65">
                    <div class="form__line">
                        <?php if ($model->errors): ?>
<p>Не удается войти.</p>
<p>Пожалуйста, проверьте правильность написания логина и пароля.</p>
<p>Возможно, нажата клавиша CAPS-lock?</p>
<p>Может быть, у Вас включена неправильная раскладка? (русская или английская)</p>
<p>Попробуйте набрать свой пароль в текстовом редакторе и скопировать в графу «Пароль»</p>
                        <?php endif; ?>
                    </div>
                    <div class="form__line">
                        <label class="form__label req" for="">Телефон или email:</label>
                        <input name="LoginForm[username]" type="text" class="form__val section_500" placeholder="Владимир Владимирович" value="<?= $model->username ?>" />
                        <!-- <?//php if ($model->errors): ?>
                            <?//php if (isset($model->errors['username'])): ?>
                                <div class="error">
                                    <?//php foreach ($model->errors['username'] as $error): ?>
                                        <p><?//= $error ?></p>
                                    <?//php endforeach ?>
                                </div>
                            <?//php endif ?>
                        <?//php endif ?> -->
                    </div>
                    <div class="form__line">
                        <label class="form__label req" for="signupform-password">Пароль:</label>
                        <input name="LoginForm[password]" type="password" class="form__val form__val_berlin section_500" placeholder="*****" id="signupform-password" value="<?= $model->password ?>" />
                        <!-- <?//php if ($model->errors): ?>
                            <?//php if (isset($model->errors['password'])): ?>
                                <div class="error">
                                    <?//php foreach ($model->errors['password'] as $error): ?>
                                        <p><?//= $error ?></p>
                                    <?//php endforeach ?>
                                </div>
                            <?//php endif ?>
                        <?//php endif ?> -->
                    </div>
                    <div class="form__line">
                        <label class="form__label" for="signupform-email"></label>
                        <div class="form__val form__val_info section_500"><span class="form__val_berlin">*</span> - поля, обязательные для заполнения</div>
                    </div>
                    <div class="form__line">
                        <label class="form__label" for="asrfgadcwarg">Запомнить</label>
                        <input name="LoginForm[rememberMe]" type="checkbox" id="asrfgadcwarg" value="1">
                    </div>
                    <div class="form__line">
                        <p>
                            Если вы забыли свой пароль, то можете <?= Html::a('сбросить его', ['site/request-password-reset']) ?>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="form__border"></div>
        <div class="form__section">
            <div class="form__line form__line_centeredWidth form__line_plr30">
                <div>
                    <input name="submit" type="submit" class="g-button g-button_green g-m_r15" value="Войти" />
                </div>
                <div class="checkOptions">
                    <div class="checkOptions__wrap">
                        <label class="messenger__wrap messenger__wrap_mr7">
                            <input class="messenger__check" type="checkbox">
                            <div class="messenger__bg"></div>
                        </label>
                        <div class="checkOptions__name">Пользовательское соглашение</div>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <!-- <h1><?//= Html::encode($this->title) ?></h1>
    <p>Пожалуйста, заполните следующие поля для входа:</p>
    <?//php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <?//= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        <?//= $form->field($model, 'password')->passwordInput() ?>
        <?//= $form->field($model, 'rememberMe')->checkbox() ?>
        <p>
            Если вы забыли свой пароль, то можете <?//= Html::a('сбросить его', ['site/request-password-reset']) ?>.
        </p>
        <p>
            <?//= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </p>
    <?//php ActiveForm::end(); ?> -->



</div>
<aside class="l-sidebar l-sidebar_right">

    <?= $this->render('right', [
    ]); ?>

</aside>
