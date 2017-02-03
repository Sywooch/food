<?php 

use yii\helpers\Html;
use yii\helpers\Url;

use common\models\Partner;

$partners = Partner::find()
	->where(['show' => 1])
	->all();

?>
<footer class="footer">
	<nav class="footer__containter footer__containter_orange footer__containter_cols">
		<div class="inWrap">
			<ul class="footer__line footer__line_cols g-mainSection">
				<li class="footer__item">
					<?= Html::a('Поиск блюд', ['site/search', 'producttype' => 'dish'], ['class' => 'footer__link']) ?>
				</li>
				<li class="footer__item">
					<?= Html::a('О портале', ['page/view', 'sid' => 'about'], ['class' => 'footer__link']) ?>
				</li>
				<li class="footer__item">
					<?= Html::a('Кулинарам', ['page/view', 'sid' => 'cook'], ['class' => 'footer__link']) ?>
				</li>
				<li class="footer__item">
					<?= Html::a('Блоги', ['site/blogs'], ['class' => 'footer__link']) ?>
				</li>
				<li class="footer__item">
					<?= Html::a('Новости', ['news/list'], ['class' => 'footer__link']) ?>
				</li>
				<li class="footer__item">
					<?= Html::a('Акции', ['actions/index'], ['class' => 'footer__link']) ?>
				</li>
				<li class="footer__item">
					<a class="footer__link" href="#">Общие вопросы</a>
				</li>
				<li class="footer__item">
					<a class="footer__link" href="#">Помощь</a>
				</li>
			</ul>
			<ul class="footer__line footer__line_cols footer__line_sm g-mainSection">
				<?php if ($identity = Yii::$app->user->identity): ?>
					<li class="footer__item"><a class="footer__link" href="<?= Url::to(['site/userprofile', 'id' => $identity->id]) ?>">Мой кабинет</a></li>
				<?php endif ?>
				<li class="footer__item"><a class="footer__link" href="#">Реклама</a></li>
				<li class="footer__item"><a class="footer__link" href="#">Обратная связь</a></li>
				<li class="footer__item"><a class="footer__link" href="#">Сообщить об ошибке</a></li>
			</ul>
		</div>
	</nav>
	<div class="footer__containter footer__containter_small footer__containter_bordered">
		<div class="inWrap">
			<ul class="footer__line g-mainSection">
				<li class="footer__item footer__item_big footer__item_heading"><h4 class="footer__text footer__text_robotoCondensed">Наши партнёры:</h4></li>
				<?php foreach ($partners as $key => $p): ?>
					<li class="footer__item footer__item_big">
						<a class="footer__link footer__link_logo" href="<?= $p->href ?>" style="background-image: url('<?= $p->iconsrc ?>');"><?= $p->header ?></a>
					</li>
				<?php endforeach ?>
			</ul>
		</div>
	</div>
	<div class="footer__containter footer__containter_bordered">
		<div class="inWrap">
			<ul class="footer__line g-mainSection">
				<li class="footer__item footer__item_small">
					<h4 class="footer__text footer__text_centered"><?= date('Y') ?></h4>
					<h4 class="footer__text">&copy;<?= Yii::$app->name; ?></h4>
				</li>
				<li class="footer__item footer__item_small">
					<?= Html::a('Пользовательское соглашение', ['page/view', 'sid' => 'polzovatelskoe-soglashenie'], ['class' => 'footer__text footer__text_link']) ?>
				<li class="footer__item">
					<ul class="socialBox">
						<li class="footer__item footer__item_social">
							<a class="footer__link footer__link_logo footer__link_social footer__link_vk" href="#">Vkontakte</a>
						</li>
						<li class="footer__item footer__item_social">
							<a class="footer__link footer__link_logo footer__link_social footer__link_fb" href="#">Facebook</a>
						</li>
						<li class="footer__item footer__item_social">
							<a class="footer__link footer__link_logo footer__link_social footer__link_mail" href="#">Mail</a>
						</li>
						<li class="footer__item footer__item_social">
							<a class="footer__link footer__link_logo footer__link_social footer__link_gmail" href="#">Gmail</a>
						</li>
						<li class="footer__item footer__item_social">
							<a class="footer__link footer__link_logo footer__link_social footer__link_ok" href="#">Odnoklassniki</a>
						</li>
						<li class="footer__item footer__item_social">
							<a class="footer__link footer__link_logo footer__link_social footer__link_ya" href="#">Yandex</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</footer>



