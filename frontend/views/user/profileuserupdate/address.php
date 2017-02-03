<div id="js_addresses">
	<?php $keyall = 0; ?>
	<?php if ($addresses): ?>
		<?php foreach ($addresses as $key => $a): ?>

			<?php if ($profileUserForm->leftaddresses): ?>
				<?php if (!in_array($a->id, $profileUserForm->leftaddresses)): ?>
					<?php continue; ?>
				<?php endif ?>
			<?php endif ?>

			<?php $keyall = $key;  ?>
			<div class="js_address">
				<input name="ProfileUserForm[leftaddresses][]" type="hidden" value="<?= $a->id ?>" />
				<div class="form__line form__line_centeredContent">
					<label for="" class="form__label form__label_w260">Адрес:</label>
					<input name="Address[<?= $key ?>][address]" type="text" class="form__val section_810 form__val_ph" placeholder="г. Москва, ул. Автозаводская д. 13" value="<?= $a->address ?>">
					<?php if ($keyall===0): ?>
						<div class="form_add js_add_newaddress"></div>
					<?php else: ?>
						<div class="form_del js_del_parent" data-value="js_address"></div>
					<?php endif ?>
				</div>
				<?php if ($a->errors && isset($a->errors['address'])): ?>
					<div class="error">
						<?php foreach ($a->errors['address'] as $error): ?>
							<p><?= $error ?></p>
						<?php endforeach; ?>
					</div>
				<?php endif ?>
				<div class="form__line form__line_centeredContent g-m_b25">
					<label for="" class="form__label form__label_w260">Добавить метро:</label>
					<input name="Address[<?= $key ?>][metro_id]" type="text" class="g-input g-input_search section_810" placeholder="Поиск ..." value="<?= $a->metro_id?$a->metrostation->header:'' ?>" list="datametrostation<?= $key ?>">
					<datalist id="datametrostation<?= $key ?>">
						<?php foreach ($metrostations as $m): ?>
							<option><?= $m->header ?></option>
						<?php endforeach ?>
					</datalist>
				</div>
				<div class="form__line section_810 form__center form__line_centeredContent">
					<input name="Address[<?= $key ?>][description]" type="text" class="form__val form__val_italic form__val_wide" placeholder="Комментарий (дом/работа)" value="<?= $a->description ?>">
				</div>
			</div>
		<?php endforeach ?>
	<?php endif ?>
	<?php if ($newaddresses): ?>
		<?php foreach ($newaddresses as $key => $a): ?>
			<?php $keyall++;  ?>
			<div class="js_address js_newaddress" data-key="<?= $key ?>">
				<div class="form__line form__line_centeredContent">
					<label for="" class="form__label form__label_w260">Адрес:</label>
					<input name="Newaddress[<?= $key ?>][address]" type="text" class="form__val section_810 form__val_ph" placeholder="г. Москва, ул. Автозаводская д. 13" value="<?= $a->address ?>">
					<?php if ($keyall===0): ?>
						<div class="form_add js_add_newaddress"></div>
					<?php else: ?>
						<div class="form_del js_del_parent" data-value="js_address"></div>
					<?php endif ?>
				</div>
				<?php if ($a->errors && isset($a->errors['address'])): ?>
					<div class="error">
						<?php foreach ($a->errors['address'] as $error): ?>
							<p><?= $error ?></p>
						<?php endforeach; ?>
					</div>
				<?php endif ?>
				<div class="form__line form__line_centeredContent g-m_b25">
					<label for="" class="form__label form__label_w260">Добавить метро:</label>
					<input name="Newaddress[<?= $key ?>][metro_id]" type="text" class="g-input g-input_search section_810" placeholder="Поиск ..." value="<?= $a->metro_id ?>" list="datametrostationnew<?= $key ?>">
					<datalist id="datametrostationnew<?= $key ?>">
						<?php foreach ($metrostations as $m): ?>
							<option><?= $m->header ?></option>
						<?php endforeach ?>
					</datalist>
				</div>
				<div class="form__line section_810 form__center form__line_centeredContent">
					<input name="Newaddress[<?= $key ?>][description]" type="text" class="form__val form__val_italic form__val_wide" placeholder="Комментарий (дом/работа)" value="<?= $a->description ?>">
				</div>
			</div>
		<?php endforeach ?>
	<?php endif ?>

	<?php if (!$addresses && !$newaddresses): ?>
		<div class="js_address js_newaddress" data-key="0">
			<div class="form__line form__line_centeredContent">
				<label for="" class="form__label form__label_w260">Адрес:</label>
				<input name="Newaddress[0][address]" type="text" class="form__val section_810 form__val_ph" placeholder="г. Москва, ул. Автозаводская д. 13" value="">
				<div class="form_add js_add_newaddress"></div>
			</div>
			<div class="form__line form__line_centeredContent g-m_b25">
				<label for="" class="form__label form__label_w260">Добавить метро:</label>
				<input name="Newaddress[0][metro_id]" type="text" class="g-input g-input_search section_810" placeholder="Поиск ..." value="" list="datametrostationnew0">
				<datalist id="datametrostationnew0">
					<?php foreach ($metrostations as $m): ?>
						<option><?= $m->header ?></option>
					<?php endforeach ?>
				</datalist>
			</div>
			<div class="form__line section_810 form__center form__line_centeredContent">
				<input name="Newaddress[0][description]" type="text" class="form__val form__val_italic form__val_wide" placeholder="Комментарий (дом/работа)" value="">
			</div>
		</div>
	<?php endif ?>
</div>