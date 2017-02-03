<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

$this->params['breadcrumbs'][] = ['label' => 'Профиль', 'url' => ['user/profile'], 'class' => 'breadcrumbs__link'];

$this->params['breadcrumbs'][] = ['label' => 'Меню', 'url' => ['user/menu'], 'class' => 'breadcrumbs__link'];

$this->params['breadcrumbs'][] = ['label' => 'Добавить блюдо'];

$this->title = 'Добавить блюдо';

?>

<aside class="l-sidebar l-sidebar_left">

	<?= $this->render('leftcook', [
	]) ?>

</aside>
<div class="g-flexMiddleChild middleWrapper">

	<?= $this->render('menu/topmenu', [
	]) ?>

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




	<form action="<?= Url::to(['user/menuadd']) ?>" method="post" class="form form_hcalc110" enctype="multipart/form-data">
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
									<input name="DishAddForm[header]" type="text" class="form__val form__val_w100" placeholder="Тефтели" value="<?= $dishaddform->header ?>" />
								</div>
								<?php if (isset($dishaddform->errors)&&count($dishaddform->errors)): ?>
									<?php if (isset($dishaddform->errors['header'])): ?>
										<div class="error pl130">
											<?php foreach ($dishaddform->errors['header'] as $error): ?>
												<p><?= $error ?></p>
											<?php endforeach ?>
										</div>
									<?php endif ?>
								<?php endif ?>
								<?php if (isset($dishaddform->errors)&&count($dishaddform->errors)): ?>
									<?php if (isset($dishaddform->errors['model'])): ?>
										<div class="error pl130">
											<?php foreach ($dishaddform->errors['model'] as $error): ?>
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
										<?php foreach ($dishaddform->kitchen as $key => $k): ?>
											<div class="tagBox js_tagkitchen">
												<input name="DishAddForm[kitchen][]" type="hidden" value="<?= $k ?>">
												<span class="tagBox__name">Азиатская</span>
												<span class="js-remove js_del_parent" data-value="js_tagkitchen"></span>
											</div>
										<?php endforeach ?>
									</div>
									<?php if (isset($dishaddform->errors)&&count($dishaddform->errors)): ?>
										<?php if (isset($dishaddform->errors['kitchen'])): ?>
											<div class="error">
												<?php foreach ($dishaddform->errors['kitchen'] as $error): ?>
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
							<div class="form__line form__line_centeredContent">
								<label for="" class="form__label form__label_small">Категория:</label>
								<div class="section_310">
									<label class="select_default">
										<select name="DishAddForm[dishtype_id]">
											<option value=""></option>
											<?php foreach ($dishtypes as $key => $dt): ?>
												<option value="<?= $dt->id ?>"<?= ($dt->id==$dishaddform->dishtype_id)?' selected':'' ?>><?= $dt->header ?></option>
											<?php endforeach ?>
										</select>
									</label>
								</div>
								<?php if (isset($dishaddform->errors)&&count($dishaddform->errors)): ?>
									<?php if (isset($dishaddform->errors['dishtype_id'])): ?>
										<div class="error">
											<?php foreach ($dishaddform->errors['dishtype_id'] as $error): ?>
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
									<input name="DishAddForm[diettrue]" type="checkbox" class="messenger__check js-messenger__check_whatsUp" value="1" />
									<div class="messenger__bg"></div>
								</label>
								<div class="messenger__text">Разместить блюдо в категорию “Диеты”</div>
							</div>
							<?php if (isset($dishaddform->errors)&&count($dishaddform->errors)): ?>
								<?php if (isset($dishaddform->errors['diettrue'])): ?>
									<div class="error">
										<?php foreach ($dishaddform->errors['diettrue'] as $error): ?>
											<p><?= $error ?></p>
										<?php endforeach ?>
									</div>
								<?php endif ?>
							<?php endif ?>
							<label class="select_default">
								<select name="DishAddForm[diet_id]">
									<option value=""></option>
									<?php foreach ($diets as $key => $d): ?>
										<option value="<?= $d->id ?>"><?= $d->header ?></option>
									<?php endforeach ?>
								</select>
							</label>
							<?php if (isset($dishaddform->errors)&&count($dishaddform->errors)): ?>
								<?php if (isset($dishaddform->errors['diet_id'])): ?>
									<div class="error">
										<?php foreach ($dishaddform->errors['diet_id'] as $error): ?>
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
								<input name="DishAddForm[weight]" class="g-input g-input_75px g-input_pr0 g-input_bn g-input_mr0 g-input_pl15" type="text" placeholder="100" value="<?= $dishaddform->weight ?>">
								<div class="form__inputAdd form__inputAdd_orange">гр</div>
							</div>
						</div>
						<div class="form__col">
							<label for="" class="form__label form__label_min">Время приготовления:</label>
							<div class="g-start_center">
								<div class="form__inputAdd">от</div>
								<div class="form__colVal form__colVal_mr10">
									<input name="DishAddForm[timefrom]" class="g-input g-input_w100px g-input_pr0 g-input_mr0 g-input_bn g-input_tac" type="text" placeholder="100" value="<?= $dishaddform->timefrom ?>">
								</div>
								<div class="form__inputAdd">до</div>
								<div class="form__colVal form__colVal_mr10">
									<input name="DishAddForm[timeto]" class="g-input g-input_w100px g-input_pr0 g-input_mr0 g-input_bn g-input_tac" type="text" placeholder="100" value="<?= $dishaddform->timeto ?>">
								</div>
								<div class="form__inputAdd form__inputAdd_orange">мин</div>
							</div>
						</div>
						<div class="form__col">
							<label for="" class="form__label form__label_min">Цена:</label>
							<div class="form__colVal form__colVal_widthCenter form__colVal_w125">
								<input name="DishAddForm[price]" class="g-input g-input_75px g-input_pr0 g-input_bn g-input_w65 g-input_mr0 g-input_pl15" type="text" placeholder="100" value="<?= $dishaddform->price ?>">
								<div class="form__inputAdd form__inputAdd_orange">руб</div>
							</div>
						</div>
						<div class="form__col">
							<label for="" class="form__label form__label_min">Цена (акция):</label>
							<div class="form__colVal form__colVal_widthCenter form__colVal_w125">
								<input name="DishAddForm[pricesale]" class="g-input g-input_75px g-input_pr0 g-input_bn g-input_w65 g-input_mr0 g-input_pl15" type="text" placeholder="100" value="<?= $dishaddform->pricesale ?>">
								<div class="form__inputAdd form__inputAdd_orange">руб</div>
							</div>
						</div>
					</div>
				</div>
					<?php if (isset($dishaddform->errors)&&count($dishaddform->errors)): ?>
						<div class="error pl150">
							<?php if (isset($dishaddform->errors['weight'])): ?>
								<?php foreach ($dishaddform->errors['weight'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							<?php endif ?>
							<?php if (isset($dishaddform->errors['timefrom'])): ?>
								<?php foreach ($dishaddform->errors['timefrom'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							<?php endif ?>
							<?php if (isset($dishaddform->errors['timeto'])): ?>
								<?php foreach ($dishaddform->errors['timeto'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							<?php endif ?>
							<?php if (isset($dishaddform->errors['price'])): ?>
								<?php foreach ($dishaddform->errors['price'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							<?php endif ?>
							<?php if (isset($dishaddform->errors['pricesale'])): ?>
								<?php foreach ($dishaddform->errors['pricesale'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							<?php endif ?>
						</div>
					<?php endif ?>
				<div class="form__section form__section_pr20">
					<div class="form__line">
						<label for="" class="form__label form__label_w150">Описание:</label>
						<textarea name="DishAddForm[text]" class="form__val form__val_big section_wcalc150" name="" placeholder="..."><?= $dishaddform->text ?></textarea>
						<?php if (isset($dishaddform->errors)&&count($dishaddform->errors)): ?>
							<div class="error pl150">
								<?php if (isset($dishaddform->errors['text'])): ?>
									<?php foreach ($dishaddform->errors['text'] as $error): ?>
										<p><?= $error ?></p>
									<?php endforeach ?>
								<?php endif ?>
							</div>
						<?php endif ?>
					</div>
					<div class="form__line form__line_ml150">
						<div class="form__title">Информация, для меню "Диеты"</div>
						<div class="form__colBox form__colBox_pt15">
							<div class="form__col">
								<label for="" class="form__label form__label_min">Энергетическая ценность на порцию:</label>
								<div class="form__colVal form__colVal_widthCenter form__colVal_w180">
									<input name="DishAddForm[calories]" class="g-input g-input_w115 g-input_pr0 g-input_mr0 g-input_bn g-input_mr0 g-input_pl15" type="text" placeholder="100" value="<?= $dishaddform->calories ?>">
									<div class="form__inputAdd form__inputAdd_orange">калл</div>
								</div>
							</div>
							<div class="form__col">
								<label for="" class="form__label form__label_min">Белки:</label>
								<div class="form__colVal form__colVal_widthCenter form__colVal_w125">
									<input name="DishAddForm[proteins]" class="g-input g-input_75px g-input_pr0 g-input_bn g-input_mr0 g-input_pl15" type="text" placeholder="100" value="<?= $dishaddform->proteins ?>">
									<div class="form__inputAdd form__inputAdd_orange">гр</div>
								</div>
							</div>
							<div class="form__col">
								<label for="" class="form__label form__label_min">Жиры:</label>
								<div class="form__colVal form__colVal_widthCenter form__colVal_w125">
									<input name="DishAddForm[fats]" class="g-input g-input_75px g-input_pr0 g-input_bn g-input_mr0 g-input_pl15" type="text" placeholder="100" value="<?= $dishaddform->fats ?>">
									<div class="form__inputAdd form__inputAdd_orange">гр</div>
								</div>
							</div>
							<div class="form__col">
								<label for="" class="form__label form__label_min">Углеводы:</label>
								<div class="form__colVal form__colVal_widthCenter form__colVal_w125">
									<input name="DishAddForm[carbohydrates]" class="g-input g-input_75px g-input_pr0 g-input_bn g-input_mr0 g-input_pl15" type="text" placeholder="100" value="<?= $dishaddform->carbohydrates ?>">
									<div class="form__inputAdd form__inputAdd_orange">гр</div>
								</div>
							</div>
							<?php if (isset($dishaddform->errors)&&count($dishaddform->errors)): ?>
								<?php if (isset($dishaddform->errors['calories'])): ?>
									<div class="error">
										<?php foreach ($dishaddform->errors['calories'] as $error): ?>
											<p><?= $error ?></p>
										<?php endforeach ?>
									</div>
								<?php endif ?>
							<?php endif ?>
							<?php if (isset($dishaddform->errors)&&count($dishaddform->errors)): ?>
								<?php if (isset($dishaddform->errors['proteins'])): ?>
									<div class="error">
										<?php foreach ($dishaddform->errors['proteins'] as $error): ?>
											<p><?= $error ?></p>
										<?php endforeach ?>
									</div>
								<?php endif ?>
							<?php endif ?>
							<?php if (isset($dishaddform->errors)&&count($dishaddform->errors)): ?>
								<?php if (isset($dishaddform->errors['fats'])): ?>
									<div class="error">
										<?php foreach ($dishaddform->errors['fats'] as $error): ?>
											<p><?= $error ?></p>
										<?php endforeach ?>
									</div>
								<?php endif ?>
							<?php endif ?>
							<?php if (isset($dishaddform->errors)&&count($dishaddform->errors)): ?>
								<?php if (isset($dishaddform->errors['carbohydrates'])): ?>
									<div class="error">
										<?php foreach ($dishaddform->errors['carbohydrates'] as $error): ?>
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
					<div class="form__line form__line_centeredContent form__line_mb0">
						<label for="" class="form__label form__label_w150">Фото блюда:</label>
						<div class="section_dib section_wcalc150">
							<label class="g-link">Добавить фотографии
								<input name="DishAddForm[fotos][]" type="file" accept="image/jpeg,image/png" style="display:none" multiple>
							</label>
						</div>
					</div>
					<?php if (isset($dishaddform->errors)&&count($dishaddform->errors)): ?>
						<?php if (isset($dishaddform->errors['fotos'])): ?>
							<div class="error pl150 mb15">
								<?php foreach ($dishaddform->errors['fotos'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					<?php endif ?>
				</div>
				<div class="form__border"></div>
				<h4 class="form__header">Ингредиенты:</h4>
				<div class="form__section form__section_center form__section_pr20">
					<label for="" class="form__label form__label_wa form__label_mb15">Добавить:</label>

<?php if ($dishaddform->ingredients): ?>
	<div class="js_ingrs">
	<?php foreach ($dishaddform->ingredients['name'] as $key => $name): ?>
		<div class="form__line form__line_mb15 form__line_centeredContent form__line_centeredWidth js_ingr">
			<input name="DishAddForm[ingredients][name][]" class="g-input g-input_w380px g-input_mr0" type="text" placeholder="Укажите ингридиент ..." value="<?= $name ?>">
			<div class="form__colVal g-start_center">
				<input name="DishAddForm[ingredients][quantity][]" class="g-input g-input_w100px g-input_pr0 g-input_mr0 g-input_bn" placeholder="0" type="text" value="<?= $dishaddform->ingredients['quantity'][$key] ?>">
			</div>
			<label class="select_default">
				<select name="DishAddForm[ingredients][measure][]">
					<option value=""></option>
					<?php foreach ($dishaddform->measures as $i => $m): ?>
						<option value="<?= $i ?>"<?= ($i==$dishaddform->ingredients['measure'][$key])?' selected':'' ?>><?= $m ?></option>
					<?php endforeach ?>
				</select>
			</label>
			<div class="form__remove form__remove_orange js_del_parent" data-value="js_ingr"></div>
		</div>
	<?php endforeach ?>
	</div>
<?php else: ?>
	<div class="form__line form__line_mb15 form__line_centeredContent form__line_centeredWidth js_ingr">
		<input name="DishAddForm[ingredients][name][]" class="g-input g-input_w380px g-input_mr0" type="text" placeholder="Укажите ингридиент" value="">
		<div class="form__colVal g-start_center">
			<input name="DishAddForm[ingredients][quantity][]" class="g-input g-input_w100px g-input_pr0 g-input_mr0 g-input_bn" placeholder="0" type="text" value="">
		</div>
		<label class="select_default">
			<select name="DishAddForm[ingredients][measure][]">
				<option value=""></option>
				<?php foreach ($dishaddform->measures as $key => $m): ?>
					<option value="<?= $key ?>"><?= $m ?></option>
				<?php endforeach ?>
			</select>
		</label>
		<div class="form__remove form__remove_orange js_del_parent" data-value="js_ingr"></div>
	</div>
<?php endif ?>



					<?php if (isset($dishaddform->errors)&&count($dishaddform->errors)): ?>
						<?php if (isset($dishaddform->errors['ingredients'])): ?>
							<div class="error">
								<?php foreach ($dishaddform->errors['ingredients'] as $error): ?>
									<p><?= $error ?></p>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					<?php endif ?>

					<div class="g-link js_add_template mb15" data-place="js_ingrs" data-template="js_ingr_template">Добавить ингредиент</div>

				</div>
				<div class="form__border"></div>
				<h4 class="form__header">Видеопрезентация:</h4>
				<div class="form__section form__section_pr20">
					<div class="form__line form__line_centeredContent">
						<label for="" class="form__label form__label_w150">Видео:</label>
						<input name="DishAddForm[video]" type="text" class="g-input g-input_w380px g-input_mr0" placeholder="https://youtu.be/LiNk" value="">
						<?php if (isset($dishaddform->errors)&&count($dishaddform->errors)): ?>
							<?php if (isset($dishaddform->errors['video'])): ?>
								<div class="error">
									<?php foreach ($dishaddform->errors['video'] as $error): ?>
										<p><?= $error ?></p>
									<?php endforeach ?>
								</div>
							<?php endif ?>
						<?php endif ?>
					</div>
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
	<div class="tagBox js_tagkitchen">
		<input name="DishAddForm[kitchen][]" type="hidden" value="??val??">
		<div class="tagBox__name">??val??</div>
		<span class="js-remove js_del_parent" data-value="js_tagkitchen"></span>
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




</div>
<aside class="l-sidebar l-sidebar_right">

	<?= $this->render('right', [
	]) ?>

</aside>