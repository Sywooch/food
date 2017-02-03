<div id="js_phonenumber_for_insert">

	<?php $allkey = 0; ?>

	<?php if (count($phonenumbers)): ?>

		<?php foreach ($phonenumbers as $key => $p): ?>

			<?php if ($profileUserForm->leftphonenumber): ?>
				<?php if (!in_array($p->id, $profileUserForm->leftphonenumber)): ?>
					<?php continue; ?>
				<?php endif ?>
			<?php endif ?>
			
			<?php $allkey+= $key; ?>

			<div class="js_phonenumber_exist">
				<div class="form__line">
					<input name="ProfileUserForm[leftphonenumber][]" type="hidden" value="<?= $p->id ?>">
					<label for="" class="form__label">Телефон:</label>
					<input id="input_phonenumber_<?= $allkey ?>" type="text" class="form__val section_250" placeholder="8 800 000 00 00" name="Phonenumber[<?= $key ?>][phonenumber]" value="<?= $p->phonenumber ?>" />

					<div class="messenger messenger_wc">
						<div class="messenger__item">
							<label class="messenger__wrap messenger__wrap_mr7">
							<input name="Phonenumber[<?= $key ?>][whatsapp]" type="hidden" value="0" />
							<input name="Phonenumber[<?= $key ?>][whatsapp]" type="checkbox" id="input_whatsapp_<?= $allkey ?>" value="1" class="messenger__check js-messenger__check_whatsUp"<?= (isset($p['whatsapp'])&&$p['whatsapp']==1)?' checked':'' ?> />
								<div class="messenger__bg"></div>
							</label>
							<div class="messenger__whatsUp"></div>
						</div>
						<div class="messenger__item">
							<label class="messenger__wrap messenger__wrap_mr7">
							<input name="Phonenumber[<?= $key ?>][viber]" type="hidden" value="0" />
							<input name="Phonenumber[<?= $key ?>][viber]" type="checkbox" id="input_viber_<?= $allkey ?>" value="1" class="messenger__check js-messenger__check_viber"<?= (isset($p['viber'])&&$p['viber']==1)?' checked':'' ?> />
								<div class="messenger__bg"></div>
							</label>
							<div class="messenger__viber"></div>
						</div>
						<div<?= ($allkey===0)?' id="js_phonenumber_button_add"':' class="js_phonenumber_delete"' ?>></div>
					</div>

				</div>
				<div class="js-contentBox">
					<div class="js-hiddenBox js-hiddenBox_whatsUp form__line"<?= ( isset($p['whatsapp']) && ($p['whatsapp']==1) )?' style="display:block"':'' ?>>
						<label for="" class="form__label">Телефон what's up:</label>
						<input id="input_whatsappnumber_<?= $allkey ?>" type="text" name="Phonenumber[<?= $key ?>][whatsappnumber]" class="form__val section_500" placeholder="8 800 000 00 00" value="<?= $p->whatsappnumber ?>" />
					</div>
					<div class="js-hiddenBox js-hiddenBox_viber form__line"<?= ( isset($p['viber']) && ($p['viber']==1) )?' style="display:block"':'' ?>>
						<label for="" class="form__label">Телефон viber:</label>
						<input id="input_vibernumber_<?= $allkey ?>" type="text" name="Phonenumber[<?= $key ?>][vibernumber]" class="form__val section_500" placeholder="8 800 000 00 00" value="<?= $p->vibernumber ?>" />
					</div>
				</div>
				<?php if (isset($p->errors)&&count($p->errors)): ?>
					<?php foreach ($p->errors as $key => $e): ?>
						<div class="antiReset error">
					        <?php foreach ($e as $errorText): ?>
					            <p><?= $errorText ?></p>
					        <?php endforeach ?>
						</div>
					<?php endforeach ?>
				<?php endif ?>

			</div>

		<?php endforeach; ?>

		<?php if (count($newphonenumbers)): ?>

			<?php foreach ($newphonenumbers as $key => $p): ?>

				<?php $allkey+= $key; ?>

				<div class="js_phonenumber_exist js_phonenumber_existnew" data-key="<?= $allkey ?>">
					<div class="form__line">
						<label for="" class="form__label">Телефон:</label>
						<input id="input_phonenumber_<?= $allkey ?>" type="text" class="form__val section_250" placeholder="8 800 000 00 00" name="Newphonenumber[<?= $key ?>][phonenumber]" value="<?= $p->phonenumber ?>" />

						<div class="messenger messenger_wc">
							<div class="messenger__item">
								<label class="messenger__wrap messenger__wrap_mr7">
								<input name="Newphonenumber[<?= $key ?>][whatsapp]" type="hidden" value="0" />
								<input name="Newphonenumber[<?= $key ?>][whatsapp]" type="checkbox" id="input_whatsapp_<?= $allkey ?>" value="1" class="messenger__check js-messenger__check_whatsUp"<?= (isset($p['whatsapp'])&&$p['whatsapp']==1)?' checked':'' ?> />
									<div class="messenger__bg"></div>
								</label>
								<div class="messenger__whatsUp"></div>
							</div>
							<div class="messenger__item">
								<label class="messenger__wrap messenger__wrap_mr7">
								<input name="Newphonenumber[<?= $key ?>][viber]" type="hidden" value="0" />
								<input name="Newphonenumber[<?= $key ?>][viber]" type="checkbox" id="input_viber_<?= $allkey ?>" value="1" class="messenger__check js-messenger__check_viber"<?= (isset($p['viber'])&&$p['viber']==1)?' checked':'' ?> />
									<div class="messenger__bg"></div>
								</label>
								<div class="messenger__viber"></div>
							</div>
							<div<?= ($allkey===0)?' id="js_phonenumber_button_add"':' class="js_phonenumber_delete"' ?>></div>
						</div>

					</div>
					<div class="js-contentBox">
						<div class="js-hiddenBox js-hiddenBox_whatsUp form__line"<?= ( isset($p['whatsapp']) && ($p['whatsapp']==1) )?' style="display:block"':'' ?>>
							<label for="" class="form__label">Телефон what's up:</label>
							<input name="Newphonenumber[<?= $key ?>][whatsappnumber]" id="input_whatsappnumber_<?= $allkey ?>" type="text" class="form__val section_500" placeholder="8 800 000 00 00" value="<?= $p->whatsappnumber ?>" />
						</div>
						<div class="js-hiddenBox js-hiddenBox_viber form__line"<?= ( isset($p['viber']) && ($p['viber']==1) )?' style="display:block"':'' ?>>
							<label for="" class="form__label">Телефон viber:</label>
							<input name="Newphonenumber[<?= $key ?>][vibernumber]" id="input_vibernumber_<?= $allkey ?>" type="text" class="form__val section_500" placeholder="8 800 000 00 00" value="<?= $p->vibernumber ?>" />
						</div>
					</div>
					<?php if (isset($p->errors)&&count($p->errors)): ?>
						<?php foreach ($p->errors as $key => $e): ?>
							<div class="antiReset error">
						        <?php foreach ($e as $errorText): ?>
						            <p><?= $errorText ?></p>
						        <?php endforeach ?>
							</div>
						<?php endforeach ?>
					<?php endif ?>

				</div>

			<?php endforeach; ?>

		<?php endif; ?>









	<?php else: ?>

		<div class="js_phonenumber_exist js_phonenumber_existnew" data-key="0">
			<div class="form__line">
				<label for="" class="form__label">Телефон:</label>
				<input name="Newphonenumber[0][id]" type="hidden" value="0">
				<input name="Newphonenumber[0][phonenumber]" type="text" id="input_phonenumber" class="form__val section_250" placeholder="7 495 000 00 00" value="" />

				<div class="messenger messenger_wc">
					<div class="messenger__item">
						<label class="messenger__wrap messenger__wrap_mr7">
						<input name="Newphonenumber[0][whatsapp]" type="hidden" value="0" />
						<input name="Newphonenumber[0][whatsapp]" type="checkbox" id="input_whatsapp" class="messenger__check js-messenger__check_whatsUp" value="1" />
							<div class="messenger__bg"></div>
						</label>
						<div class="messenger__whatsUp"></div>
					</div>
					<div class="messenger__item">
						<label class="messenger__wrap messenger__wrap_mr7">
						<input name="Newphonenumber[0][viber]" type="hidden" value="0" />
						<input name="Newphonenumber[0][viber]" type="checkbox" id="input_viber" class="messenger__check js-messenger__check_viber" value="1" />
							<div class="messenger__bg"></div>
						</label>
						<div class="messenger__viber"></div>
					</div>
					<div id="js_phonenumber_button_add"></div>
				</div>

			</div>
			<div class="js-contentBox">
				<div class="js-hiddenBox js-hiddenBox_whatsUp form__line">
					<label for="" class="form__label">Телефон what's up:</label>
					+<input name="Newphonenumber[0][whatsappnumber]" id="input_whatsappnumber" type="text" class="form__val section_500" placeholder="7 000 000 00 00" value="" />
				</div>
				<div class="js-hiddenBox js-hiddenBox_viber form__line">
					<label for="" class="form__label">Телефон viber:</label>
					+<input name="Newphonenumber[0][vibernumber]" type="text" id="input_vibernumber" class="form__val section_500" placeholder="7 000 000 00 00" value="" />
				</div>
			</div>
		</div>

	<?php endif ?>

</div>
