$(document).ready(function () {

	$('body').on('click', '.js_del_parent', function(event) {
		var del_parent_class = $(event.target).data('value');
		$(event.target).parents('.' + del_parent_class).eq(0).remove();
	});
	$('.js_add_template').on('click', function(event) {
		var idtemplate = $(event.target).data('template');
		var idplace = $(event.target).data('place');
		var template = $('#' + idtemplate);
		var place = $('#' + idplace);
		var templateHtml = template.html();
		place.append(templateHtml);
	});

	$('.js_add_newaddress').on('click', function(event) {
		var newAddress = $('#js_address_example'); // блок с новым адресом
		var forAddAddress = $('#js_addresses'); // блок для вставки адресов
		var newAddressHtml = newAddress.html(); // То что вставляем
		var existAddress = forAddAddress.children('.js_address'); // Существующие адреса
		var countOfExist = existAddress.length; // Количество существующих адресов
		var existNewAddress = forAddAddress.children('.js_newaddress'); // Существующие новые адреса
		var existKey = [];
		var maxKey = 0;
		if (countOfExist < 3) {
			if (existNewAddress.length != 0) {
				existNewAddress.each(function(indx, element){
					existKey.push($(element).data('key'));
				});
				maxKey = Math.max.apply(null, existKey);
				var newKey = ++maxKey; // Hовый ключ
			} else {
				var newKey = maxKey; // Hовый ключ
			}
			newAddressHtml = newAddressHtml.replace(/\?\?key\?\?/g, newKey); // Адрес с новым ключем
			forAddAddress.append(newAddressHtml);
		}
	})

	$('select.select').selectmenu({
		width: 'auto'
	});


	var fotokitchenDel = function(event) {
		$(event.target).parents('.js_fotokitchen_item').eq(0).remove();
	};

	$('.js_fotokitchen_item').on('click', '.js_fotokitchen_del', fotokitchenDel);

	var fotodocDel = function(event) {
		$(event.target).parents('.js_fotodoc_item').eq(0).remove();
	};

	$('.js_fotodoc_item').on('click', '.js_fotodoc_del', fotodocDel);


	$('.select_for_checkbox').on('click', '.drop', function(event) {
		$(event.target).next('.show').slideToggle(200);
	})
	$('.select_for_checkbox').on('click', '.items div', function(event) {
		$(event.target).next('.show').slideUp(200);
		var parent = $(event.target).parents('.select_for_checkbox').eq(0);
		var show = $(event.target).parents('.show').eq(0);
		var val = $(event.target).html();
		var idplace = parent.data('place');
		var idexample = parent.data('example');
		var place = $('#' + idplace);
		var example = $('#' + idexample);
		var exampleHtml = example.html();
		exampleHtml = exampleHtml.replace(/\?\?val\?\?/g, val);
		console.log(place);
		place.append(exampleHtml);
		show.slideUp();
	})

	function handlerLinkToBasket(e) {
		e.preventDefault();
		var
			$link = $(e.target),
			callUrl = $link.attr('href'),
			// idresultwrap = $link.data('ajaxresult'),
			ajaxRequest;
		 
		ajaxRequest = $.ajax({
			type: "get",
			dataType: 'html',
			url: callUrl,
			success: function(html){
				// console.log(idresultwrap);
				// $("#" + idresultwrap).html(html);
			}
		});
	}

	$('.js_product_to_basket').click(handlerLinkToBasket);



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

});