<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
use frontend\models\Pjax;


$this->title = 'Блог ' . $user->username;

$this->params['breadcrumbs'][] = ['label' => 'Блог ' . $user->username];


?>

<aside class="l-sidebar l-sidebar_left">
    <?= $this->render('left'.$user->usertype, [
        'user' => $user,
    ]) ?>
</aside>
<div class="g-flexMiddleChild middleWrapper s_blog_art_wrap js-changeView">
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
    <?php endif ?>

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

    <div class="middleWrapper__container middleWrapper__container_pb20 s_articles">
        <form action="" class="form">
            <div class="headerBox">
                <h1 class="headerBox__title">Статьи <?= $user->name ?></h1>
            </div>
            <div class="headerBox">
                <div class="linksBox">
                    <?= Html::a('Рецепты', ['page/view', 'sid' => '#'], ['class' => 'linksBox__item linksBox__item_mr10']) ?>
                    <?= Html::a('Статьи', ['page/view', 'sid' => '#'], ['class' => 'linksBox__item linksBox__item_mr10 active']) ?>
                    <?= Html::a('Видеоблог', ['page/view', 'sid' => '#'], ['class' => 'linksBox__item linksBox__item_m0']) ?>
                </div>
                <input class="g-input g-input_h35 g-input_black g-input_searchBlack g-input_w380 g-input_mr0" placeholder="Поиск по статьям ..." type="text">
            </div>
            <?php
                $count = 0; $tags = array(); $tag = array();
                foreach ($publication as $key => $articles):
                    if($articles->publicationtags):
                        foreach ($articles->publicationtags as $key => $articlestags):
                                $tags[$count] = $articlestags->header;
                                $count++;
                        endforeach;
                    endif;
                endforeach;
                $tag[0] = $tags[0];
                $count = 0;
                for ($i = 0; $i < count($tags); $i++){
                    $flag = true;
                    for ($j = 0; $j < count($tag); $j++){
                        if($tag[$j] == $tags[$i]){
                            $flag = false;
                        }
                    }
                    if($flag == true){
                        $count++;
                        $tag[$count] = $tags[$i];
                    }
                }
            ?>
            <?php if($tags): ?>
                <div class="tagsBox pb20">
                    <?php foreach ($tags as $key => $tag): ?>
                        <div class="tagsBox__tagWrap"><span class="tagsBox__text"><?= $tag ?></span></div>
                    <?php endforeach ?>
                </div>
            <?php endif; ?>
            <div class="sort pb0">
                <h3 class="sort__title">Сортировка:</h3>
                <a href="#" class="sort__item sort__item_bottom">По новизне</a>
            </div>
        </form>
    </div>
    <div class="spacer spacer_mb20"></div>
    <div class="headerBox headerBox_alingWidthEnd pr20 pt10">
        <div class="viewsBox">
            <div data-view="lines" class="viewsBox__item viewsBox__item_lines js-changeView__toggle"></div>
            <div data-view="squares" class="viewsBox__item viewsBox__item_squares active js-changeView__toggle"></div>
        </div>
    </div>
    <ul class="videoList ml20 s_search_inner s_blog_art">


        <ul data-view="lines" class="list linedList js-changeView__box section_w1090 s_main">
            <?php if ($publication): ?>
                <?php foreach ($publication as $key => $articles): ?>
                    <li class="list__item list__item_big list__item_ml0 list__innerWrapper_w100 list__item_mb30">

                        <div class="list__innerWrapper list__innerWrapper_w100 s_lined_items">
                            <div class="s_photo">
                                <a href="#" class="list__img list__img_b170">
                                    <img class="list__innerImg" src="<?= $articles->src ?>" alt="">
                                </a>
                                <div class="time time_bgGrey s_left">
                                    <div class="time__wrap">
                                        <div class="time__img"></div>
                                        <div class="time__counter">
                                            <div class="time__val">1</div>
                                            <div class="time__lbl">ч.</div>
                                            <div class="time__val">15</div>
                                            <div class="time__lbl">мин.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="g-cooker list__descr list__descr_wCalc170px">
                                <div class="g-cooker__header">
                                    <div class="list__leftBox"><?= $articles->header ?></div>
                                    <div class="list__rightBox">
                                        <a class="like" href="#">12</a>
                                        <div class="viewBox">123</div>
                                        <div>
                                            <div class="rateBox">
                                                <a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
                                                <a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
                                                <a href="#" class="rateBox__item rateBox__item_w4 js-rate"></a>
                                                <a href="#" class="rateBox__item js-rate"></a>
                                                <a href="#" class="rateBox__item js-rate"></a>
                                            </div>
                                            <div class="g-cooker__favoriteCount">0.6</div>
                                        </div>
                                        <div class="g-date g-date_b0">(<?= $articles->created_at ?>)</div>
                                    </div>
                                </div>
                                <div class="g-cooker__line g-cooker__line_bdb"></div>

                                <div>
                                    <div class="s_orange_arrow">
                                        <div class="s_clicker js-toggleLinedBox__toggle"></div>
                                    </div>
                                    <div class="s_txt_tgs js-toggleLinedBox__box">
                                        <p class="g-cooker__text"><?php echo substr($articles->text, 0, 755).'...' ?></p>
                                        <?php if($articles->publicationtags): ?>
                                            <div class="list__tools">
                                                <div class="list__tags pb10">
                                                    <?php foreach ($articles->publicationtags as $key => $articlestags): ?>
                                                        <div class="tag"><?= $articlestags->header ?></div>
                                                    <?php endforeach ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="time time_bgGrey s_right">
                                        <div class="time__wrap">
                                            <div class="time__img"></div>
                                            <div class="time__counter">
                                                <div class="time__val">1</div>
                                                <div class="time__lbl">ч.</div>
                                                <div class="time__val">15</div>
                                                <div class="time__lbl">мин.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </li>
                <?php endforeach ?>
            <?php endif; ?>
        </ul>
        <ul data-view="squares" class="squaredList js-changeView__box">
            <?php if ($publication): ?>
                <?php foreach ($publication as $key => $articles): ?>
                    <li class="squaredList__item">
                        <h4 class="squaredList__title"><?= $articles->header ?></h4>
                        <div class="g-date"><?= $articles->created_at ?></div>
                        <div class="squaredList__imgBox">
                            <img class="squaredList__img" src="<?= $articles->src ?>" alt="">
                            <?php if($articles->publicationtags): ?>
                                <div class="squaredList__tagsBox">
                                    <?php foreach ($articles->publicationtags as $key => $articlestags): ?>
                                        <div class="squaredList__tag"><?= $articlestags->header ?></div>
                                    <?php endforeach ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="tools tools_aw pt5">
                            <div class="tools__left">
                                <a class="like" href="#">12</a>
                                <div class="viewBox">12</div>
                                <div class="rateBox">
                                    <a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
                                    <a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
                                    <a href="#" class="rateBox__item rateBox__item_w4 js-rate"></a>
                                    <a href="#" class="rateBox__item js-rate"></a>
                                    <a href="#" class="rateBox__item js-rate"></a>
                                </div>
                                <div class="rateBoxCount">0.6</div>
                            </div>
                        </div>
                        <p class="squaredList__text pt10"><?php echo substr($articles->text, 0, 255).'...' ?></p>
                    </li>
                <?php endforeach ?>
            <?php endif; ?>
        </ul>


    </ul>
</div>
<aside class="l-sidebar l-sidebar_right">
    <?= $this->render('right', [
    ]) ?>
</aside>