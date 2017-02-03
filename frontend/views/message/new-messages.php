<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

	<?php foreach ($messages as $m): ?>
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
