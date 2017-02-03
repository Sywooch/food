'use strict';

;(function () {
	$(document).ready(function () {
		showBox(); // Скрываем/показываем нижележащий дополнительный блок
		chooseMessenger(); // Показываем телефоны what's up и viber
		showTableLine(); // По клику на стрелочку выпадает линии в таблице
		deleteBorders(); // удаляем рамочки у верхнего соседа на странице "Мои уведомления"
		// deleteBorders(); // Удаляет бордеры у ячеек
		showInbox(); // По клику на inbox__expand (на присланные сообщения) показывается inbox
		cloneBox(); // По клику на "+" клонируем родителя с классом "form__line"
		removeBox(); // Удаляем строку с телефоном (и не только с телефоном, но пока только с телефоном) по клику на крестик
		showText(); // При наведении на "избранное" показывается текст "Сделать главной"
		// showImg(); // На странице просмотра .js-form__photos
		slider(); // ползунок на странице акции повара
		toggleBox(); // открыть/показать следующий блог по клику на .subheader на странице акции повара
		showSearchList(); // открыть/показать выпадающий список в поиске и по клику можно выбрать кухню из списка
		showTitleBox(); // по клику на стрелочку в сайдбаре выпадает новый заголовок на странице "Повара рядом" - search_dish.php
		removeAttr(); // по клику на карандаш на странице редактирование заказа order_edit.php разрешаем редактирование input
		changeNumber(); // увеличиваем/уменьшаем количество еды в таблице на 1 на странице редактирования заказа order_edit.php
		addBorder(); // Добавить border при клике на элемент из списка на странице "поиск рецепта" search_recipes.php
		removeParent(); // Удаление родителя (себя и соседнего элемента() по клику на крестик на странице "Внутренний поиск" search_inner.php
		// moveSliderDiv(); // Кликаем по слайдеру и двигаем слайды на странице cooker_card/stocks.php
		moveSliderLi(); // Кликаем по слайдеру и двигаем слайды на странице site/index.php
		moveSliderCategories(); // Это третий однотипный слайдер переключает категории на странице поиска
		showTab(); // по клику по блоку показываем background в табах на странице "Редактиование акций повара" cooker/stocks_edit.php
		setText(); // вводим текст и он автоматически копируется из input в баннер на странице правки акций повара cooker/stocks_edit.php
		enterText(); // вводим цифры в ползунке на страницах акций повара stocks.php - запрещаем ввод больше 3 цифр и ввод любых сиволов кроме цифр по mouseup
		addTag(); // вводим тег в input и по нажатию на enter появляется div с введённым названием на странице blog_page
		toggleTab(); // переключаем табы на странице cooker/recipe_edit.php
		initVSlider(); // запускаем вертичкальный слайдер на странице cooker_card/dish.php
		//	likeFood(); // по клику на кнопку "Понравилось", прибавляем +1 к рядом стоящей цифре
		rate(); // проставляем оценку по клику на морковку
		changeImgTab(); // показываем картину в главном окне по клику на её превьюшку
		toggleBlog(); // находим общего родителя, скрываем/показываем блог, а у элемента, по которому кликнули меняем класс
		toggleToHeight(); // скрываем/показываем блог к определённой высоте, а у элемента, по которому кликнули меняем класс
		initHorSlider(); // запускаем слайдер на странице поиска
		showSidebar(); // скрываем/показываем сайдбар
		changeView(); // изменяем просмотр с квадратов на линии
		comment(); // оставляем комментарий в отзывах и прочих местах
		toggleSidebar(); // ??? показываем/скрываем левый сайдбар
		toggeTableCol(); // переключаем количество колонок на главной странице по клику на заголовок колонки
		showOrderStatus(); // переключаетель статуса заказа в профиле повара - "принимаю/не принимаю" заказы в header
		showFallingList(); // показываем выпадающий список при мобильных экранах на странице просмотра профиля повара
		transformBtn(); // изменить кнопку "Заказать" по клику на иконку корзины
		toggleLinedBox(); // показываем/скрываем блок на странице cooker_card/blog_articles.php
		toggleBoxAddBg(); // показываем/скрываем блок, меняем цвет bg для категорий на страницах поиска и не только
		showAllElems(); // показать/скрыть все элементы в текущем блоке

		//plaginSlider(); // запускаем слайдер, который на всех страницах с помощью плагина

		$(window).resize(function () {

			if ($(window).width() > 480) {
				$('.js-toggleLinedBox__box').show();
			}

			if ($(window).width() > 600) {

				$('.js-toggleBoxAddBg__box').css({
					'display': '-ms-flexbox',
					'display': '-webkit-flex',
					'display': 'flex',
					'height': '60px'
				});
			} else {
				$('.js-toggleBoxAddBg__toggle').removeClass('toggled').children().removeClass('toggled');
				$('.js-toggleBoxAddBg__box').css({
					'display': 'none',
					'height': 'auto'
				});
			}

			if ($(window).width() > 600) {} else {}
		});
	});

	function showBox() {
		$('.form__add').on('click', function () {
			$(this).parent().next('.js-hiddenBox').slideToggle();
		});
	}

	function chooseMessenger() {

		// if ( $('.js-messenger__check_whatsUp').is(':checked') ) {
		// 	$('.js-messenger__check_whatsUp').parents('.form__line').nextAll('.js-contentBox').eq(0).find('.js-hiddenBox_whatsUp').show();
		// }
		// if ( $('.js-messenger__check_viber').is(':checked') ) {
		// 	$('.js-messenger__check_viber').parents('.form__line').nextAll('.js-contentBox').eq(0).find('.js-hiddenBox_viber').show();
		// }

		$(document).on('click', '.js-messenger__check_whatsUp', function () {
			$(this).parents('.form__line').nextAll('.js-contentBox').eq(0).find('.js-hiddenBox_whatsUp').slideToggle();
		});

		$(document).on('click', '.js-messenger__check_viber', function () {
			$(this).parents('.form__line').nextAll('.js-contentBox').eq(0).find('.js-hiddenBox_viber').slideToggle();
		});
	}

	function showTableLine() {

		var body = $('.js-showTableLine__body').eq(0);

		// if ( $(window).width() == 320 ) {
		// 	console.log('скрываем всё');
		// 	body.children('tr:gt(0)').hide();
		// }

		$(document).on('click', '.table__toggle', function () {

			$(this).toggleClass('arr_top');

			if ($(this).hasClass('js-table__toggleMain') && $(window).width() <= 660) {

				if (body.children('tr:gt(0)').is(':visible')) {
					body.children('tr:gt(0)').hide();
					body.children('tr:gt(0)').find('.table__toggle').removeClass('arr_top');
					body.children('.table__row_hidden').css('display', 'none');
				} else {
					body.children('tr:gt(0)').show();

					body.children('tr:gt(0)').find('.table__toggle').removeClass('arr_top');
					body.children('.table__row_hidden').css('display', 'none');
				}
			} else {
				if ($(this).parents('.table__row').eq(0).next().css('display') == 'none') {
					$(this).parents('.table__row').eq(0).next().css('display', 'table-row');
				} else {
					$(this).parents('.table__row').eq(0).next().css('display', 'none');
				}
			}
		});
	}

	function deleteBorders() {
		$('.js-list__item_newMsg').prev().addClass('list__item_bn');
		// $('.js-list__item_hover').hover(function(){
		// 	$(this).addClass('list__item_bn');
		// });
		// $('.js-list__item_hover').on('mouseenter', function(){
		// 	$(this).addClass('list__item_bn');
		// 	$(this).prev().addClass('list__item_bn');
		// });
		// $('.js-list__item_hover').on('mouseleave', function(){
		// 	$(this).addClass('list__item_bn');
		// 	$(this).prev().removeClass('list__item_bn');
		// });
	}

	function showInbox() {
		// $('.inbox__expand').on('click', function(){
		// 	$('.inbox__wrapper').slideToggle();
		// });
		$('.js-showInbox__but').on('click', function () {
			$(this).siblings('.js-showInbox__box').slideToggle();
		});
	}

	function cloneBox() {

		$(document).on('click', '.messenger__plus', function () {

			if ($(this).parents('.form__line').eq(0).siblings('.js-contentBox').length == 3) {
				return; // если телефонов 3, то удаляем их
			}

			var box = $(this).parents('.form__line').eq(0); // находим блок с телефоном
			var cloneBox = box.clone(); // клонируем его
			var wrapMessenger = $(this).parents('.form__line').nextAll('.js-contentBox').eq(0); // находим блок, содержащий what's up и viber
			var cloneWrapMessenger = wrapMessenger.clone(); // Клонируем его

			cloneBox.find('.messenger__check').removeAttr('checked'); // если у самых первых двух чекбоксов галочки стоят, то и у клонированных они тоже стоять будут, поэтому удаляем галочки у клонированных чекбоксов
			$(cloneBox).find('.messenger__plus').addClass('messenger__remove').removeClass('messenger__plus'); // меняем плюс на крест у нового телефона

			// $(box).next('.js-contentBox').after(cloneBox).hide(); // Вставляеми клонированный блок с телефоном после последнего блока с what's up и viber, а также по дефолту скрываем его так же как и чекбоксы
			// $(wrapMessenger).next('.form__line').after(cloneWrapMessenger); // Вставляем клонированный блок с what's up и viber после следующего блока с телефоном

			$('.js-before').before(cloneBox); // Вставляеми клонированный блок с телефоном после последнего блока с what's up и viber, а также по дефолту скрываем его так же как и чекбоксы
			$('.js-before').before(cloneWrapMessenger);
			$(cloneWrapMessenger).children().hide();
		});
	}

	function removeBox() {

		$(document).on('click', '.messenger__remove', function () {

			$(this).parents('.form__line').eq(0).next('.js-contentBox').remove();
			$(this).parents('.form__line').eq(0).remove(); // удаляем блок с what's up и viber
		});
	}

	function showText() {

		// $('.form__favorite').hover(function() {
		$('.lblBox_fav').hover(function () {
			$(this).siblings('.js-form__hoveredText').fadeToggle();
		});
	}

	// function showImg() {

	// 	$('.js-form__photo').on('click', function(){
	// 		$(this).children('.form__img').addClass()
	// 	});
	// }

	function slider() {

		// var minVal = $('#amountMin').val();

		$(function () {

			$('#slider-range_order').slider({
				range: true,
				min: 0,
				max: 120,
				values: [0, 90],
				slide: function slide(event, ui) {
					$('#amountMin_order').val(ui.values[0]);
					$('#amountMax_order').val(ui.values[1]);
				}
			});

			$('#amountMin_order').val($('#slider-range_order').slider('values', 0));
			$('#amountMax_order').val($('#slider-range_order').slider('values', 1));
		});

		$(function () {

			var minVal = $('#amountMin').val();
			var maxVal = $('#amountMax').val();

			// console.log(minVal+', '+maxVal);

			$('#slider-range').slider({
				range: true,
				min: 0,
				max: 120,
				values: [0, 90],
				slide: function slide(event, ui) {
					$('#amountMin').val(ui.values[0]);
					$('#amountMax').val(ui.values[1]);
				}
			});

			$('#amountMin').val($('#slider-range').slider('values', 0));
			$('#amountMax').val($('#slider-range').slider('values', 1));

			$(document).keydown(function (e) {});
		});
	}

	// function handleSlider() {

	//     $(".slider-range").each(function () {

	//         var $this = $(this);
	//         var key = $this.data("key");
	//         var nFormat = '# ###,000';
	//         var nLocale = 'ru';
	//         //var fieldset = $(this).parents('fieldset'+'#fs_'+key);
	//         var fieldset = $(this).parents('.slider-parent');
	//         var imin = fieldset.find('input[type=text]:first');
	//         var imax = fieldset.find('input[type=text]:last');
	//         var vmin = 0;        //slider min value
	//         var vmax = 3500000; //slider max value
	//         var cmin = Number(imin.val().replace(/[^0-9]/g, ''));              //current min value
	//         var cmax = Number(imax.val().replace(/[^0-9]/g, ''));             //current max value

	//         if (typeof gFilterVal[key] != 'undefined') {
	//             if (typeof gFilterVal[key].min_val != 'undefined') {
	//                 vmin = gFilterVal[key].min_val;
	//             }

	//             if (typeof gFilterVal[key].max_val != 'undefined') {
	//                 vmax = gFilterVal[key].max_val;
	//             }
	//         }
	//         $this.slider({
	//             range: true,
	//             min: vmin,
	//             max: vmax,
	//             values: [cmin, cmax],
	//             slide: function (event, ui) {
	//                 imin.val(ui.values[ 0 ]);
	//                 imax.val(ui.values[ 1 ]);
	//                 if (ui.values[ 0 ] > 999) {
	//                     imin.formatNumber({format: nFormat, locale: nLocale});
	//                 }
	//                 if (ui.values[ 1 ] > 999) {
	//                     imax.formatNumber({format: nFormat, locale: nLocale});
	//                 }
	//             }
	//         });

	//         imin.val($this.slider("values", 0));
	//         imax.val($this.slider("values", 1));

	//         if ($this.slider("values", 0) > 999) {
	//             imin.formatNumber({format: nFormat, locale: nLocale});
	//         }

	//         if ($this.slider("values", 1) > 999) {
	//             imax.formatNumber({format: nFormat, locale: nLocale});
	//         }

	//         imin.on('change keyup input click', function (e) {
	//             var tmpval = this.value;
	//             if (this.value.match(/[^0-9]/g)) {
	//                 tmpval = this.value.replace(/[^0-9]/g, '');
	//             }
	//             if (e.type != 'keyup' && e.type != 'input') {
	//                 if (tmpval > vmax) {
	//                     tmpval = vmax;
	//                 } else if (tmpval < vmin) {
	//                     tmpval = vmin;
	//                 }
	//             }
	//             $this.slider('values', 0, tmpval);
	//             //imin.formatNumber({format:"# ###,00", locale:"ru"});
	//         });
	//         //imax.attr('readonly', true);
	//         imax.on('change keyup input click', function (e) {
	//             var tmpval = this.value;
	//             if (this.value.match(/[^0-9]/g)) {
	//                 tmpval = this.value.replace(/[^0-9]/g, '');
	//             }
	//             if (e.type != 'keyup' && e.type != 'input') {
	//                 if (tmpval > vmax) {
	//                     tmpval = vmax;
	//                 } else if (tmpval < vmin) {
	//                     tmpval = vmin;
	//                 }
	//             }
	//             $this.slider('values', 1, tmpval);

	//             //imax.formatNumber({format:"# ###,00", locale:"ru"});
	//         });
	//     });
	// }

	function toggleBox() {

		$('.subHeader').on('click', function () {
			$(this).toggleClass('subHeader_showed').next().slideToggle();
		});
	}

	function showSearchList() {

		$('.js-searchBox__arr, .js-searchBox__header').on('click', function () {
			// if ( $(this).siblings('.searchBox__list').is(':hidden') ) {
			// 	$(this)
			// 		.siblings('.searchBox__list').slideDown()
			// 		.siblings('.js-input_searchBox').addClass('g-input_searchBox');
			// } else {
			// 	$(this)
			// 		.siblings('.searchBox__list').slideUp()
			// 		.queue(function(){
			// 			$(this).siblings('.js-input_searchBox').removeClass('g-input_searchBox');
			// 		});
			// }

			// function hideBox () {

			// 	$('.searchBox__list:visible').parents('.searchBox').toggleClass('searchBox_zi2').end().slideUp().queue(function(){
			// 			$(this).siblings('.js-input_searchBox').removeClass('g-input_searchBox');
			// 			$(this).dequeue();
			// 		});;

			// }

			// hideBox();

			if ($(this).siblings('.searchBox__list').is(':hidden')) {
				$(this).siblings('.searchBox__list').slideDown().siblings('.js-input_searchBox').addClass('g-input_searchBox');
			} else if ($(this).siblings('.searchBox__list').is(':visible')) {
				$(this).siblings('.searchBox__list').slideUp().queue(function () {
					$(this).siblings('.js-input_searchBox').removeClass('g-input_searchBox');
					$(this).dequeue();
				});
			}
		});

		$('.searchBox__listItem').on('click', function () {

			var dataVal = $(this).attr('data-value');

			$(this).parent().siblings('.js-input_searchBox').text($(this).text()); // для div
			$(this).parent().siblings('.js-input_searchBox').val($(this).text()); // для input
			$(this).parent().siblings('.js-hidden_input').val(dataVal);
			$(this).parent().siblings('.js-input_searchBox').removeClass('g-input_searchBox').end().hide();
			// $(this).parent().siblings('.js-input_searchBox').removeClass('g-input_searchBox').end().hide();
		});

		$(document).on('click', '.l-mainWrapper', function (e) {
			var element = $(e.target); // e - событие, target - элемент, по которому мы кликнули
			if (!element.hasClass('js-input_searchBox') && !element.hasClass('js-searchBox__arr') && !element.hasClass('searchBox__listItem')) {
				$('.js-input_searchBox').siblings('.searchBox__list').hide().siblings('.js-input_searchBox').removeClass('g-input_searchBox');
			}
		});
	}

	function showTitleBox() {

		// js-showTitleBox

		$('.js-toggleBox__toggle').on('click', function () {
			if ($(this).parents().attr('data-id') == '1') {
				return;
			}
			var container = $(this).parents('.js-showTitleBox').eq(0);

			$(this).parents('.js-toggleBox__box_h65').eq(0).toggleClass('js-toggleBox__box_h65');

			$('.js-showTitleBox').children('.toggleBox__box[data-id="2"]').find('.toggleBox__arr').toggleClass('toggleBox__arr_top');
			// .queue(function(){
			// 	$(this).end().toggleClass('toggleBox__arr_top');
			// 	$(this).dequeue();
			// });

			container.find('.toggleBox__box[data-id="1"]').toggleClass('js-toggleBox__box_h0');
		});

		// $('.js-toggleBox__toggle').on('click', function() {
		// 	$(this).parent().siblings().slideToggle();
		// });

		// $('.js-toggleBox__box').on('click', function() {
		// 	if ($(this).parent().siblings().is(':visible')) {
		// 		$(this).parent().siblings().slideToggle();
		// 	}
		// });
	}

	function removeAttr() {
		$('.js-form__edit_order').on('click', function () {

			var val = $(this).siblings('.form__val').val();
			$(this).siblings('.form__val').removeAttr('readonly').removeAttr('value').attr('placeholder', val).focus();

			// var val = $(this).siblings('.form__val').val();

			// $(this).siblings('.form__val').removeAttr('readonly').removeAttr('value').attr('placeholder', val).focus();

			// $(this).siblings('.form__val').unbind('blur'); // прибиваем событпе blur

			// $(this).siblings('.form__val').on('blur', function () { // назначаем новое событие blue
			// 	$(this).val(val);
			// });
		});
	}

	function changeNumber() {
		$('.js-table__btn_more').on('click', function () {
			var currentNumber = $(this).parent().siblings().text();
			currentNumber++;
			$(this).parent().siblings().text(currentNumber);
		});
		$('.js-table__btn_less').on('click', function () {
			var currentNumber = $(this).parent().siblings().text();
			if (currentNumber == 0) {
				return;
			}
			currentNumber--;
			$(this).parent().siblings().text(currentNumber);
		});
	}

	// function changePrice() {
	// 	$('.js-form__edit_price').on('click', function(){
	// 		$(this).parent().siblings().text()
	// 	});
	// }

	function addBorder() {
		$('.js-addBorder').on('click', function () {
			$(this).toggleClass('recipeList__item_orangeBorder');
		});
	}

	function removeParent() {
		$('.js-removeParent').on('click', function () {
			$(this).parent().remove();
		});
	}

	// function moveSlider(selector) {

	// 	var container = $('.js-slideContainer');
	// 	var item = $('.js-slideContainer > '+selector+' ');
	// 	var itemLast = $('.js-slideContainer > '+selector+':last-child');
	// 	var itemWidth = item.outerWidth(true);

	// 	itemLast.prependTo(container);

	// 	container.css({
	// 		'width': itemWidth*(item.length+1),
	// 		'margin-left': -itemWidth,
	// 	});

	// 	$('.js-left').on('click', function(){
	// 		if ( item.is(':animated') ) {
	// 			return;
	// 		}
	// 		$('.js-slideContainer > '+selector+':first-child').animate({
	// 			'margin-left': itemWidth
	// 		}, 600, 'linear', function(){
	// 			$('.js-slideContainer > '+selector+':last-child').prependTo(container);
	// 			item.css('margin-left', '');
	// 		});
	// 	});

	// 	$('.js-right').on('click', function(){
	// 		if ( item.is(':animated') ) {
	// 			return;
	// 		}
	// 		$('.js-slideContainer > '+selector+':first-child').animate({
	// 			'margin-left': -itemWidth
	// 		}, 600, 'linear', function(){
	// 			$('.js-slideContainer > '+selector+':first-child').appendTo(container);
	// 			item.css('margin-left', '');
	// 		});
	// 	});
	// }

	// function moveSliderDiv() {

	// 	var container = $('.js-slideContainer');
	// 	var item = $('.js-slideContainer > div');
	// 	var itemLast = $('.js-slideContainer > div:last-child');
	// 	var itemWidth = item.outerWidth(true);

	// 	itemLast.prependTo(container);

	// 	container.css({
	// 		'width': itemWidth*(item.length+1),
	// 		'margin-left': -itemWidth,
	// 	});

	// 	$('.js-left').on('click', function(){
	// 		if ( item.is(':animated') ) {
	// 			return;
	// 		}
	// 		$('.js-slideContainer > div:first-child').animate({
	// 			'margin-left': itemWidth
	// 		}, 600, 'linear', function(){
	// 			$('.js-slideContainer > div:last-child').prependTo(container);
	// 			item.css('margin-left', '');
	// 			console.log(item);
	// 		});
	// 	});

	// 	$('.js-right').on('click', function(){
	// 		if ( item.is(':animated') ) {
	// 			return;
	// 		}
	// 		$('.js-slideContainer > div:first-child').animate({
	// 			'margin-left': -itemWidth
	// 		}, 600, 'linear', function(){
	// 			$('.js-slideContainer > div:first-child').appendTo(container);
	// 			item.css('margin-left', '');
	// 		});
	// 	});
	// }

	function moveSliderLi() {

		var container = $('.js-slideContainer');
		var item = $('.js-slideContainer > li');
		var itemLast = $('.js-slideContainer > li:last-child');
		var itemWidth = item.outerWidth(true);

		itemLast.prependTo(container);

		// console.log( itemWidth*(item.length+1) );

		container.css({
			'width': itemWidth * (item.length + 1),
			'margin-left': -itemWidth
		});

		$('.js-left').on('click', function () {
			if (item.is(':animated')) {
				return;
			}
			$('.js-slideContainer > li:first-child').animate({
				'margin-left': itemWidth
			}, 600, 'linear', function () {
				$('.js-slideContainer > li:last-child').prependTo(container);
				item.css('margin-left', '');
			});
		});

		$('.js-right').on('click', function () {
			if (item.is(':animated')) {
				return;
			}
			$('.js-slideContainer > li:first-child').animate({
				'margin-left': -itemWidth
			}, 600, 'linear', function () {
				$('.js-slideContainer > li:first-child').appendTo(container);
				item.css('margin-left', '');
			});
		});
	}

	// уже как минимум третий однотипный слайдер

	function moveSliderCategories() {

		var container = $('.js-moveSliderCategoriesContainer');
		var item = $('.js-moveSliderCategoriesContainer > label');
		var itemLast = $('.js-moveSliderCategoriesContainer > label:last-child');
		var itemWidth = item.outerWidth(true);

		itemLast.prependTo(container);

		// console.log( itemWidth*(item.length+1) );

		container.css({
			'width': itemWidth * (item.length + 1),
			'margin-left': -itemWidth
		});

		$('.js-moveSliderCategoriesContainer__left').on('click', function () {
			if (item.is(':animated')) {
				return;
			}

			$('.js-moveSliderCategoriesContainer > label:first-child').animate({
				'margin-left': itemWidth
			}, 300, 'linear', function () {
				$('.js-moveSliderCategoriesContainer > label:last-child').prependTo(container);
				item.css('margin-left', '');
			});

			// $('.js-moveSliderCategoriesContainer > li:last-child').prependTo(container).css({
			// 	'margin-left': -itemWidth
			// }).animate({
			// 	'margin-left': itemWidth
			// }, 300, 'linear', function(){
			// 	item.css('margin-left', '');
			// });

			// $('.js-moveSliderCategoriesContainer > li:first-child').animate({
			// 	'margin-left': itemWidth
			// }, 300, 'linear', function(){
			// 	$('.js-moveSliderCategoriesContainer > li:last-child').prependTo(container);
			// 	item.css('margin-left', '');
			// });
		});

		$('.js-moveSliderCategoriesContainer__right').on('click', function () {
			if (item.is(':animated')) {
				return;
			}
			$('.js-moveSliderCategoriesContainer > label:first-child').animate({
				'margin-left': -itemWidth
			}, 300, 'linear', function () {
				$('.js-moveSliderCategoriesContainer > label:first-child').appendTo(container);
				item.css('margin-left', '');
			});
		});
	}

	function showTab() {

		var current; // data-value выделенного элемента

		$('.js-showTab__hidden').attr('data-id', $('.js-tab').data('id'));
		$('.js-tabCont').on('click', function () {
			current = $(this).data('id');
			$(this).parents('.tabsBox').eq(0).siblings('.js-showTab__hidden').attr('data-id', current);
			$(this).addClass('js-tab').siblings().removeClass('js-tab');
			$('.js-tabBg[data-id=' + current + ']').fadeIn().siblings().fadeOut();
		});
	}

	function setText() {

		var maxTextString = 200;
		var maxTitleString = 50;
		var div = $('.js-tabBg').find('.sliderBox__text');
		var header = $('.js-tabBg').find('.sliderBox__title');

		$(document).on('change keyup paste', '#descr', function (e) {
			var currentText = $(this).val();
			if (currentText.length > maxTextString) {
				e.preventDefault();
				var cutText = currentText.slice(0, maxTextString - 1);
				$(this).val(cutText);
			}
			var currentText = $(this).val();
			div.text(currentText);
		});

		$(document).on('keydown', '#descr', function (e) {
			var currentText = $(this).val();
			if (currentText.length > maxTextString) {
				e.preventDefault();
			}
		});

		$(document).on('change keyup paste', '#header', function (e) {
			var currentText = $(this).val();
			if (currentText.length > maxTitleString) {
				e.preventDefault();
				var cutText = currentText.slice(0, maxTitleString - 1);
				$(this).val(cutText);
			}
			var currentText = $(this).val();
			header.text(currentText);
		});

		$(document).on('keydown', '#header', function (e) {
			var currentText = $(this).val();
			if (currentText.length > maxTitleString) {
				e.preventDefault();
			}
		});
	}

	function enterText() {

		var mainVal = 120; // максимальное значение цифры
		var parentWidth = $('.slidesBox__range').outerWidth(); // ширина слайдера: 400

		$(document).on('change keyup paste keydown', '#amountMin, #amountMax', function (e) {
			validate(e);

			var minNumb = $('#amountMin').val() * 1;
			var maxNumb = $('#amountMax').val() * 1;

			if (minNumb.length > 3) {
				minNumb = minNumb.slice(0, 3);
			}
			if (maxNumb.length > 3) {
				maxNumb = maxNumb.slice(0, 3);
			}

			if (minNumb > mainVal) {
				minNumb = mainVal;
			}
			if (maxNumb > mainVal) {
				maxNumb = mainVal;
			}

			// if ( minNumb > maxNumb ) {
			// 	maxNumb = minNumb;
			// 	$('#amountMax').val(maxNumb);
			// }

			$('#amountMin').val(minNumb);
			$('#amountMax').val(maxNumb);

			searchPosition(minNumb, maxNumb);
		});

		$(document).on('change keyup paste keydown', '#amountMin', function (e) {
			var minNumb = $('#amountMin').val() * 1;
			var maxNumb = $('#amountMax').val() * 1;

			if (minNumb > maxNumb) {
				maxNumb = minNumb;
				$('#amountMin').val(minNumb);
				$('#amountMax').val(maxNumb);
			}

			searchPosition(minNumb, maxNumb);
		});

		$(document).on('change keyup paste keydown', '#amountMax', function (e) {
			var minNumb = $('#amountMin').val() * 1;
			var maxNumb = $('#amountMax').val() * 1;

			var minNumbLen = (minNumb + '').length;
			var maxNumbLen = (maxNumb + '').length;

			if (maxNumbLen == minNumbLen && maxNumb < minNumb) {
				maxNumb = minNumb;
				$('#amountMax').val(maxNumb);
				searchPosition(minNumb, maxNumb);
			}

			if (maxNumb < minNumb && maxNumbLen < minNumbLen) {
				maxNumb = minNumb;
				searchPosition(minNumb, maxNumb);
			}
		});

		function validate(e) {
			var theEvent = e || window.event;
			var key = theEvent.keyCode || theEvent.which;
			key = String.fromCharCode(key);
			var regex = /[0-9]|\./;
			if (!regex.test(key) && e.keyCode !== 8 && e.keyCode !== 13) {
				// 8 - backspace, 13 - enter
				console.log(e.keyCode);
				theEvent.returnValue = false;
				if (theEvent.preventDefault) {
					theEvent.preventDefault();
				}
			}
		}

		function searchPosition(minNumb, maxNumb) {
			var percentMinNumb = minNumb / mainVal * 100 + '%';
			var percentMaxNumb = maxNumb / mainVal * 100 + '%';
			var innerWidth = maxNumb / mainVal * 100 - minNumb / mainVal * 100 + '%';

			// var minValPos = $('#slider-range').children().eq(1).css('left').slice(0, -2); // расстояние слева первого ползунка: 99px  ; вырезаем последние две буквы - px
			// var maxValPos = $('#slider-range').children().eq(2).css('left').slice(0, -2); // расстояние слева второго ползунка: 297px ; вырезаем последние две буквы - px

			// var minValPos = $('#slider-range').children().eq(1).css('left', percentMinNumb);
			// var maxValPos = $('#slider-range').children().eq(2).css('left', percentMaxNumb);
			$('#slider-range').slider('values', 0, minNumb);
			$('#slider-range').slider('values', 1, maxNumb);

			// $('#slider-range').children().eq(0).css({
			// 	'width': innerWidth,
			// 	'left': percentMinNumb
			// });

			// var minValPosPercentage = (minValPos/parentWidth) * 100 + "%"; // переводим в проценты расстояние слева первого ползунка 24.75%
			// var maxValPosPercentage = (maxValPos/parentWidth) * 100 + "%"; // переводим в проценты расстояние слева второго ползунка 74.25%

			// var innerWidth = $('#slider-range').children().eq(0).css('width', maxValPosPercentage - minValPosPercentage); // ширина между двумя ползунками

			// console.log(percentMaxNumb, percentMinNumb, innerWidth);

			// console.log( parentWidth, minValPos, maxValPos, minValPosPercentage, maxValPosPercentage);
		}
		// $(document).on('keydown', '#amountMin, #amountMax', function(e) {

		// 	var val = $(this).val();

		// 	if (val.length > 3) {
		// 		e.preventDefault();
		// 		e.keyCode = 0;
		// 	}
		// });
	}

	function addTag() {
		var input = $('.js-addTag'); // поле ввода
		var tag = $('.js-exampleTag'); // тег
		var container = $('.blog__tagsBox'); // место, куда вставляем тег

		$(document).on('keypress', '.js-addTag', function (e) {
			if (e.keyCode == 13) {
				addTagPlus();
			}
		});

		$(document).on('click', '.js-addTagPlus', function (e) {
			addTagPlus();
		});

		$(document).on('click', '.blog__delete', function (e) {
			$(this).parent().remove();
		});

		function addTagPlus() {
			if (input.val() == '') {
				return;
			}
			tag.clone().appendTo(container).children('.blog__tagText').text(input.val()).siblings('.js-inputHidden').val($(this).val());

			input.val('');
		}
	}

	function toggleTab() {
		var previewFile = function previewFile(e) {
			// console.log('общая');
			var file = $(e.target)[0].files[0]; // input
			var preview = $(e.target).next(); // img
			var reader = new FileReader();

			reader.onloadend = function () {
				// событие при загрузке в reader
				// console.log('загрузили в ридер');
				// console.log(preview);
				// console.log(reader.result);
				preview.attr('src', reader.result);
			};
			preview.onload = function () {};

			if (file) {
				reader.readAsDataURL(file);
			} else {
				preview.attr('src', '');
				// preview.src = "";
				div.slideUp();
			}
		};

		// $(document).on('change', '.js-showUploadedImg__input', previewFile);

		$('.js-showUploadedImg__input').on('change', previewFile);

		// ============================

		var count = $('.js-exampleTab').length;

		var imgBox = '<input class="form__file js-showUploadedImg__input" type="file" />' + '<img data-photo-id=' + count + ' src="../../images/file.png" class="form__newPhoto js-toggleTab__img" />';
		// '<div data-photo-id='+count+' class="form__newPhoto"></div>';

		$('.js-toggleTabLink').on('click', function () {

			$(this).addClass('active').siblings().removeClass('active');

			var active = $(this).attr('data-box');

			$('.js-toggleTab__wrap').children('[data-box=' + active + ']').show().siblings().hide();
		});

		//======================================

		$(document).on('click', '.js-toggleTab__add', function (e) {

			var mainBox = $('.js-toggleTab__hidden').children();

			mainBox.clone().insertBefore($(this)).find('.js-toggleTab__number').text(count).end().find('.js-toggleTab__text').attr('data-text-id', count).end().find('.js-toggleTab__imgBox').html(imgBox).children().attr('data-photo-id', count);

			$(this).prev().on('change', '.js-showUploadedImg__input', previewFile);

			// $(staticAncestors).on(eventName, dynamicChild, function() {});

			count++;
		});

		$(document).on('click', '.js-toggleTab__remove', function (e) {

			$(this).parents('.js-exampleTab').eq(0).remove();
			count--;

			var j = 1;

			$('.js-exampleTab').each(function () {
				$(this).find('.js-toggleTab__number').text(j).end().find('.js-toggleTab__text').attr('data-text-id', j).end()
				// .find('.js-toggleTab__imgBox').html(imgBox)
				.find('.js-toggleTab__imgBox').children().attr('data-photo-id', j).children().attr('data-photo-id', j);

				j++;
			});
		});
	}

	function initVSlider() {

		var container = $('.js-runVSlider__imgsBox');
		var slide = container.children('.dishCard__img');
		var slideHeight = slide.outerHeight(true);
		var lastSlide = container.children().last();
		var firstSlide = container.children().first();

		if (slide.length > 3) {
			$('.js-runVSlider__arrsBox').removeClass('dn');
			container.css({
				'height': slide.length * slideHeight
			});
		}

		// $('.js-runVSlider__prev').on('click', function() {
		// 	if ( container.is(':animated') || container.css('margin-top') == '0px' ) {
		// 		return;
		// 	}
		// 	container.animate({
		// 		'margin-top': '+='+slideHeight
		// 	});
		// });

		// $('.js-runVSlider__next').on('click', function() {
		// 	if ( container.is(':animated') || container.css('margin-top') == -(slide.length-3)*slideHeight+'px' ) {
		// 		return;
		// 	}
		// 	container.animate({
		// 		'margin-top': '-='+slideHeight
		// 	});
		// });

		$('.js-runVSlider__prev').on('click', function () {
			moveVslider('0px', '+');
		});
		$('.js-runVSlider__next').on('click', function () {
			moveVslider(-(slide.length - 3) * slideHeight + 'px', '-');
		});

		function moveVslider(maxVal, direction) {
			if (container.is(':animated') || container.css('margin-top') == maxVal) {
				return;
			}
			container.animate({
				'margin-top': direction + '=' + slideHeight + 'px'
			});
		}
	}

	function initHorSlider() {

		var container = $('.js-initMainSlider');
		var visibleSlides = 5; // количество видимых слайдов
		var slide = container.children('.js-initMainSlider__item');
		var slideWidth = slide.outerWidth(true);

		container.each(function () {

			var child = $(this).children('.js-initMainSlider__item');

			if (child.length > visibleSlides) {

				// var lastSlide = $(this).children().last();
				// var firstSlide = container.children().first();

				$(this).parent().siblings('.js-initMainSlider__prev, .js-initMainSlider__next').removeClass('dn');

				$(this).css({
					'width': child.length * slideWidth,
					'margin-left': -slideWidth
				});

				$(this).children().last().prependTo($(this));
			}
		});

		$('.js-initMainSlider__prev, .js-initMainSlider__next').each(function () {

			$(this).on('click', function () {

				var child = $(this).siblings('.foodList').find('.js-initMainSlider__item');

				var container = $(this).siblings('.foodList').children('.js-initMainSlider');

				if (child.is(':animated')) {
					return;
				}

				var first = child.first();
				var last = child.last();

				if ($(this).hasClass('js-initMainSlider__prev')) {

					first.animate({
						'margin-left': slideWidth
					}, 500, 'linear', function () {
						last.prependTo(container);
						container.children().css('margin-left', '');
					});
				}

				if ($(this).hasClass('js-initMainSlider__next')) {
					first.animate({
						'margin-left': -slideWidth
					}, 500, 'linear', function () {
						first.appendTo(container);
						container.children().css('margin-left', '');
					});
				}
			});
		});

		// $('.js-initMainSlider__prev').on('click', function(){

		// 	var first = container.children('.js-initMainSlider__item').first();
		// 	var last = container.children('.js-initMainSlider__item').last();

		// 	first.animate({
		// 		'margin-left': slideWidth
		// 	}, 500, 'linear', function(){
		// 		last.prependTo(container);
		// 		container.children().css('margin-left', '');
		// 	});

		// });

		// $('.js-initMainSlider__next').on('click', function(){

		// 	var first = container.children('.js-initMainSlider__item').first();
		// 	var last = container.children('.js-initMainSlider__item').last();

		// 	first.animate({
		// 		'margin-left': -slideWidth
		// 	}, 500, 'linear', function(){
		// 		first.appendTo(container);
		// 		container.children().css('margin-left', '');
		// 	});
		// });
	}

	function likeFood() {
		var number = +$('.js-likeFood__count').text();
		$('.toolsBox__name').on('click', function () {
			if ($(this).siblings().hasClass('liked')) {
				// console.log('уже лайкали!');
				return;
			}
			number++;
			// console.log(number);
			$(this).siblings().toggleClass('liked').text(number);
		});
	}

	function rate() {
		$('.js-rate').on('mouseenter', function () {
			$(this).prevAll().addClass('hover');
			$(this).addClass('hover');
			$(this).nextAll().addClass('hover_default');
		});
		$('.js-rate').on('mouseleave', function () {
			$(this).prevAll().removeClass('hover');
			$(this).removeClass('hover');
			$(this).nextAll().removeClass('hover_default');
		});
	}

	function changeImgTab() {
		$('.js-changeImgTab__preview').on('click', function () {
			$('.js-changeImgTab__main[data-id=' + $(this).attr('data-id') + ']').fadeIn().siblings().fadeOut();
		});
	}

	function toggleBlog() {
		$('.js-toggleBlog__toggle').on('click', function () {
			$(this).toggleClass('toggled');
			$(this).parents('.js-toggleBlog__parent').find('.js-toggleBlog__box').slideToggle();
		});
	}

	function toggleToHeight() {

		var mapHeight;

		$(window).resize(function () {

			if ($(window).width() >= 1000) {
				mapHeight = '45vw';
			} else if ($(window).width() > 600 && $(window).width() < 1000) {
				mapHeight = '450px';
			} else if ($(window).width() < 600) {
				mapHeight = '550px';
			}

			$('.js-toggleToHeight__box').height(mapHeight);
		});

		$(document).on('click', '.js-toggleToHeight__toggle', function () {

			if ($('.js-toggleToHeight__box').is(':animated')) {
				return;
			}

			if ($(this).hasClass('toggled')) {
				$(this).text('Свернуть карту');
				console.log(mapHeight);
				$('.js-toggleToHeight__box').animate({
					'height': mapHeight
				}, 500);
			} else {
				$(this).text('Развернуть карту');
				console.log(mapHeight);
				$('.js-toggleToHeight__box').animate({
					'height': $('.js-toggleToHeight__innerBox').outerHeight(true)
				}, 500);
			}

			$(this).toggleClass('toggled');
		});
	}

	function plaginSlider() {

		$('.js-mainSlider').slick({
			infinite: false,
			speed: 300,
			slidesToShow: 4,
			slidesToScroll: 4,
			responsive: [{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
					infinite: true
				}
			}, {
				breakpoint: 600,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			}, {
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}]
		});
	}

	function showSidebar() {}

	function changeView() {

		$('.js-changeView__toggle').on('click', function () {

			var thisDataView = $(this).attr('data-view');
			var siblingDataView = $(this).siblings().attr('data-view');

			$(this).addClass('active').siblings().removeClass('active');

			$(this).parents('.js-changeView').eq(0).find('.js-changeView__box[data-view=' + thisDataView + ']').show();

			$(this).parents('.js-changeView').eq(0).find('.js-changeView__box[data-view=' + siblingDataView + ']').hide();
		});
	}

	function comment() {
		$('.js-comment__init').on('click', function () {
			$(this).siblings('.js-comment__box').show().end().hide();
		});
	}

	function toggleSidebar() {

		$('.js-toggleSidebar__toggle').on('click', function () {

			$(this).toggleClass('close');

			if ($(this).parent().css('left') !== '-44px') {
				$(this).animate({
					'left': '-43px'
				}, 100, 'linear');
				$(this).parent().animate({
					'left': '-44px'
				}, 100, 'linear');
			} else {
				$(this).animate({
					'left': '32px'
				}, 100, 'linear');
				$(this).parent().animate({
					'left': '-325px'
				}, 100, 'linear');
			}
		});
	}

	function showOrderStatus() {
		$('.js-showOrderStatus__toggle').on('click', function () {
			if ($(this).is(':checked')) {
				$(this).parent().nextAll('.js-showOrderStatus__true').show().siblings('.js-showOrderStatus__false').hide();
			} else {
				$(this).parent().nextAll('.js-showOrderStatus__false').show().siblings('.js-showOrderStatus__true').hide();
			}
		});
	}

	function toggeTableCol() {

		$('.js-toggeTableCol__header_left').on('click', function () {

			if ($(window).width() <= 480) {
				return;
			}

			$(this).animate({
				'width': '100%',
				'margin-left': '0%'
			}, 200, 'linear').parent().animate({
				'margin-left': '0%'
			}, 200, 'linear').siblings().animate({
				'left': '66.666666%'
			}, 200, 'linear').children('.js-toggeTableCol__header_right').animate({
				'width': '50%'
			}, 200, 'linear');
		});

		$('.js-toggeTableCol__header_right').on('click', function () {

			if ($(window).width() <= 480) {
				return;
			}

			$(this).animate({
				'width': '100%'
			}, 200, 'linear').parent().animate({
				'left': '33.333333%'
			}, 200, 'linear').siblings().animate({
				'margin-left': '-33.333333%'
			}, 200, 'linear').children('.js-toggeTableCol__header_left').animate({
				'width': '50%',
				'margin-left': '50%'
			}, 200, 'linear');
		});
	}

	function showFallingList() {
		$('.js-showFallingList__toggle').on('click', function () {
			if ($('.js-showFallingList__box').is(':animated')) {
				return;
			}
			if ($('.js-showFallingList__box').is(':visible')) {
				$(this).children('.js-showFallingList__arr').removeClass('s_arrow_active').end().next('.js-showFallingList__box').slideUp();
			} else {
				$(this).children('.js-showFallingList__arr').addClass('s_arrow_active').end().next('.js-showFallingList__box').slideDown();
			}
		});
	}

	function transformBtn() {

		// if ( $('.js-transformBtn').hasClass('inbusket') ) {
		// 	$(this).addClass('toggled');
		// }

		$('.js-transformBtn').on('click', function () {
			$(this).addClass('inbasket');
			// $(this).css({
			// 	'background': '#ee5e29 url("../../images/buy.png") no-repeat',
			// 	'text-indent': '-9999px',
			// 	'border': 'none'
			// }).animate({
			// 	'padding': '0px',
			// 	'width': '37px'
			// }, 200, 'linear');
			$(this).parents('.js-transformBtn__wrap').eq(0).addClass('foodList__footer_awc');
		});
	}

	function toggleLinedBox() {

		$('.js-toggleLinedBox__toggle').on('click', function () {
			if ($(this).parent().next('.js-toggleLinedBox__box').is(':animated')) {
				return;
			}
			$(this).toggleClass('toggled');
			$(this).parent().next('.js-toggleLinedBox__box').toggle();
		});
	}

	function toggleBoxAddBg() {

		$('.js-toggleBoxAddBg__toggle').on('click', function () {
			if ($(this).next('js-toggleBoxAddBg__box').is(':animated')) {
				return;
			}

			$(this).toggleClass('toggled').children().toggleClass('toggled').end().next('.js-toggleBoxAddBg__box').slideToggle();
		});
	}

	function showAllElems() {

		$('.js-showAll__toggle').on('click', function () {

			if ($(this).parent('.js-showAll__box').is(':animated')) {
				return;
			}

			var height = parseInt($(this).parent('.js-showAll__box').css('padding-top')) + parseInt($(this).siblings('.js-showAll__innerBox').height()) + 'px';

			// console.log( height );

			if ($(this).parent('.js-showAll__box').css('height') == '60px') {

				$(this).parent('.js-showAll__box').animate({
					'height': height
				}, 300, 'linear');
			} else {

				$(this).parent('.js-showAll__box').animate({
					'height': '60px'
				}, 300, 'linear');
			}
		});
	}
})();

// $('.js-toggleBoxAddBg__box').hide();
// $('.js-showAll').addClass('js-showAll__toggle');
// $('.js-showAll').removeClass('js-toggleBoxAddBg__toggle');

// $('.js-showAll__box').hide();
// $('.js-showAll').removeClass('js-showAll__toggle');
// $('.js-showAll').addClass('js-toggleBoxAddBg__toggle');
// событие при загрузки в сам тег <img />
// console.log('обытие при загрузки в сам тег <img />');
