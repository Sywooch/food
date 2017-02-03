<?php

use \yii\helpers\Html;
use \yii\helpers\Url;
use \yii\helpers\ArrayHelper;
use common\models\User;
use common\models\Kitchen;

$cookKitchen = Yii::$app->db->createCommand('
		select
			user.id as uid,
			k.id as kid
		from user
		left join product p on `p`.`user_id` = `user`.`id`
		left join dish d on d.product_id = p.id
		left join dish_kitchen dk on dk.dish_id = d.product_id
		left join kitchen k on k.id = dk.kitchen_id
		where user.usertype = :usertype and user.role = :role  and user.status = :status
		group by user.id
		limit 10;
	')
	->bindValue(':usertype', User::TYPE_COOK)
	->bindValue(':role', User::ROLE_USER)
	->bindValue(':status', User::STATUS_ACTIVE)
	->queryAll();

$cookIds = ArrayHelper::getColumn($cookKitchen,'uid');
$cookIds = array_unique($cookIds);
$cooks = User::findAll($cookIds);
$cooks = ArrayHelper::index($cooks,'id');

$kitchenIds = ArrayHelper::getColumn($cookKitchen,'kid');
$kitchenIds = array_unique($kitchenIds);
$kitchens = Kitchen::findAll($kitchenIds);
$kitchens = ArrayHelper::index($kitchens,'id');

?>
<h2 class="sidebar__heading">Популярные повара</h2>
<ul class="list">

	<?php foreach ($cookKitchen as $ck): ?>

		<li class="list__item list__item_big">
			<div class="list__innerWrapper">
				<span class="list__status"></span>
				<a href="<?= Url::to(['site/userprofile', 'id' => $cooks[$ck['uid']]->id]) ?>" class="list__img">
					<?php if ($cooks[$ck['uid']]->getIconsrc('icon')): ?>
						<img class="list__innerImg" src="<?= $cooks[$ck['uid']]->getIconsrc('icon') ?>" alt="">
					<?php else: ?>
						<img class="list__innerImg" src="/images/no-icon-64.png" alt="">
					<?php endif ?>
				</a>
				<div class="g-cooker g-cooker_w170">
					<div class="rateBox">
						<a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
						<a href="#" class="rateBox__item rateBox__item_w10 js-rate"></a>
						<a href="#" class="rateBox__item rateBox__item_w4 js-rate"></a>
						<a href="#" class="rateBox__item js-rate"></a>
						<a href="#" class="rateBox__item js-rate"></a>
					</div>
					<div class="g-cooker__line"><?= $cooks[$ck['uid']]->username ?></div>
					<?php if ($ck['kid']): ?>
					<div class="g-cooker__line g-cooker__line_orange"><a href="<?= Url::to(['site/usermenu', 'id' => $cooks[$ck['uid']]->id]) ?>"><?= $kitchens[$ck['kid']]->header ?></a></div>
					<?php endif ?>
				</div>
			</div>
		</li>

	<?php endforeach ?>

</ul>
