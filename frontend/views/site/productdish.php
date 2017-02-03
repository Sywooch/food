<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

$this->params['breadcrumbs'][] = ['label' => 'Профиль ' . $user->username, 'url' => ['site/userprofile', 'id' => $user->id], 'class' => 'breadcrumbs__link'];

$this->params['breadcrumbs'][] = ['label' => 'Меню', 'url' => ['site/usermenu', 'id' => $user->id], 'class' => 'breadcrumbs__link'];

$this->params['breadcrumbs'][] = ['label' => $product->header];

$this->title = $product->header;

?>

<aside class="l-sidebar l-sidebar_left">

	<?= $this->render('leftcook', [
		'user' => $user,
	]) ?>

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






						<div class="middleWrapper__container">
							<div class="headerBox">
								<h2 class="headerBox__title">Карточка блюда</h2>
							</div>
						</div>
						<div class="form__border"></div>
						<h4 class="form__header">Общая информация</h4>
							<div class="form__section">
								<div class="form__colWrapper">
									<div class="form__leftCol form__leftCol_w65">
										<div class="dishCard">
											<div class="dishCard__imgWrap">
												<img class="dishCard__img dishCard__img_main" src="<?= $product->productfoto->getSource('list') ?>" />
											</div>
											<div class="dishCard__preview">
												<?php foreach ($product->productfotos as $key => $pf): ?>
													<?php if ($key>2): ?>
														<?php continue; ?>
													<?php endif ?>
													<img class="dishCard__img" src="<?= $pf->getSource('icon') ?>" />
												<?php endforeach ?>
												<!-- <img class="dishCard__img" src="/images/pizza.png" />
												<img class="dishCard__img" src="/images/pizza.png" /> -->
												<div class="dishCard__arrsBox" style="display: none;">
													<div class="dishCard__arr dishCard__arr_next"></div>
													<div class="dishCard__arr dishCard__arr_prev"></div>
												</div>
											</div>
											<div class="dishCard__info">
												<h3 class="dishCard__heading"><?= $product->header ?></h3>
												<div class="dishCard__line">
													<div class="dishCard__lbl">Кухня:</div>
													<div class="dishCard__val"><?= lcfirst($product->kitchens[0]->header) ?></div>
												</div>
												<div class="dishCard__line">
													<div class="dishCard__lbl">Вес:</div>
													<div class="dishCard__val"><?= $dish->weight ?> г.</div>
												</div>
												<div class="dishCard__line">
													<div class="dishCard__lbl">Время приготовления:</div>
													<div class="dishCard__val"><?= $dish->timefrom ?>-<?= $dish->timeto ?> мин</div>
												</div>
												<div class="dishCard__line">
													<div class="dishCard__lbl">Описание:</div>
													<div class="dishCard__val"><?= nl2br(Html::encode($dish->text)) ?></div>
												</div>
											</div>
										</div>
									</div>
									<div class="form__rightCol form__rightCol_w35 form__rightCol_aCol">
										<div>
											<div class="toolsBox toolsBox_mb30">
												<div class="toolsBox__item">
													<div class="toolsBox__count toolsBox__count_orange">258</div>
													<div class="toolsBox__name">Понравилось</div>
												</div>
											</div>
											<div class="priceBox">
												<span class="priceBox__price"><?= round($product->price) ?></span>
												<span class="priceBox__currency">₽</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form__border"></div>
							<h4 class="form__header">Ингридиенты</h4>
							<div class="form__section form__section_pl30">
								<div class="form__line section_810">
									<div class="lineTable">

										<div class="lineTable__row">
											<div class="lineTable__cell lineTable__cell_orange">Молоко</div>
											<div class="lineTable__cell">Лианозовское</div>
										</div>

									</div>
								</div>
							</div>
							<?php if ($dish->diet_id): ?>
								<div class="form__border"></div>
								<h4 class="form__header">Информация, для меню "Диеты"</h4>
								<div class="form__section form__section_pl30">
									<div class="form__line section_810">
										<label for="" class="form__label form__label_min">Энергетическая ценность на порцию: <?= $dish->calories ?></label>
										<label for="" class="form__label form__label_min">Белки: <?= $dish->proteins ?></label>
										<label for="" class="form__label form__label_min">Жиры: <?= $dish->fats ?></label>
										<label for="" class="form__label form__label_min">Углеводы: <?= $dish->carbohydrates ?></label>
									</div>
								</div>

							<?php endif ?>
							<?php if ($product->dish->video): ?>
								<div class="form__border"></div>
								<h4 class="form__header">Видеопрезентация блюда</h4>
								<div class="form__section">
									<div class="form__line form__line_pl30 section_810">
										<ul class="video">
											<li class="blog__item section_500">
												<a class="videoBox videoBox_h280 videoBox_mb15" href="#">
													<iframe src="<?= $product->dish->video ?>" allowfullscreen="" width="100%" height="100%" frameborder="0"></iframe>
												</a>
											</li>
										</ul>
									</div>
								</div>
							<?php endif ?>
							<div class="form__border"></div>
							<div class="form__section">
								<div class="form__line form__line_center">
									<a href="<?= Url::to(['site/basketadd', 'id' => $product->id]) ?>" class="g-link g-link_big">В корзину</a>
								</div>
							</div>














</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('right', [
	]) ?>

</aside>