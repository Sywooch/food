<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

// use yii\widgets\Pjax;
use frontend\models\Pjax;

$this->params['breadcrumbs'][] = ['label' => 'Профиль'];

$this->title = 'Профиль';

?>

<aside class="l-sidebar l-sidebar_left">

	<?= $this->render('/user/left'.$user->usertype, [
	]) ?>

</aside>
<div class="g-flexMiddleChild middleWrapper">

	<div class="menuTop">

		<?= $this->render('/user/top-menu-'.$user->usertype, [
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
			<h1 class="headerBox__title">Мои сообщения</h1>
		</div>





		<div class="chatCont">
		<div class="messages">
			<div class="messages__left">
				<div class="messages__header">
					<ul class="list">
						<li class="list__item list__item_big"> 
							<div class="list__innerWrapper">
								<a href="#" class="list__img">
									<img class="list__innerImg" src="<?= $user->getIconsrc('icon') ?>" alt="">
									<span class="list__status list__status_active"></span>
								</a>
							</div>
						</li>
					</ul>
				</div>
				<div class="messages__body messages__body_h800">
					<form class="messages__line messages__line_h75 messages__line_bb">
						<input class="g-input g-input_search g-input_searchBlack g-input_borderMain g-input_ma g-input_w100" type="search" placeholder="Поиск по сообщениям ...">
					</form>
					<ul class="list list_hcalc list_oys">

<?php if ($messagesLast): ?>
	<?php foreach ($messagesLast as $key => $m): ?>
		<li class="list__item list__item_h90 list__item_pl20r10 list__item_lightGrey list__item_bb"> 
			<div class="list__innerWrapper list__innerWrapper_start list__innerWrapper_width100">
				<a href="#" class="list__img list__img_50">
					<img class="list__innerImg" src="<?= $authorsLast[$m['author_id']]->getIconsrc('icon') ?>" alt="">
					<span class="list__status list__status_active"></span>
				</a>
				<div class="g-cooker g-cooker_wcalc">
					<div class="g-cooker__header">
						<div class="g-cooker__line g-cooker__line_orange g-cooker__line_fz14 g-cooker__line_pb8"><?= $authorsLast[$m['author_id']]->username ?>
							<?php if ($m['countnotread']): ?>
								<span class="g-count"><span class="g-count__val"><?= $m['countnotread'] ?></span></span>
							<?php endif ?>
						</div>
						<div class="g-cooker__line g-cooker__line_lightGrey g-cooker__line_fz14 g-cooker__line_pb8"><?= date("Y-m-d H:i:s", strtotime($m['created_at'])) ?></div>
					</div>
					<div class="g-cooker__line g-cooker__line_darkSea g-cooker__line_fcr g-cooker__line_w210 g-cooker__line_ellipsis"><a href="<?= Url::to(['message/list', 'id' => $m['author_id']]) ?>" data-pjax="1"><?= $m['text'] ?></a></div>
				</div>
			</div>
		</li>
	<?php endforeach ?>
<?php else: ?>
	<p>Нет отправителей</p>
<?php endif ?>


						<!-- <li class="list__item list__item_h90 list__item_pl20r10 list__item_lightGrey list__item_bb"> 
							<div class="list__innerWrapper list__innerWrapper_start list__innerWrapper_width100">
								<a href="#" class="list__img list__img_50">
									<img class="list__innerImg" src="../../images/cooker.png" alt="">
									<span class="list__status list__status_active"></span>
								</a>
								<div class="g-cooker g-cooker_wcalc">
									<div class="g-cooker__header">
										<div class="g-cooker__line g-cooker__line_orange g-cooker__line_fz14 g-cooker__line_pb8">Геннадий</div>
										<div class="g-cooker__line g-cooker__line_lightGrey g-cooker__line_fz14 g-cooker__line_pb8">27.04.2016</div>
									</div>
									<div class="g-cooker__line g-cooker__line_darkSea g-cooker__line_fcr g-cooker__line_w210 g-cooker__line_ellipsis">Lorem ipsum 
									dolor sit amet, consectetur adipisicing elit. Praesentium laudantium, unde quae culpa, qui reprehenderit eius inventore 
									recusandae libero totam temporibus repudiandae error iure, magnam ipsam ipsum nulla amet neque.</div>
								</div>
							</div>
						</li>
						<li class="list__item list__item_h90 list__item_pl20r10 list__item_bb"> 
							<div class="list__innerWrapper list__innerWrapper_start list__innerWrapper_width100">
								<a href="#" class="list__img list__img_50">
									<img class="list__innerImg" src="../../images/cooker.png" alt="">
									<span class="list__status"></span>
								</a>
								<div class="g-cooker g-cooker_wcalc">
									<div class="g-cooker__header">
										<div class="g-cooker__line g-cooker__line_orange g-cooker__line_fz14 g-cooker__line_pb8">Геннадий</div>
										<div class="g-cooker__line g-cooker__line_lightGrey g-cooker__line_fz14 g-cooker__line_pb8">27.04.2016</div>
									</div>
									<div class="g-cooker__line g-cooker__line_darkSea g-cooker__line_fcr g-cooker__line_w210 g-cooker__line_ellipsis">Lorem ipsum 
									dolor sit amet, consectetur adipisicing elit. Praesentium laudantium, unde quae culpa, qui reprehenderit eius inventore 
									recusandae libero totam temporibus repudiandae error iure, magnam ipsam ipsum nulla amet neque.</div>
								</div>
							</div>
						</li>
						<li class="list__item list__item_h90 list__item_pl20r10 list__item_grey list__item_bb"> 
							<div class="list__innerWrapper list__innerWrapper_start list__innerWrapper_width100">
								<a href="#" class="list__img list__img_50">
									<img class="list__innerImg" src="../../images/cooker.png" alt="">
									<span class="list__status"></span>
								</a>
								<div class="g-cooker g-cooker_wcalc">
									<div class="g-cooker__header">
										<div class="g-cooker__line g-cooker__line_orange g-cooker__line_fz14 g-cooker__line_pb8">Геннадий</div>
										<div class="g-cooker__line g-cooker__line_lightGrey g-cooker__line_fz14 g-cooker__line_pb8">27.04.2016</div>
									</div>
									<div class="g-cooker__line g-cooker__line_darkSea g-cooker__line_fcr g-cooker__line_w210 g-cooker__line_ellipsis">Lorem ipsum 
									dolor sit amet, consectetur adipisicing elit. Praesentium laudantium, unde quae culpa, qui reprehenderit eius inventore 
									recusandae libero totam temporibus repudiandae error iure, magnam ipsam ipsum nulla amet neque.</div>
								</div>
							</div>
						</li> -->


					</ul>
				</div>
			</div>
			<div class="messages__right">
				<div class="messages__header">
					<ul class="list">



<?php if ($recipient): ?>
	<li class="list__item list__item_h90"> 
		<div class="list__innerWrapper">
			<a href="#" class="list__img">
				<img class="list__innerImg" src="<?= $recipient->getIconsrc('icon') ?>" alt="">
				<span class="list__status list__status_active"></span>
			</a>
			<div class="g-cooker list__descr">
				<div class="g-cooker__line g-cooker__line_white g-cooker__line_fz14 g-cooker__line_pb8"><?= $recipient->username ?></div>
				<div class="g-cooker__line g-cooker__line_white g-cooker__line_fcr"><?= $recipient->email ?></div>
			</div>
		</div>
	</li>
<?php endif ?>


					</ul>
				</div>
				<div class="messages__body messages__body_h630 messages__body_oys" id="js_messages_scroll">
					<ul class="list" id="js_message_messagesUl">

<?php if ($messages): ?>
	<?php $scrollTo = null; ?>
	<?php $first = true; ?>
	<?php foreach ($messages as $key => $m): ?>
		<?php if (!$scrollTo): ?>
			<?php $scrollTo = $key ?>
		<?php endif ?>
		<?php if ($first): ?>
			<?php $firstMessageDateTime = $m->created_at; ?>
			<?php $firstMessageAuthorId = $m->author->id; ?>
			<?php $first = false; ?>
		<?php endif ?>
		<?php if ($key == 0): ?>
			<?php $scrollLast = $m['created_at']; ?>
			<?php $lastMessageDateTime = $m->created_at; ?>
			<?php $lastMessageAuthorId = $m->author->id; ?>
		<?php endif ?>
		<li class="list__item list__item_ha list__item_pl20r10 list__item_p15" id="message-<?= date('YmdHis', strtotime($m->created_at)).$m->author->id ?>" data-datetime="<?= $m->created_at ?>" data-authorid="<?= $m->author->id ?>">
			<div class="list__innerWrapper list__innerWrapper_top list__innerWrapper_width100 list__innerWrapper_ha">
				<a href="#" class="list__img list__img_50 list__img_mt5">
					<img class="list__innerImg" src="<?= $m->author->getIconsrc('icon') ?>" alt="">
				</a>
				<div class="g-cooker g-cooker_wcalc">
					<div class="g-cooker__header">
						<div class="g-cooker__line g-cooker__line_orange g-cooker__line_fz14 g-cooker__line_pb8"><?= $m->author->username ?></div>
						<div class="g-cooker__line g-cooker__line_lightGrey g-cooker__line_fz14 g-cooker__line_pb8"><?= $m->created_atToStr() ?></div>
					</div>
					<div class="g-cooker__line g-cooker__line_darkSea g-cooker__line_fcr g-cooker__line_w85per"><?= nl2br(Html::encode($m->text)) ?></div>
				</div>
			</div>
		</li>
	<?php endforeach ?>
<?php endif ?>

					</ul>

<?php if ($recipient): ?>
	<form action="<?= Url::to(['message/new-messages', 'recipient_id' => $recipient->id]) ?>" method="post" id="js_message_newMessageForm">
		<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
		<input name="lastMessageDateTime" id="js_message_lastMessageDateTime" type="hidden" value="<?= $lastMessageDateTime ?>" />
		<input name="lastMessageAuthorId" id="js_message_lastMessageAuthorId" type="hidden" value="<?= $lastMessageAuthorId ?>" />
	</form>

	<form action="<?= Url::to(['message/old-messages', 'recipient_id' => $recipient->id]) ?>" method="post" id="js_message_oldMessageForm">
		<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
		<input name="firstMessageDateTime" id="js_message_firstMessageDateTime" type="hidden" value="<?= $firstMessageDateTime ?>" />
		<input name="firstMessageAuthorId" id="js_message_firstMessageAuthorId" type="hidden" value="<?= $firstMessageAuthorId ?>" />
	</form>
<?php endif; ?>
				</div>





			</div>
		</div>

<?php if ($recipient): ?>
	<?php Pjax::begin(['id' => 'messageForm']); ?>
	<form id="js_messageForm" class="messages__footer" action="<?= Url::to(['message/list', 'id' => $recipient->id]) ?>" method="post" data-pjax="1">
		<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
		<textarea name="Message[text]" id="js_messageForm_textarea" class="messages__textarea" placeholder="Введите текст сообщения:"></textarea>
		<div class="messages__buttonsBox">
			<div class="messages__button messages__button_add">Добавить файл</div>
			<div class="messages__button messages__button_symbol">Вставить символ</div>
			<input name="submit" id="js_messageForm_submit" class="g-link" type="submit" value="Отправить" />
		</div>
	</form>
	<?php Pjax::end(); ?>
<?php endif ?>

		</div>


	</div>


<?php
$js = <<<HTML
    var ul = $('#js_message_messagesUl');
    var idLast = ul.children('li').last().attr('id');
    $("#js_messages_scroll").animate({
        scrollTop: $('#' + idLast).position().top
    }, 600);
HTML;
$this->registerJs($js);
?>


</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('/site/right', [
	]) ?>

</aside>