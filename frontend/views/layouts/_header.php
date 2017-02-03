<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<header class="header">
	<div class="header__outerWrapper g-mainSection">
		<div class="inWrap inWrap_awc js-toggleBlog__parent">
			<a class="header__logo" href="/">Logo</a>
			<div class="header__hidden">
				<div class="header__toggle js-toggleBlog__toggle"></div>
			</div>

			<nav class="header__nav js-toggleBlog__box">
				<ul>
					<li class="header__item">
						<?= Html::a('Поиск блюд', ['site/search'], ['class' => 'header__link']) ?>
					</li>
					<li class="header__item">
						<?= Html::a('О портале', ['page/view', 'sid' => 'about'], ['class' => 'header__link']) ?>
					</li>
					<li class="header__item">
						<?= Html::a('Кулинарам', ['page/view', 'sid' => 'cook'], ['class' => 'header__link']) ?>
					</li>
					<li class="header__item">
						<?= Html::a('Блоги', ['site/blogs'], ['class' => 'header__link']) ?>
					</li>
					<li class="header__item">
						<?= Html::a('Акции', ['actions/index'], ['class' => 'header__link']) ?>
					</li>
					<li class="header__item">
						<?= Html::a('Новости', ['news/list'], ['class' => 'header__link']) ?>
					</li>
				</ul>
			</nav>
			<div class="header__account">
				<form class="orderStatus" action="">
					<label class="checkBox mr10">
						<input type="checkbox" class="checkBox__input js-showOrderStatus__toggle" />
						<div class="checkBox__bg"></div>
					</label>
					<div class="orderStatus__text orderStatus__text_grey js-showOrderStatus__false">Не принимаю заказы</div>
					<div class="orderStatus__text orderStatus__text_green js-showOrderStatus__true">Принимаю заказы</div>
				</form>
				<a class="header__busket" href="<?= Url::to(['site/basket']) ?>">
					<?php
						$session = Yii::$app->session;
						if (!$session->isActive) {
							$session->open();
						}
					?>
					<?php if (isset($session['basket'])&&count($session['basket'])): ?>
						<span class="g-count g-count_buy">
							<span class="g-count__val"><?= count($session['basket']) ?></span>
						</span>
					<?php endif ?>
					Корзина
				</a>
				<?php if (Yii::$app->user->isGuest): ?>
					<?= Html::a('Регистрация', ['site/signup'], ['class' => 'header__registration']) ?>
					<?= Html::a('Вход', ['site/login'], ['class' => 'header__signIn']) ?>
				<?php else: ?>
					<?php $user = Yii::$app->user->identity; ?>
					<a class="faceBox faceBox_50 mr15" href="<?= Url::to(['user/profile']) ?>">
						<span class="faceBox__status active"></span>
						<span class="faceBox__person"></span>
						<span href="#" class="faceBox__img">
							<img class="faceBox__innerImg" src="<?= $user->getIconsrc('icon'); ?>" alt="" />
						</span>
					</a>
					<?= Html::a(Yii::$app->user->identity->username, ['user/profile'], ['class' => 'header__profile']) ?>
					<?= Html::a('Выход', ['site/logout'], ['class' => 'header__logOut']) ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</header>