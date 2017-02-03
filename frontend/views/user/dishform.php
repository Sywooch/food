<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<form action="" method="post" class="form form_hcalc110" enctype="multipart/form-data">
	<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
	<div class="form__twoBox form__twoBox_h100">
		<div class="form__leftBox">
			<h4 class="form__header">Общая информация</h4>
			<div class="form__section form__section_pr20">
				<div class="form__colWrapper">
					<div class="form__leftCol">
						<div class="form__line">
							<label for="" class="form__label form__label_small">Название:</label>
							<div class="section_310">
								<input name="Product[header]" type="text" class="form__val form__val_w100" placeholder="Тефтели" value="<?= $product->header ?>" />
							</div>
							<?php if (isset($product->errors)&&count($product->errors)): ?>
								<?php if (isset($product->errors['header'])): ?>
									<div class="error">
										<?php foreach ($product->errors['header'] as $error): ?>
											<p><?= $error ?></p>
										<?php endforeach ?>
									</div>
								<?php endif ?>
							<?php endif ?>
						</div>
						<div class="form__line">
							<label for="" class="form__label form__label_small">Кухня:</label>
							<div class="section_310">
								<div id="js_kitchen_place">
								<?php if ($product->kitchens): ?>
									<?php foreach ($product->kitchens as $key => $k): ?>
										<div class="tagBox">
											<input name="DishForm[kitchens][]" type="hidden" value="<?= $k->header ?>">
											<span class="tagBox__name"><?= $k->header ?></span>
											<span class="js-remove"></span>
										</div>
									<?php endforeach ?>
								<?php endif ?>
								</div>
								<?php if (isset($dishForm->errors)&&count($dishForm->errors)): ?>
									<?php if (isset($dishForm->errors['kitchens'])): ?>
										<div class="error">
											<?php foreach ($dishForm->errors['kitchens'] as $error): ?>
												<p><?= $error ?></p>
											<?php endforeach ?>
										</div>
									<?php endif ?>
								<?php endif ?>
								<label for="" class="form__label form__label_tal form__label_w100 form__label_mb15">Добавить:</label>
								<div class="searchBox__wrapper">
									<div class="select_for_checkbox" data-place="js_kitchen_place" data-example="js_kitchen_example">
										<input type="text" class="" placeholder="Кухня ..." />
										<span class="drop"></span>
										<div class="show">
											<div class="items">
												<?php foreach ($kitchens as $key => $k): ?>
													<div><?= $k->header ?></div>
												<?php endforeach ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form__line">
							<label for="" class="form__label form__label_small">Категория:</label>
							<div class="section_310">
								<label class="select_default">
									<select name="Dish[dishtype_id]">
										<option value="">Выберите категорию</option>
										<?php foreach ($dishtypes as $key => $dt): ?>
											<option value="<?= $dt->id ?>"<?= ($dt->id==$dish->dishtype_id)?' selected':'' ?>><?= $dt->header ?></option>
										<?php endforeach ?>
									</select>
								</label>
							</div>
							<?php if (isset($dish->errors)&&count($dish->errors)): ?>
								<?php if (isset($dish->errors['dishtype_id'])): ?>
									<div class="error">
										<?php foreach ($dish->errors['dishtype_id'] as $error): ?>
											<p><?= $error ?></p>
										<?php endforeach ?>
									</div>
								<?php endif ?>
							<?php endif ?>
						</div>
					</div>
					<div class="form__rightCol">
						<div class="messenger messenger_ml0 messenger_w100 messenger_mb15">
							<label class="messenger__wrap">
								<input name="DishForm[diettrue]" type="checkbox" class="messenger__check js-messenger__check_whatsUp" value="1"<?= $dish->diet_id?' checked':'' ?> />
								<div class="messenger__bg"></div>
							</label>
							<div class="messenger__text">Разместить блюдо в категорию “Диеты”</div>
						</div>
						<?php if (isset($dishForm->errors)&&count($dishForm->errors)): ?>
							<?php if (isset($dishForm->errors['diettrue'])): ?>
								<div class="error">
									<?php foreach ($dishForm->errors['diettrue'] as $error): ?>
										<p><?= $error ?></p>
									<?php endforeach ?>
								</div>
							<?php endif ?>
						<?php endif ?>
						<label class="select_default">
							<select name="Dish[diet_id]">
								<option value=""></option>
								<?php foreach ($diets as $key => $d): ?>
									<option value="<?= $d->id ?>"<?= ($d->id==$dish->diet_id)?' selected':'' ?>><?= $d->header ?></option>
								<?php endforeach ?>
							</select>
						</label>
						<?php if (isset($dish->errors)&&count($dish->errors)): ?>
							<?php if (isset($dish->errors['diet_id'])): ?>
								<div class="error">
									<?php foreach ($dish->errors['diet_id'] as $error): ?>
										<p><?= $error ?></p>
									<?php endforeach ?>
								</div>
							<?php endif ?>
						<?php endif ?>
					</div>
				</div>
			</div>
			<div class="form__border"></div>
			<h4 class="form__header">Параметры</h4>
			<div class="form__section form__section_center form__section_pr20">
				<div class="form__colBox">
					<div class="form__col form__col_mr10">
						<label for="" class="form__label form__label_min">Вес:</label>
						<div class="form__colVal form__colVal_widthCenter form__colVal_w125">
							<input name="Dish[weight]" class="g-input g-input_75px g-input_pr0 g-input_bn g-input_mr0 g-input_pl15" type="text" placeholder="100" value="<?= $dish->weight ?>">
							<div class="form__inputAdd form__inputAdd_orange">гр</div>
						</div>
					</div>
					<div class="form__col">
						<label for="" class="form__label form__label_min">Время приготовления:</label>
						<div class="g-start_center">
							<div class="form__inputAdd">от</div>
							<div class="form__colVal form__colVal_mr10">
								<input name="Dish[timefrom]" class="g-input g-input_w100px g-input_pr0 g-input_mr0 g-input_bn g-input_tac" type="text" placeholder="100" value="<?= $dish->timefrom ?>">
							</div>
							<div class="form__inputAdd">до</div>
							<div class="form__colVal form__colVal_mr10">
								<input name="Dish[timeto]" class="g-input g-input_w100px g-input_pr0 g-input_mr0 g-input_bn g-input_tac" type="text" placeholder="100" value="<?= $dish->timeto ?>">
							</div>
							<div class="form__inputAdd form__inputAdd_orange">мин</div>
						</div>
					</div>
					<div class="form__col">
						<label for="" class="form__label form__label_min">Цена:</label>
						<div class="form__colVal form__colVal_widthCenter form__colVal_w125">
							<input name="Product[price]" class="g-input g-input_75px g-input_pr0 g-input_bn g-input_w65 g-input_mr0 g-input_pl15" type="text" placeholder="100" value="<?= $product->price ?>">
							<div class="form__inputAdd form__inputAdd_orange">руб</div>
						</div>
					</div>
					<div class="form__col">
						<label for="" class="form__label form__label_min">Цена (акция):</label>
						<div class="form__colVal form__colVal_widthCenter form__colVal_w125">
							<input name="Product[pricesale]" class="g-input g-input_75px g-input_pr0 g-input_bn g-input_w65 g-input_mr0 g-input_pl15" type="text" placeholder="100" value="<?= $product->pricesale ?>">
							<div class="form__inputAdd form__inputAdd_orange">руб</div>
						</div>
					</div>
					<?php if (isset($dish->errors)&&count($dish->errors)): ?>
						<?php if (isset($dish->errors['weight'])): ?>
							<div class="error">
								<?php foreach ($dish->errors['weight'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					<?php endif ?>
					<?php if (isset($dish->errors)&&count($dish->errors)): ?>
						<?php if (isset($dish->errors['timefrom'])): ?>
							<div class="error">
								<?php foreach ($dish->errors['timefrom'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					<?php endif ?>
					<?php if (isset($dish->errors)&&count($dish->errors)): ?>
						<?php if (isset($dish->errors['timeto'])): ?>
							<div class="error">
								<?php foreach ($dish->errors['timeto'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					<?php endif ?>
					<?php if (isset($product->errors)&&count($product->errors)): ?>
						<?php if (isset($product->errors['price'])): ?>
							<div class="error">
								<?php foreach ($product->errors['price'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					<?php endif ?>
					<?php if (isset($product->errors)&&count($product->errors)): ?>
						<?php if (isset($product->errors['pricesale'])): ?>
							<div class="error">
								<?php foreach ($product->errors['pricesale'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					<?php endif ?>
				</div>
			</div>
			<div class="form__section form__section_pr20">
				<div class="form__line">
					<label for="" class="form__label form__label_small">Описание:</label>
					<textarea name="Dish[text]" class="form__val form__val_big section_wcalc150" name="" placeholder="..."><?= $dish->text ?></textarea>
					<?php if (isset($dish->errors)&&count($dish->errors)): ?>
						<?php if (isset($dish->errors['text'])): ?>
							<div class="error">
								<?php foreach ($dish->errors['text'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					<?php endif ?>
				</div>
				<div class="form__line form__line_ml150">
					<div class="form__title">Информация, для меню "Диеты"</div>
					<div class="form__colBox form__colBox_pt15">
						<div class="form__col">
							<label for="" class="form__label form__label_min">Энергетическая ценность на порцию:</label>
							<div class="form__colVal form__colVal_widthCenter form__colVal_w180">
								<input name="Dish[calories]" class="g-input g-input_w115 g-input_pr0 g-input_mr0 g-input_bn g-input_mr0 g-input_pl15" type="text" placeholder="100" value="<?= $dish->calories ?>">
								<div class="form__inputAdd form__inputAdd_orange">калл</div>
							</div>
						</div>
						<div class="form__col">
							<label for="" class="form__label form__label_min">Белки:</label>
							<div class="form__colVal form__colVal_widthCenter form__colVal_w125">
								<input name="Dish[proteins]" class="g-input g-input_75px g-input_pr0 g-input_bn g-input_mr0 g-input_pl15" type="text" placeholder="100" value="<?= $dish->proteins ?>">
								<div class="form__inputAdd form__inputAdd_orange">гр</div>
							</div>
						</div>
						<div class="form__col">
							<label for="" class="form__label form__label_min">Жиры:</label>
							<div class="form__colVal form__colVal_widthCenter form__colVal_w125">
								<input name="Dish[fats]" class="g-input g-input_75px g-input_pr0 g-input_bn g-input_mr0 g-input_pl15" type="text" placeholder="100" value="<?= $dish->fats ?>">
								<div class="form__inputAdd form__inputAdd_orange">гр</div>
							</div>
						</div>
						<div class="form__col">
							<label for="" class="form__label form__label_min">Углеводы:</label>
							<div class="form__colVal form__colVal_widthCenter form__colVal_w125">
								<input name="Dish[carbohydrates]" class="g-input g-input_75px g-input_pr0 g-input_bn g-input_mr0 g-input_pl15" type="text" placeholder="100" value="<?= $dish->carbohydrates ?>">
								<div class="form__inputAdd form__inputAdd_orange">гр</div>
							</div>
						</div>
						<?php if (isset($dishForm->errors)&&count($dishForm->errors)): ?>
							<?php if (isset($dishForm->errors['calories'])): ?>
								<div class="error">
									<?php foreach ($dishForm->errors['calories'] as $error): ?>
										<p><?= $error ?></p>
									<?php endforeach ?>
								</div>
							<?php endif ?>
						<?php endif ?>
						<?php if (isset($dishForm->errors)&&count($dishForm->errors)): ?>
							<?php if (isset($dishForm->errors['proteins'])): ?>
								<div class="error">
									<?php foreach ($dishForm->errors['proteins'] as $error): ?>
										<p><?= $error ?></p>
									<?php endforeach ?>
								</div>
							<?php endif ?>
						<?php endif ?>
						<?php if (isset($dishForm->errors)&&count($dishForm->errors)): ?>
							<?php if (isset($dishForm->errors['fats'])): ?>
								<div class="error">
									<?php foreach ($dishForm->errors['fats'] as $error): ?>
										<p><?= $error ?></p>
									<?php endforeach ?>
								</div>
							<?php endif ?>
						<?php endif ?>
						<?php if (isset($dishForm->errors)&&count($dishForm->errors)): ?>
							<?php if (isset($dishForm->errors['carbohydrates'])): ?>
								<div class="error">
									<?php foreach ($dishForm->errors['carbohydrates'] as $error): ?>
										<p><?= $error ?></p>
									<?php endforeach ?>
								</div>
							<?php endif ?>
						<?php endif ?>
					</div>
				</div>
			</div>
			<div class="form__border"></div>
			<h4 class="form__header">Фото</h4>
			<div class="form__section form__section_pr20">
				<div class="form__line">
					<label for="" class="form__label form__label_small">Фото:</label>
					<div class="section_dib section_wcalc150">
						<ul class="form__list">

							<?php if ($product->productfotos): ?>
								<?php foreach ($product->productfotos as $key => $pf): ?>
									<li class="form__photos js_productfoto">
										<input type="hidden" name="DishForm[leftproductfoto][]" value="<?= $pf->id ?>">
										<div class="form__photo">
											<img class="form__img" src="<?= $pf->getSource('icon') ?>" alt="" />
											<?php if ($pf->id == $product->foto_id): ?>
												<div class="photo__favoriteMain photo__favoriteMain_w22">Главная фотография</div>
											<?php endif ?>
											<div class="form__hiddenBox form__hiddenBox_tar">
												<label class="lblBox lblBox_fav">
													<input class="lblBox__inp" name="Product[foto_id]" type="radio" value="<?= $pf->id ?>">
													<div class="lblBox__bg">Сделать главной</div>
												</label>
												<div class="form__remove form__remove_mt5 js_del_parent" data-value="js_productfoto">Удалить</div>
											</div>
										</div>
									</li>
								<?php endforeach ?>
							<?php else: ?>
								<p class="antiReset">Нет фотографий</p>
							<?php endif ?>
						</ul>
						<label class="g-link">Добавить фотографии
							<input name="DishForm[fotos][]" type="file" accept="image/jpeg,image/png" style="display:none" multiple>
						</label>
						<?php if (isset($dishForm->errors)&&count($dishForm->errors)): ?>
							<?php if (isset($dishForm->errors['fotos'])): ?>
								<div class="error">
									<?php foreach ($dishForm->errors['fotos'] as $error): ?>
										<p><?= $error ?></p>
									<?php endforeach ?>
								</div>
							<?php endif ?>
						<?php endif ?>
					</div>
				</div>
			</div>
			<div class="form__border"></div>
			<h4 class="form__header">Ингредиенты:</h4>
			<div class="form__section form__section_center form__section_pr20">
				<div id="js_ingrs">
					<?php if (is_array($dish->ingredients)): ?>
						<?php $ingredients = $dish->ingredients; ?>
					<?php else: ?>
						<?php $ingredients = json_decode($dish->ingredients, true); ?>
					<?php endif; ?>
					<?php if ($ingredients): ?>
						<?php foreach ($ingredients['name'] as $key => $name): ?>
							<div class="form__line form__line_mb15 form__line_centeredContent form__line_centeredWidth">
								<input name="Dish[ingredients][name][]" class="g-input g-input_w380px g-input_mr0" type="text" placeholder="Укажите ингридиент ..." value="<?= $name ?>">
								<div class="form__colVal g-start_center">
									<input name="Dish[ingredients][quantity][]" class="g-input g-input_w100px g-input_pr0 g-input_mr0 g-input_bn" placeholder="0" type="text" value="<?= $ingredients['quantity'][$key] ?>">
								</div>
								<label class="select_default">
									<select name="Dish[ingredients][measure][]">
										<option value=""></option>
										<?php foreach ($measures as $i => $m): ?>
											<option value="<?= $i ?>"<?= ($i==$ingredients['measure'][$key])?' selected':'' ?>><?= $m ?></option>
										<?php endforeach ?>
									</select>
								</label>
								<div class="form__remove form__remove_orange"></div>
							</div>
						<?php endforeach ?>
					<?php else: ?>
						<div class="form__line form__line_mb15 form__line_centeredContent form__line_centeredWidth js_ingr">
							<input name="Dish[ingredients][name][]" class="g-input g-input_w380px g-input_mr0" type="text" placeholder="Укажите ингридиент" value="">
							<div class="form__colVal g-start_center">
								<input name="Dish[ingredients][quantity][]" class="g-input g-input_w100px g-input_pr0 g-input_mr0 g-input_bn" placeholder="0" type="text" value="">
							</div>
							<label class="select_default">
								<select name="Dish[ingredients][measure][]">
									<option value=""></option>
									<?php foreach ($measures as $key => $m): ?>
										<option value="<?= $key ?>"><?= $m ?></option>
									<?php endforeach ?>
								</select>
							</label>
							<div class="form__remove form__remove_orange js_del_parent" data-value="js_ingr"></div>
						</div>
					<?php endif; ?>
				</div>
				<?php if (isset($dish->errors)&&count($dish->errors)): ?>
					<?php if (isset($dish->errors['ingredients'])): ?>
						<div class="error">
							<?php foreach ($dish->errors['ingredients'] as $error): ?>
								<p><?= $error ?></p>
							<?php endforeach ?>
						</div>
					<?php endif ?>
				<?php endif ?>

				<button type="button" class="g-link js_add_template mb15" data-place="js_ingrs" data-template="js_ingr_template">Добавить ингредиент</button>

			</div>
			<div class="form__border"></div>
			<h4 class="form__header">Видеопрезентация:</h4>
			<div class="form__section form__section_pr20">
				<div class="form__line form__line_centeredContent">
					<label for="" class="form__label form__label_w150">Видео:</label>
					<input name="Dish[video]" type="text" class="g-input g-input_w380px g-input_mr0" placeholder="https://youtu.be/LiNk" value="<?= $dish->video ?>">
				</div>
				<?php if ($dish->video): ?>
					<label for="" class="form__label form__label_w150"></label>
					<iframe class="mb15" width="560" height="315" src="<?= $dish->video ?>" frameborder="0" allowfullscreen></iframe>
				<?php endif ?>
				<?php if (isset($dish->errors)&&count($dish->errors)): ?>
					<?php if (isset($dish->errors['video'])): ?>
						<div class="error">
							<?php foreach ($dish->errors['video'] as $error): ?>
								<p><?= $error ?></p>
							<?php endforeach ?>
						</div>
					<?php endif ?>
				<?php endif ?>
			</div>
			<div class="form__border"></div>
			<div class="form__section form__section_center form__section_pr20">
				<div class="form__line form__line_centeredContent">
					<input type="submit" class="g-button g-button_green g-m_r15" value="Сохранить">
					<input type="submit" class="g-button g-button_orange" value="Отмена">
				</div>
			</div>
		</div>










		<div class="form__rightBox">
			<table class="table">
				<thead class="table__head">
					<tr class="table__row table__cell_border0b1">
						<td class="table__cell table__cell_borderR1 table__cell_ptb28 table__cell_frb13 table__cell_orange">Домашняя</td>
						<td class="table__cell table__cell_ptb28 table__cell_frb13">Диеты</td>
					</tr>
				</thead>
				<tbody class="table__body">
					<tr class="table__row table__cell_border0b1">
						<td class="table__cell table__cell_cr18">Азиатская</td>
						<td class="table__cell">
							<span class="g-count g-count_big"><span class="g-count__val g-count__val_big">99</span></span>
							<div class="table__toggle"></div>
						</td>
					</tr>
					<tr class="table__row table__cell_border0b1">
						<td class="table__cell table__cell_border0b1 table__cell_cr18">Японская</td>
						<td class="table__cell table__cell_border0b1">
							<span class="g-count g-count_big"><span class="g-count__val g-count__val_big">99</span></span>
							<div class="table__toggle"></div>
						</td>
					</tr>
					<tr class="table__row table__cell_border0b1">
						<td class="table__cell table__cell_border0b1 table__cell_cr18">Традиционная</td>
						<td class="table__cell table__cell_border0b1">
							<span class="g-count g-count_big"><span class="g-count__val g-count__val_big">99</span></span>
							<div class="table__toggle"></div>
						</td>
					</tr>
					<tr class="table__row table__row_hidden">
						<td colspan="2" class="table__cell table__cell_pl40 table__cell_bn">
							<table class="table">
								<tbody class="table__body">
									<tr class="table__row table__cell_border0b1">
										<td class="table__cell table__cell_cr16">Торты</td>
										<td class="table__cell">
											<span class="g-count g-count_big"><span class="g-count__val g-count__val_big">99</span></span>
										</td>
									</tr>
									<tr class="table__row table__cell_border0b1">
										<td class="table__cell table__cell_cr16">Напитки</td>
										<td class="table__cell">
											<span class="g-count g-count_big"><span class="g-count__val g-count__val_big">99</span></span>
										</td>
									</tr>
									<tr class="table__row table__cell_border0b1">
										<td class="table__cell table__cell_cr16">Бизнес ланч</td>
										<td class="table__cell">
											<span class="g-count g-count_big"><span class="g-count__val g-count__val_big">99</span></span>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</form>


<div id="js_kitchen_example" style="display: none;">
	<div class="tagBox">
		<input name="DishForm[kitchens][]" type="hidden" value="??val??">
		<span class="tagBox__name">??val??</span>
		<span class="js-remove"></span>
	</div>
</div>


<div id="js_ingr_template" style="display: none;">
	<div class="form__line form__line_mb15 form__line_centeredContent form__line_centeredWidth js_ingr">
		<input name="Dish[ingredients][name][]" class="g-input g-input_w380px g-input_mr0" type="text" placeholder="Укажите ингридиент" value="">
		<div class="form__colVal g-start_center">
			<input name="Dish[ingredients][quantity][]" class="g-input g-input_w100px g-input_pr0 g-input_mr0 g-input_bn" placeholder="0" type="text" value="">
		</div>
		<label class="select_default">
			<select name="Dish[ingredients][measure][]">
				<option value=""></option>
				<?php foreach ($measures as $key => $m): ?>
					<option value="<?= $key ?>"><?= $m ?></option>
				<?php endforeach ?>
			</select>
		</label>
		<div class="form__remove form__remove_orange js_del_parent" data-value="js_ingr"></div>
	</div>
</div>

