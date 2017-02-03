


<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

$this->params['breadcrumbs'][] = ['label' => 'Профиль'];

$this->title = 'Профиль';

?>

<aside class="l-sidebar l-sidebar_left">

	<?= $this->render('left'.$user->usertype, [
	]) ?>

</aside>
<div class="g-flexMiddleChild middleWrapper">

	<div class="menuTop">

		<?= $this->render('top-menu-'.$user->usertype, [
			'user' => $user,
		]) ?>

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





						<div class="middleWrapper__container">

							<div class="headerBox">
								<h1 class="headerBox__title">Все отзывы</h1>
							</div>

							<div class="sort">
								<h3 class="sort__title">Сортировка:</h3>
								<a href="#" class="sort__item sort__item_bottom">По новизне</a>
								<a href="#" class="sort__item sort__item_top">По рейтингу</a>
							</div>
							
							<div class="review">





<ul class="section_810 section_dib">
	<li class="list__item list__item_big list__item_ml0 list__innerWrapper_w100">
		<div class="list__innerWrapper list__innerWrapper_w100">
			<a href="#" class="list__img">
				<img class="list__innerImg" src="../../images/cooker.png" alt="">
				<span class="list__status list__status_active"></span>
			</a>
			<div class="g-cooker list__descr list__descr_wCalc90px">
				<div class="g-cooker__header">
					<div class="g-date">15.15.16</div>
					<div class="list__rightBox">
						<div class="g-cooker__favorite"></div>
						<div class="g-cooker__favoriteCount">0.6</div>
						<div class="g-date g-date_b0">15.15.16</div>
					</div>
				</div>
				<div class="g-cooker__line g-cooker__line_wide">
					<div class="g-cooker__lineCont">Иван Поварешкин</div>
					<a href="#" class="g-cooker__lineCont g-cooker__lineCont_link">Как рассчитывается рейтинг</a>
				</div>
				<div class="g-cooker__line g-cooker__line_bdb"></div>
				<p class="g-cooker__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur cupiditate neque corporis numquam delectus magnam ab, earum perferendis eos sed porro voluptas, alias quidem nobis et quisquam hic animi maiores. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus inventore alias animi qui, quas ut repellendus dolore fuga consequatur dolor ipsa porro, quae perferendis a aliquam ullam repellat facere. Fuga.</p>
				<a href="#" class="g-link">Ответить</a>
				<div class="list__innerWrapper list__innerWrapper_w100 list__innerWrapper_reply">
					<a href="#" class="list__img">
						<img class="list__innerImg" src="../../images/cooker.png" alt="">
						<span class="list__status"></span>
					</a>
					<div class="g-cooker list__descr list__descr_wCalc90px list__descr_reply">
						<div class="g-cooker__header">
							<div class="g-date">15.15.16</div>
							<div class="list__rightBox">
								<div class="g-cooker__favorite"></div>
								<div class="g-cooker__favoriteCount">0.6</div>
								<div class="g-date g-date_b0">15.15.16</div>
							</div>
						</div>
						<div class="g-cooker__line g-cooker__line_wide">
							<div class="g-cooker__lineCont">Иван Поварешкин</div>
							<a href="#" class="g-cooker__lineCont g-cooker__lineCont_link">Как рассчитывается рейтинг</a>
						</div>
						<div class="g-cooker__line g-cooker__line_bdb"></div>
						<p class="g-cooker__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur cupiditate neque corporis numquam delectus magnam ab, earum perferendis eos sed porro voluptas, alias quidem nobis et quisquam hic animi maiores. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus inventore alias animi qui, quas ut repellendus dolore fuga consequatur dolor ipsa porro, quae perferendis a aliquam ullam repellat facere. Fuga.</p>
						<a href="#" class="g-link">Ответить</a>
					</div>
				</div>
			</div>
		</div>
	</li>
</ul>





								


								<div class="rightCol">
									<h3 class="rightCol__title">Показать отзывы с оценкой:</h3>

									<?php for ($i=0; $i < 5 ; $i++) { ?>

									<div class="rightCol__line">
										<div class="g-cooker__favorite"></div>
										<div class="rightCol__center">81%</div>
										<div class="rightCol__right">114 отзывов</div>
									</div>

									<?php }	?>

									<a href="#" class="rightCol__link">Все отзывы</a>
								</div>
							</div>
						</div>







</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('/site/right', [
	]) ?>

</aside>