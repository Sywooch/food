<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $signupForm \frontend\models\SignupForm */

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\widgets\Breadcrumbs;

use frontend\models\Pjax;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;

?>





<aside class="l-sidebar l-sidebar_left">

    <?= $this->render('left', [
    ]); ?>

</aside>
<div class="g-flexMiddleChild middleWrapper">
    
    <?= Breadcrumbs::widget([
        'options' => [
            'class' => 'breadcrumbs',
        ],
        'itemTemplate' => '<li class="breadcrumbs__item">{link}</li>',
        'activeItemTemplate' => '<li class="breadcrumbs__item">{link}</li>',
        'homeLink' => [
            'label' => 'Главная',
            'url' => Yii::$app->homeUrl,
            'class' => 'breadcrumbs__link',
        ],
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>












<?php // Pjax::begin(['id' => 'pjax-form-signup']); ?>


    <form class="form" id="form-signup" action="<?= Url::to(['site/signup']) ?>" method="post" role="form" data-pjax="1">
        <?php $csrfToken = Yii::$app->request->getCsrfToken(); ?>
        <input type="hidden" name="_csrf" value="<?=$csrfToken?>" />
        <input name="form" type="hidden" value="signup" />
        <div class="form__section">
            <div class="headerBox headerBox_jc">
                <div class="socialBox socialBox_midCont">
                    <a class="socialBox__title" href="#">Войти с помощью соц. сетей</a>
                    <div>
                        <a class="socialBox__icon socialBox__icon_mail" href="#">mail.ru</a>
                        <a class="socialBox__icon socialBox__icon_mail" href="#">mail.ru</a>
                        <a class="socialBox__icon socialBox__icon_mail" href="#">mail.ru</a>
                        <a class="socialBox__icon socialBox__icon_mail" href="#">mail.ru</a>
                        <a class="socialBox__icon socialBox__icon_mail" href="#">mail.ru</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="form__border"></div>
        <h4 class="form__header">Общая информация</h4>
        <div class="form__section">
            <div class="form__colWrapper s_main_fields">
                <div class="form__leftCol form__leftCol_w65">
                    <div class="form__line">
                        <label class="form__label form__label_w260" for="signupform-username">Имя:</label>
                        <input class="form__val section_500" type="text" placeholder="Владимир" id="signupform-username" name="User[name]" autofocus="" value="<?= $user->name ?>" />
                    </div>

                    <?php if (isset($user->errors)&&isset($user->errors['name'])): ?>
                        <div class="error form__line_ml250">
                            <?php foreach ($user->errors['name'] as $error): ?>
                                <p><?= $error ?></p>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>

                    <div class="form__line">
                        <label class="form__label form__label_w260" for="">Фамилия:</label>
                        <input name="User[surname]" class="form__val section_500" type="text" placeholder="Владимиров" value="<?= $user->surname ?>" />
                    </div>

                    <?php if (isset($user->errors)&&isset($user->errors['surname'])): ?>
                        <div class="error form__line_ml250">
                            <?php foreach ($user->errors['surname'] as $error): ?>
                                <p><?= $error ?></p>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>

                    <div class="form__line">
                        <label class="form__label form__label_w260" for="signupform-phonenumber">Телефон:</label>
                        <input class="form__val section_500" type="text" placeholder="8 800 555 55 55" id="signupform-phonenumber" name="Phonenumber[phonenumber]" value="<?= $phonenumber->phonenumber ?>" />
                    </div>

                    <?php if (isset($phonenumber->errors)&&isset($phonenumber->errors['phonenumber'])): ?>
                        <div class="error form__line_ml250">
                            <?php foreach ($phonenumber->errors['phonenumber'] as $error): ?>
                                <p><?= $error ?></p>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>

                    <div class="form__line">
                        <label class="form__label form__label_w260" for="signupform-email">E-mail:</label>
                        <input class="form__val section_500" type="text" placeholder="yourmail@yandex.ru" id="signupform-email" name="User[email]" value="<?= $user->email ?>" />
                    </div>

                    <?php if (isset($user->errors)&&isset($user->errors['email'])): ?>
                        <div class="error form__line_ml250">
                            <?php foreach ($user->errors['email'] as $error): ?>
                                <p><?= $error ?></p>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>

                    <div class="form__line">
                        <label class="form__label form__label_w260" for="signupform-password">Пароль:</label>
                        <input class="form__val form__val_berlin section_500" type="password" placeholder="*****" id="signupform-password" name="SignupForm[password]" value="<?= $signupForm->password ?>" />
                    </div>

                    <?php if (isset($signupForm->errors)&&isset($signupForm->errors['password'])): ?>
                        <div class="error form__line_ml250">
                            <?php foreach ($signupForm->errors['password'] as $error): ?>
                                <p><?= $error ?></p>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>

                    <div class="form__line">
                        <label class="form__label form__label_w260" for="signupform-password">Повторите пароль:</label>
                        <input class="form__val form__val_berlin section_500" type="password" placeholder="*****" id="signupform-password" name="SignupForm[passwordrepeat]" value="<?= $signupForm->passwordrepeat ?>" />
                    </div>

                    <?php if (isset($signupForm->errors)&&isset($signupForm->errors['passwordrepeat'])): ?>
                        <div class="error form__line_ml250">
                            <?php foreach ($signupForm->errors['passwordrepeat'] as $error): ?>
                                <p><?= $error ?></p>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>

                    <div class="form__line form__line_centeredContent">
                        <label class="form__label form__label_w260" for="signupform-email">Зарегистрироваться как:</label>
                        <div class="linksBox linksBox_inline pl0">
                            <label class="linksBox__lbl mr15" for="signupform-usertype-user">
                                <input name="User[usertype]" class="linksBox__radio" id="signupform-usertype-user" type="radio" value="user"<?= $user->usertype==User::TYPE_USER?' checked':'' ?> />
                                <div class="linksBox__item linksBox__item_rounded">Пользователь</div>
                            </label>
                            <label class="linksBox__lbl" for="signupform-usertype-cook">
                                <input name="User[usertype]" class="linksBox__radio" id="signupform-usertype-cook" type="radio" value="cook"<?= $user->usertype==User::TYPE_COOK?' checked':'' ?> />
                                <div class="linksBox__item linksBox__item_rounded">Кулинар</div>
                            </label>
                        </div>

                        <?php if (isset($user->errors)&&isset($user->errors['usertype'])): ?>
                            <div class="error form__line_ml250">
                                <?php foreach ($user->errors['usertype'] as $error): ?>
                                    <p><?= $error ?></p>
                                <?php endforeach ?>
                            </div>
                        <?php endif ?>

                    </div>
                    <div class="form__line">
                        <div class="form__val form__val_info ml260 section_500">Все поля, обязательные для заполнения</div>
                    </div>
                </div>
                <div class="form__rightCol form__rightCol_w35">
                    <div class="regPers">
                        <div class="regPers__imgBox">
                            <!-- <img class="regPers__img" src="../../images/reg__cooker.png" alt="" /> -->
                            <img class="regPers__img" src="../../images/reg__user.png" alt="" />
                        </div>
                        <h2 class="regPers__title">Регистрация кулинара</h2>
                        <!-- <h2 class="regPers__title">Регистрация пользователя</h2> -->
                        <div class="spacer mb15"></div>
                        <p class="regPers__text">Очень краткое мотивационное описание преимуществ. Панкейки — пирожные на сковородке, если перевести, — круглые пышные блинчики, которые принято</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="form__border"></div>
        <div class="form__section">
            <div class="form__colWrapper s_conf_reg">
                <div class="form__leftCol form__leftCol_w65 tac">
                    <input name="submitform" type="submit" class="g-button g-button_green" value="Зарегистрироваться" />
                </div>
                <div class="form__rightCol form__rightCol_w35 tac">
                    <div class="form__val form__val_info tal">Регистрируясь, вы соглашаетесь c <a class="db" href="#">условиями пользовательского соглашения</a></div>
                </div>
            </div>
        </div>
    </form>


    <?php if ($popup): ?>
    <div class="popup show s_registration_popup">
    <?php else: ?>
    <div class="popup">
    <?php endif; ?>
        <div class="popup__wrap">
            <div class="popup__exit">Выход</div>
            <form class="popup__form" action="<?= Url::to(['site/signup']) ?>" method="post">
                <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                <!-- <input type="hidden" name="_csrf" value="<?//=$csrfToken?>" /> -->
                <input name="form" type="hidden" value="phonenumber" />
                <div class="headerBox headerBox_jc">
                    <h1 class="headerBox__title">Подтверждение регистрации</h1>
                </div>
                <div class="popup__line popup__line_alc">
                    <p class="popup__text pr10">На указанный Вами номер:</p>
                    <div>
                        <input class="editBox mr10" type="text" readonly="" value="<?= $phonenumber->phonenumber ?>" />
                        <div class="form__edit form__edit_order js-form__edit_order"></div>
                    </div>
                </div>
                <div class="popup__line">
                    <P class="popup__text">В течение десяти минут придёт SMS-сообщение с кодом, который необходимо ввести ниже:</P>
                </div>
                <div class="form__line form__line_centeredContent">
                    <label for="" class="form__label form__label_wa">Полученный код:</label>
                    <input name="code" class="g-input g-input_mr0 section_500" placeholder="..." type="text" value="" />
                </div>
                <?php if ($message): ?>
                    <div class="form__line form__line_centeredContent">
                        <p class="error"><?= $message ?></p>
                    </div>
                <?php endif ?>
                <div class="popup__line">
                    <P class="popup__text">Не пришла СМС? <a href="#">Отправить ещё раз через 60 секунд</a></P>
                </div>
                <div class="popup__line popup__line_center">
                    <input name="submitform" type="submit" class="g-button g-button_green" value="Подтвердить" />
                </div>
            </form>
        </div>
    </div>



<?php // Pjax::end(); ?>














</div>
<aside class="l-sidebar l-sidebar_right">

    <?= $this->render('right', [
    ]); ?>

</aside>
