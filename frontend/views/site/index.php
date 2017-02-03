<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::$app->name;

?>

<section class="mainTitle" style="background-image: url('<?= $mainpage->src ?>');">
    <section class="inWrap">
        <h1 class="mainTitle__h1"><?= $mainpage->header ?></h1>
    </section>
    <div class="mainTitle__darkBg">
        <section class="inWrap">
            <form action="<?= Url::to(['site/search', 'producttype' => 'dish']) ?>" class="wideSearch wideSearch_center" method="post" data-action="">
                <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                <div class="wideSearch__toggles">
                    <label class="wideSearch__lbl" for="lbl1" id="js_searchmain_labelRadioCook">
                        <input name="viewType" class="wideSearch__check" id="lbl1" type="radio" value="cook">
                        <div class="wideSearch__bgCheck wideSearch__bgCheck_dark wideSearch__bgCheck_darkCooker"></div>
                    </label>
                    <label class="wideSearch__lbl" for="lbl2" id="js_searchmain_labelRadioDish">
                        <input name="viewType" class="wideSearch__check" id="lbl2" type="radio" value="dish" checked="">
                        <div class="wideSearch__bgCheck wideSearch__bgCheck_dark wideSearch__bgCheck_darkDish"></div>
                    </label>
                </div>
                <div class="mainSearchBox" id="js_searchmain_searchbox">
                    <input name="searchquery" id="js_searchmain_searchquery" class="g-input g-input_h62 g-input_400px g-input_white" placeholder="Поиск по блюдам" type="search" />
                    <div class="mainSearchBox__spacer" id="js_searchmain_searchspacer"></div>
                    <div class="searchBox searchBox_m0" id="js_searchmain_searchselectbox">
                        <div class="searchBox__wrapper">
                            <label class="select_default select__onManePage">
                                <select name="dishtype_id">
                                    <option value="any">Все категории</option>
                                    <?php foreach ($dishtypes as $key => $dt): ?>
                                        <option value="<?= $dt->id ?>"><?= $dt->header ?></option>
                                    <?php endforeach ?>
                                </select>
                            </label>
                        </div>
                    </div>
                </div>
                <input class="mainSearchBox__submit" type="submit" value="Найти" />
            </form>
        </section>
    </div>
</section>
<div class="l-mainContainer l-mainContainer_mainPage">
    <div class="g-mainSection middleBlog middleBlog_top">
        <div class="inWrap">
            <div class="innerList">
                <h3 class="middleBlog__boxStatus">Сейчас готовится:</h3>
                <div class="innerList__leftBox">
                    <div class="middleBlog__boxTopLine">
                        <a class="middleBlog__topBox middleBlog__topBox_orange" href="<?= Url::to(['site/search', 'producttype' => 'dish']) ?>">
                            <h2 class="middleBlog__boxTitle">Домашняя кухня</h2>
                            <h3 class="middleBlog__boxDescription">Вы можете заказать еду у лучших поваров, которые готовят дома. Быстро и недорого!</h3>
                        </a>
                    </div>
                    <div class="middleBlog__boxBottomLine">
                        <div class="middleBlog__bottomBox">
                            <div class="middleBlog__bottomInnerBox">
                                <?php if ($productkitchen): ?>
                                    <div class="middleBlog__table">
                                        <a class="middleBlog__imgWrap" href="<?= Url::to(['site/userproduct', 'id' => $productkitchen->id]) ?>">
                                            <img class="middleBlog__img" src="<?= $productkitchen->productfoto->getSource('icon') ?>" alt="">
                                            <div class="time time_poaIn">
                                                <div class="time__wrap">
                                                    <div class="time__img"></div>
                                                    <div class="time__counter">
                                                        <?php $hours = floor($productkitchen->dish->timefrom/60) ?>
                                                        <?php $minutes = $productkitchen->dish->timefrom%60 ?>
                                                        <?php if ($hours>0): ?>
                                                            <div class="time__val"><?= $hours ?></div>
                                                            <div class="time__lbl">ч.</div>
                                                        <?php endif ?>
                                                        <div class="time__val"><?= $minutes ?></div>
                                                        <div class="time__lbl">мин.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="middleBlog__itemContent">
                                            <section class="middleBlog__topDescription">
                                                <a href="<?= Url::to(['site/userproduct', 'id' => $productkitchen->id]) ?>" class="middleBlog__itemTitle"><?= $productkitchen->header ?></a>
                                            </section>
                                            <div class="g-cooker g-cooker_bdb g-cooker_pl0 pt6 pb5">
                                                <div class="g-cooker__header">
                                                    <div class="rateBox">
                                                        <a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
                                                        <a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
                                                        <a href="#" class="rateBox__item rateBox__item_w4 js-rate"></a>
                                                        <a href="#" class="rateBox__item js-rate"></a>
                                                        <a href="#" class="rateBox__item js-rate"></a>
                                                    </div>
                                                </div>
                                                <div class="g-cooker__line"><a href="<?= Url::to(['site/userprofile', 'id' => $productkitchen->user->id]) ?>"><?= $productkitchen->user->username ?></a></div>
                                                <div class="g-cooker__line g-cooker__line_orange"><a href="<?= Url::to(['site/search', 'producttype' => 'dish', 'section' => $productkitchen->kitchens[0]->sid]) ?>"><?= $productkitchen->kitchens[0]->header ?> кухня</a></div>
                                            </div>
                                            <div class="priceBox pt8">
                                                <span class="priceBox__price"><?= $productkitchen->pricesale?$productkitchen->pricesale:$productkitchen->price ?></span><span class="priceBox__currency">&#8381;</span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <div class="middleBlog__moreSection" id="ajax_result_ptb_<?= $productkitchen->id ?>">
                                    <?php if ($productkitchen->isInBasket): ?>
                                        <?php echo $this->render('/site/basketed') ?>
                                    <?php else: ?>
                                        <a href="<?= Url::to(['site/basketadd', 'id' => $productkitchen->id]) ?>" class="g-link js_product_to_basket" data-ajaxresult="ajax_result_ptb_<?= $productkitchen->id ?>">Заказать</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="innerList__rightBox">
                    <div class="middleBlog__boxTopLine">
                        <a class="middleBlog__topBox middleBlog__topBox_green" href="<?= Url::to(['site/search', 'producttype' => 'diet']) ?>">
                            <h2 class="middleBlog__boxTitle">Диеты</h2>
                            <h3 class="middleBlog__boxDescription">Вы предерживаетесь особой диеты? Закажите ее прямо домой быстро и недорого!</h3>
                        </a>
                    </div>
                    <div class="middleBlog__boxBottomLine">
                        <div class="middleBlog__bottomBox">
                            <div class="middleBlog__bottomInnerBox middleBlog__bottomInnerBox_right">
                                <?php if ($productdiet): ?>
                                    <div class="middleBlog__table">
                                        <a class="middleBlog__imgWrap" href="<?= Url::to(['site/userproduct', 'id' => $productdiet->id]) ?>">
                                            <img class="middleBlog__img" src="<?= $productdiet->productfoto->getSource('icon') ?>" alt="">
                                            <div class="time time_poaIn">
                                                <div class="time__wrap">
                                                    <div class="time__img"></div>
                                                    <div class="time__counter">
                                                        <?php $hours = floor($productdiet->dish->timefrom/60) ?>
                                                        <?php $minutes = $productdiet->dish->timefrom%60 ?>
                                                        <?php if ($hours>0): ?>
                                                            <div class="time__val"><?= $hours ?></div>
                                                            <div class="time__lbl">ч.</div>
                                                        <?php endif ?>
                                                        <div class="time__val"><?= $minutes ?></div>
                                                        <div class="time__lbl">мин.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="middleBlog__itemContent">
                                            <section class="middleBlog__topDescription">
                                                <a href="<?= Url::to(['site/userproduct', 'id' => $productdiet->id]) ?>" class="middleBlog__itemTitle"><?= $productdiet->header ?></a>
                                            </section>
                                            <div class="g-cooker g-cooker_bdb g-cooker_pl0 pt6 pb5">
                                                <div class="g-cooker__header">
                                                    <div class="rateBox">
                                                        <a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
                                                        <a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
                                                        <a href="#" class="rateBox__item rateBox__item_w4 js-rate"></a>
                                                        <a href="#" class="rateBox__item js-rate"></a>
                                                        <a href="#" class="rateBox__item js-rate"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="g-cooker__line"><a href="<?= Url::to(['site/userprofile', 'id' => $productdiet->user->id]) ?>"><?= $productdiet->user->username ?></a></div>
                                            <div class="g-cooker__line g-cooker__line_orange"><a href="<?= Url::to(['site/search', 'producttype' => 'diet', 'section' => $productdiet->dish->diet->sid]) ?>"><?= $productdiet->dish->diet->header ?></a></div>
                                        </div>
                                        <div class="priceBox pt8">
                                            <span class="priceBox__price"><?= $productdiet->pricecurrent ?></span><span class="priceBox__currency">&#8381;</span>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <div class="middleBlog__moreSection" id="ajax_result_ptb_<?= $productdiet->id ?>">
                                    <?php if ($productdiet->isInBasket): ?>
                                        <?php echo $this->render('/site/basketed') ?>
                                    <?php else: ?>
                                        <a href="<?= Url::to(['site/basketadd', 'id' => $productdiet->id]) ?>" class="g-link js_product_to_basket" data-ajaxresult="ajax_result_ptb_<?= $productdiet->id ?>">Заказать</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="map">
        <h2 class="map__mainTitle">как это работает</h2>
        <div class="map__topContainer">
            <div class="map__topContainer">
                <div id="map_canvas" style="height: 420px; width: 840px"></div>

                <?php $this->registerJsFile('https://api-maps.yandex.ru/2.1/?lang=ru_RU', ['depends' => [frontend\assets\MainAsset::className()]]); ?>
                <?php //$this->registerJsFile('/js/ycmap.js', ['depends' => [frontend\assets\MainAsset::className()]]); ?>
                <?php //$this->registerJsFile('/js/mainpagemap.js', ['depends' => [frontend\assets\MainAsset::className()]]); ?>
                <?php $this->registerJsFile('/js/ycmap21.js', ['depends' => [frontend\assets\MainAsset::className()]]); ?>
                <?php $this->registerJsFile('/js/mainpagemap21.js', ['depends' => [frontend\assets\MainAsset::className()]]); ?>

                <div class="map__lists">
                    <div class="map__list map__list_1">Отметиться на карте</div>
                    <div class="map__list map__list_2">Выберите кухню или блюдо</div>
                    <div class="map__list map__list_3">Свяжитесь с кулинаром</div>
                </div>
                <div class="map__banner">
                    <div class="map__img" id="js_searchmain_popupvideoshow"></div>
                </div>
            </div>
        </div>
        <section class="map__bottomContainer">
            <div class="inWrap">
                <h2 class="map__title">Укажи свой адрес и выбирай блюда рядом</h2>
                <form action="<?= Url::to(['site/search', 'producttype' => 'dish']) ?>" method="post">
                    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                    <div class="map__searchParams">
                        <input name="searchquery" class="g-input g-input_300px g-input_h55" type="text" placeholder="Адрес">
                        <div class="searchBox searchBox_m0">
                            <div class="searchBox__wrapper searchBox__wrapper_mr20 searchBox__wrapper_h55">
                                <input type="hidden" class="js-hidden_input" />
                                <input type="text" class="g-input g-input_mr0 g-input_300px g-input_h55 js-input_searchBox" placeholder="Метро" />
                                <div class="searchBox__select searchBox__select_r10px js-searchBox__arr">Выбрать</div>
                                <ul class="searchBox__list">
                                    <li data-value="1" class="searchBox__listItem">Петровско-Разумовская</li>
                                    <li data-value="2" class="searchBox__listItem">Петровско-Разумовская</li>
                                    <li data-value="3" class="searchBox__listItem">Петровско-Разумовская</li>
                                    <li data-value="4" class="searchBox__listItem">Петровско-Разумовская</li>
                                </ul>
                            </div>
                        </div>
                        <input class="map__submit" type="submit" value="Продолжить" />
                    </div>
                </form>
            </div>
        </section>
    </div>
    <div class="popup" id="js_searchmain_popupvideo">
        <div class="popup__wrap">
            <div class="popup__exit" id="js_searchmain_popupvideoclose">Выход</div>
            <div class="popup__mainWrap">
                <a href="https://www.youtube.com/embed/Kr9-BKK7CKY" class="popup__video">
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/Kr9-BKK7CKY" frameborder="0" allowfullscreen></iframe>
                </a>
            </div>
        </div>
    </div>
    <section class="g-mainSection middleBlog">
        <div class="bg_grey pb15 mb20">
            <section class="inWrap">
                <div class="mainSlider">
                    <h2 class="mainSlider__title">Популярные кулинары</h2>
                    <div class="mainSlider__container">
                        <div class="mainSlider__btn mainSlider__btn_prev js-left"></div>
                        <div class="mainSlider__wrap">
                            <ul class="mainSlider__list js-slideContainer">
                                <?php foreach ($popularCook as $key => $pc): ?>
                                    <li class="mainSlider__item">
                                        <div class="mainSlider__bg">
                                            <a href="<?= Url::to(['site/userprofile', 'id' => $pc->id]) ?>"><img class="mainSlider__img" src="<?= $pc->getIconsrc('icon') ?>" alt=""></a>
                                        </div>
                                        <a href="<?= Url::to(['site/userprofile', 'id' => $pc->id]) ?>" class="mainSlider__heading"><?= $pc->username ?></a>

                                        <div class="rateBox">
                                            <a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
                                            <a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
                                            <a href="#" class="rateBox__item rateBox__item_w4 js-rate"></a>
                                            <a href="#" class="rateBox__item js-rate"></a>
                                            <a href="#" class="rateBox__item js-rate"></a>
                                        </div>

                                        <div class="mainSlider__box pl10 pr10 ptb10">
                                            <div class="spacer spacer_mb10"></div>

                                            <div class="mainSlider__tagsBox">
                                                <?php if ($pc->kitchenCook): ?>
                                                    <?php foreach ($pc->kitchenCook as $key => $kc): ?>
                                                        <?php if ($key > 3): ?>
                                                            <?php break; ?>
                                                        <?php endif ?>
                                                        <a href="<?= Url::to(['site/usermenu', 'id' => $pc->id]) ?>" class="g-link g-link_light mr5 mb10"><?= $kc->header ?></a>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                            </div>

                                            <div class="spacer spacer_mb10"></div>
                                            <div class="metroBox">
                                                <div class="metroIcon metroIcon_grey"></div>
                                                <div class="metroBox__name">Петровско-Разумовская</div>
                                            </div>
                                            <div class="mainSlider__text">г. Москва</div>
                                        </div>
                                        <a href="<?= Url::to(['site/usermenu', 'id' => $pc->id]) ?>" class="g-link g-link_bgOrange">Посмотреть меню</a>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <div id="js_searchmain_sliderright" class="mainSlider__btn mainSlider__btn_next js-right"></div>
                    </div>
                </div>
            </section>
        </div>
        <?php echo count($kitchens); ?>
        <div class="bigBox">
            <div class="bigBox__leftBox js-toggeTableCol__col">
                <div class="bigBox__heading bigBox__heading_bgOrange js-toggeTableCol__header_left">
                    <h2 class="bigBox__title">Домашняя кухня</h2>
                    <div class="bigBox__arr bigBox__arr_orange"></div>
                </div>
                <div class="bigBox__body">
                    <?php $i = 0; ?>
                    <?php foreach ($kitchens as $key => $k): ?>
                        <a class="bigBox__link js-toggeTableCol__elem_left" style="background-image: url('/images/mainSlider__bg.png')" href="<?= Url::to(['site/search', 'producttype' => 'dish', 'section' => $k->sid]) ?>">
                            <span class="bigBox__bg"></span>
                            <span class="bigBox__text"><?= $k->header ?> кухня</span>
                        </a>
                        <?php $i++; ?>
                    <?php endforeach ?>
                    <a class="bigBox__link js-toggeTableCol__elem_left" style="background-image: url('/images/mainSlider__bg.png')" href="<?= Url::to(['site/search', 'producttype' => 'dish']) ?>">
                        <span class="bigBox__bg"></span>
                        <span class="bigBox__text">Посмотреть все категории</span>
                    </a>
                    <?php if (count($kitchens)%2 === 0): ?>
                        <a class="bigBox__link js-toggeTableCol__elem_left" style="background-image: url('/images/mainSlider__bg.png')" href="<?= Url::to(['site/search', 'producttype' => 'dish']) ?>">
                            <span class="bigBox__bg"></span>
                            <span class="bigBox__text">Домашняя кухня</span>
                        </a>
                    <?php endif ?>
                </div>
            </div>
            <div class="bigBox__rightBox js-toggeTableCol__col">
                <div class="bigBox__heading bigBox__heading_bgGreen bigBox__heading_w50 js-toggeTableCol__header_right">
                    <h2 class="bigBox__title">Диеты</h2>
                    <div class="bigBox__arr bigBox__arr_green"></div>
                </div>
                <div class="bigBox__body">
                    <div class="bigBox__body">
                        <?php $j = 0; ?>
                        <?php foreach ($diets as $key => $d): ?>
                            <a class="bigBox__link bigBox__link_bdl2" style="background-image: url('/images/mainSlider__bg.png')" href="<?= Url::to(['site/search', 'producttype' => 'diet', 'section' => $d->sid]) ?>">
                                <span class="bigBox__text"><?= $d->header ?></span>
                                <span class="bigBox__bg"></span>
                            </a>
                            <?php $j++; ?>
                            <?php if($i == $j){ break; }?>
                        <?php endforeach ?>
                        <a class="bigBox__link bigBox__link_bdl2" style="background-image: url('/images/mainSlider__bg.png')" href="<?= Url::to(['site/search', 'producttype' => 'diet']) ?>">
                            <span class="bigBox__text">Посмотреть все категории</span>
                            <span class="bigBox__bg"></span>
                        </a>
                        <?php if (count($diets)%2 === 0): ?>
                            <a class="bigBox__link bigBox__link_bdl2" style="background-image: url('/images/mainSlider__bg.png')" href="<?= Url::to(['site/search', 'producttype' => 'diet']) ?>">
                                <span class="bigBox__bg"></span>
                                <span class="bigBox__text">Посмотреть все категории</span>
                            </a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <div style="clear:both"></div>
        <div class="middleBlog__textWrap">
            <h2 class="hotText">КТО МЫ</h2>
            <div class="middleBlog__text">
                <p>COOKERYONE — кулинарный портал для тех, кто обожает готовить и тех, кто любит вкусно покушать. COOKERYONE — это площадка для ценителей качественной еды. Здесь найдет свой интерес профессиональный повар, домохозяйка, кулинар-любитель, сладкоежка и даже тот, кто сидит на диете или придерживается определенного стиля питания.</p>
                <p>Что предлагает кулинарный портал:</p>
                <ul>
                    <li>Домашняя кухня на заказ;</li>
                    <li>Комплексные обеды;</li>
                    <li>Повар на заказ;</li>
                    <li>Кулинарные рецепты;</li>
                    <li>Диетическое питание;</li>
                    <li>Круглосуточная доставка блюд (предусмотрена доставка на дом и доставка в офис);</li>
                    <li>Огромный информационный пул по правильному и вкусному питанию;</li>
                    <li>Форум обсуждений.</li>
                </ul>

                <h2 class="middleBlog__title middleBlog__title_fz20 middleBlog__title_colorMain middleBlog__title_pb20">Заказ домашней еды из первых рук</h2>
                <p>Вы предпочитаете домашнюю кухню, но у Вас совсем нет времени на готовку? Тогда наш кулинарный портал приятно Вас удивит. На COOKERYONE Вы встретите шедевры домашней кулинарии. У Вас есть возможность заказать еду по лучшим домашним рецептам. На нашем портале Вы всегда сможете найти любые домашние блюда, а также заказать комплексный обед.</p>
                <p>Как это происходит? На COOKERYONE регистрируются повара, люди, которые любят готовить и хотят поделиться своими вкусными рецептами домашних блюд, а также просто любители кулинарии. На персональной странице повара Вы можете ознакомиться с его опытом работы и блюдами, которые он предлагает Вам попробовать.</p>
                <p>Возможно, Вам захотелось жаренной картошечки с хрустящей корочкой в масле, как в детстве. Выбирайте повара, оставляйте заказ, и в скором времени домашнее блюдо будет Вам доставлено из первых рук. Чтобы блюдо попало к Вам горячим, мы предусмотрели удобный инструментарий. На карте Вы можете выбрать исполнителя, который находится ближе всего к Вашему дому или офису.</p>
                <p>Вы можете выбрать способ получения заказа:</p>
                <ul>
                    <li>доставка еды на дом;</li>
                    <li>доставка еды в офис;</li>
                    <li>самовывоз.</li>
                </ul>
                <p>Помимо доставки готовых блюд Вы можете воспользоваться услугой «заказ повара». Вкусная домашняя кухня и изысканная кулинария порадует гостей любого мероприятия.</p>
                <h2 class="middleBlog__title middleBlog__title_fz20 middleBlog__title_colorMain middleBlog__title_pb20">Диетические блюда на заказ</h2>
                <p>Сегодня в моде правильное питание. Специально для любителей разного рода диет мы создали раздел «Диетическое питание». Выбирайте диету по душе, ищите соратников, обсуждайте любимые рецепты и заказывайте обеды.</p>
                <p>Популярные системы питания сегодня:</p>
                <ul>
                    <li>Диета Пьера Дюкана;</li>
                    <li>Детокс-питание;</li>
                    <li>Вегетарианство;</li>
                    <li>Сыроедение;</li>
                    <li>Палео диета;</li>
                    <li>И многое другое. </li>
                </ul>
                <p>Вы можете заказать обед в любое время суток, при этом неважно, какую систему питания Вы предпочитаете. На COOKERYONE обязательно найдется повар, который приготовит кулинарный шедевр по необходимому Вам рецепту.</p>
                <p>Если Вы только хотите начать правильно питаться, то COOKERYONE станет отличным помощников в выборе программы питания. На сайте Вы сможете проконсультироваться о полезности той или иной диеты с теми, кто уже испробовал ее на себе и получил результат. Также Вы сможете узнать преимущества и недостатки диетического питания. Определитесь для каких целей Вам нужна диета (похудение, коррекция здоровье и так далее) и ищете в наших информационных разделах подходящее меню на каждый день.</p>
                <h2 class="middleBlog__title middleBlog__title_fz20 middleBlog__title_colorMain middleBlog__title_pb20">Кулинарная энциклопедия</h2>
                <p>COOKERYONE — это не просто кулинарный портал для заказа домашней еды, но и целая энциклопедия вкусных рецептов. Портал представляет собой форум для тех, кто любит готовить и есть домашнюю еду.</p>
                <p>Портал собрал большую информационную базу для своих пользователей. Мы постоянно готовим для Вас интересный контент с рецептами, методиками приготовления еды, интервью с лучшими поварами. Вы так же можете делиться своими рецептами с другими на просторах COOKERYONE.</p>

            </div>
        </div>
    </section>
    <div class="bg_grey mt20 mb20">
        <div class="appsBox inWrap">
            <h2 class="appsBox__title">Загрузи приложение</h2>
            <div class="apps">
                <a href="#" href="#" class="apps__logo">Логотип</a>
                <a href="#" href="#" class="apps__apple">Apple Store</a>
                <a href="#" href="#" class="apps__google">Google Store</a>
            </div>
        </div>
    </div>
</div>
