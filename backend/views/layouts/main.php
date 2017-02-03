<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Панель администрирования',
        'brandUrl' => Yii::$app->homeUrl,
        'innerContainerOptions' => ['class'=>'container-fluid'],
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Главная', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid" style="padding: 70px 15px 20px">
    <!-- <div class="container"> -->
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?php
        $this->params['sideBarItems'] = [
            'user'         => 'Пользователи (Кулинары и покупатели)',
            'profile-cook' => 'Профили кулинаров',
            'profile-user' => 'Профили покупателей',
            'album'        => 'Альбомы',
            'foto'         => 'Фото',
            'video'        => 'Видео',
            'address'      => 'Адреса',
            'phonenumber'  => 'Номера телефонов',
            'publication'  => 'Публикации',
            'recall'       => 'Отзывы покупателей',
            'message'      => 'Сообщения',
            'notice'       => 'Уведомления',
            'action'       => 'Акция?',
            'Товары'       => 'separator',
            'product'      => 'Товары (Блюдо или Набор)',
            'dish'         => 'Блюда',
            'dishmode'     => 'Виды блюд (Диеты/Домашняя.)',
            'dishtype'     => 'Тип блюда (Первое, второе, компот)',
            'dishset'      => 'Наборы блюд',
            'kitchen'      => 'Кухни',
            'diet'         => 'Диеты',
            'Заказы'       => 'separator',
            'order'        => 'Заказы',
            'discussion'   => 'Обсуждения',
            'Новости'      => 'separator',
            'news'         => 'Новости (новости портала)',
            'news-tag'     => 'Новостные теги',
            'Страницы'     => 'separator',
            'mainpage'     => 'Главная страница',
            'partner'      => 'Партнеры проекта',
            'page'         => 'Страницы',
        ];
        ?>
        <div class="row">
            <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3 sidebar">

<?php $i = 0; ?>
<div id="sideBarItems">
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title" data-toggle="collapse" data-target="#sideBarItems<?= $i ?>" data-parent="#sideBarItems">Пользователи</h3>
    </div>
    <div class="list-group collapse" id="sideBarItems<?= $i ?>">

                <?php foreach ($this->params['sideBarItems'] as $key => $value): ?>
                    <?php if ($value==='separator'): ?>
                    <?php $i++; ?>

    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title" data-toggle="collapse" data-target="#sideBarItems<?= $i ?>" data-parent="#sideBarItems"><?= $key ?></h3>
    </div>
    <div class="list-group collapse" id="sideBarItems<?= $i ?>">

                    <?php else: ?>

                            <a href="<?= Url::to([$key.'/index']) ?>" class="list-group-item<?= (isset($this->context->id)&&($this->context->id===$key))?' active':'' ?>"><?= $value ?></a>

                    <?php endif ?>
                <?php endforeach ?>

    </div>
</div>
</div>



            </div>
            <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">

            <?= $content ?>

            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; CookeryOne <?= date('Y') ?></p>

        <p class="pull-right"></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
