<?php
/**
 * Created by PhpStorm.
 * User: indefpro
 * Date: 29.07.2016
 * Time: 15:06
 */
use yii\helpers\Html;
use yii\helpers\Url;

use common\models\Partner;

$partners = Partner::find()
    ->where(['show' => 1])
    ->all();

?>
<div class="bottomContainer">
    <div class="bottomContainer__line">
        <div class="inWrap">
            <h2 class="bottomContainer__title">Как это работает</h2>
            <div class="bottomContainer__plan">
                <div class="bottomContainer__planItem">
                    <div class="bottomContainer__planImg bottomContainer__planImg_1"></div>
                    <div class="bottomContainer__subtitle">Укажите свои предпочтения в кухне</div>
                </div>
                <div class="bottomContainer__arr"></div>
                <div class="bottomContainer__planItem">
                    <div class="bottomContainer__planImg bottomContainer__planImg_2"></div>
                    <div class="bottomContainer__subtitle">Определите район</div>
                </div>
                <div class="bottomContainer__arr"></div>
                <div class="bottomContainer__planItem">
                    <div class="bottomContainer__planImg bottomContainer__planImg_3"></div>
                    <div class="bottomContainer__subtitle">Посмотрите анкеты кулинаров и меню</div>
                </div>
                <div class="bottomContainer__arr"></div>
                <div class="bottomContainer__planItem">
                    <div class="bottomContainer__planImg bottomContainer__planImg_4"></div>
                    <div class="bottomContainer__subtitle">Отправьте заявку, и кулинар свяжется с вами</div>
                </div>
            </div>
        </div>
    </div>
    <div class="spacer spacer_pt30"></div>
    <div class="appsBox inWrap">
        <h2 class="appsBox__title">Загрузи приложение</h2>
        <div class="apps">
            <a href="#" href="#" class="apps__logo">Логотип</a>
            <a href="#" href="#" class="apps__apple">Apple Store</a>
            <a href="#" href="#" class="apps__google">Google Store</a>
        </div>
    </div>
    <section class="g-mainSection middleBlog">
        <div class="bg_grey pb15 mb20">
            <section class="middleBlog__mainBox">
                <div class="mainSlider">
                    <h2 class="mainSlider__title">Популярные кулинары</h2>
                    <div class="mainSlider__container">
                        <div class="mainSlider__btn mainSlider__btn_prev js-left"></div>
                        <div class="mainSlider__wrap">
                            <ul class="mainSlider__list js-slideContainer">
                                <?php for ( $i=0; $i<7; $i++ ) { ?>
                                    <li class="mainSlider__item">
                                        <div class="mainSlider__bg">
                                            <img class="mainSlider__img" src="../../images/mainSlider__img.png" alt="">
                                        </div>
                                        <h3 class="mainSlider__heading">Роман Петрович</h3>
                                        <div class="mainSlider__box pl10 pr10 ptb10">
                                            <div class="spacer spacer_mb10"></div>
                                            <div class="mainSlider__tagsBox">
                                                <a href="#" class="g-link g-link_light mr5 mb10">Название кухни</a>
                                                <a href="#" class="g-link g-link_light mr5 mb10">Японская</a>
                                                <a href="#" class="g-link g-link_light mr5 mb10">Китайская</a>
                                                <a href="#" class="g-link g-link_light mr5 mb10">Европейская</a>
                                            </div>
                                            <div class="spacer spacer_mb10"></div>
                                            <div class="metroBox">
                                                <div class="metroIcon metroIcon_grey"></div>
                                                <div class="metroBox__name">Петровско-Разумовская</div>
                                            </div>
                                            <div class="mainSlider__text">г. Москва</div>
                                        </div>
                                        <a href="#" class="g-link g-link_bgOrange">Посмотреть меню</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="mainSlider__btn mainSlider__btn_next js-right"></div>
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>
