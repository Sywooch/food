<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

$this->title = 'Блоги';
$this->params['breadcrumbs'][] = $this->title;


?>
<aside class="l-sidebar l-sidebar_left">
    <?= $this->render('left') ?>
</aside>
<?php if (Yii::$app->user->identity): ?>
    <div class="menuTop">
        <ul class="menuTop__tabs">
            <li class="menuTop__item"><a class="menuTop__link" href="#">Уведомления</a></li>
            <li class="menuTop__item"><a class="menuTop__link" href="#">Сообщения<span class="g-count"><span class="g-count__val">99</span></span></a></li>
            <li class="menuTop__item"><a class="menuTop__link" href="#">Отзывы</a></li>
            <li class="menuTop__item"><a class="menuTop__link" href="#">Заказы</a></li>
            <li class="menuTop__item"><a class="menuTop__link" href="#">Рейтинг</a></li>
        </ul>
        <div class="menuTop__links">
            <a href="#" class="g-link g-link_orange g-link_colOrange g-link_mr20">Добавить фото</a>
            <a href="#" class="g-link g-link_mr20">Сменить пароль</a>
            <a href="#" class="g-link g-link_edit g-link_mr30 g-link_pr35">Редактировать профиль</a>
        </div>
    </div>

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
<?php endif ?>

<div class="middleWrapper__container">

    <div class="headerBox">
        <h1 class="headerBox__title">Блог</h1>
        <a href="#" class="g-link">Подписаться на статьи</a>
    </div>

    <div class="sort">
        <h3 class="sort__title">Сортировка:</h3>
        <a href="#" class="sort__item sort__item_bottom">По новизне</a>
    </div>

    <ul class="blog">
        <?php foreach ($blogs as $key => $b): ?>
        <li class="blog__item section_810">
            <div class="blog__lineBox ">
                <h3 class="blog__header"><?= $b->header ?></h3>
                <div class="g-cooker__favorite"></div>
            </div>
            <h4 class="blog__line"><?= date('Y-m-d',strtotime($b->created_at)) ?></h4>
            <img class="blog__img" src="<?= $b->getSource('full') ?>" alt="" />
            <?php if($b->publicationtags): ?>
                <div class="blog__tagsBox">
                    <?php foreach ($b->publicationtags as $key => $pt): ?>
                        <div class="blog__tag"><?= $pt->header ?></div>
                    <?php endforeach ?>
                </div>
            <? endif; ?>
            <p class="blog__text"><?= $b->shorttext ?></p>
            <div class="blog__lineBox blog__lineBox_pb20">
                <a href="#" class="g-link">Подробнее</a>
            </div>
            <div class="blog__border"></div>
        </li>
        <?= LinkPager::widget(['pagination' => $pagination,]); ?>
    </ul>
</div>

<aside class="l-sidebar l-sidebar_right">
    <?= $this->render('right') ?>
</aside>