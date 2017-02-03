;$(document).ready(function() {
	showBox(); // Скрываем/показываем нижележащий дополнительный блок
	chooseMessenger(); // Показываем телефоны what's up и viber
	showTag(); // По клику на "+" добавляем новый тег
	showTableLine(); // По клику на стрелочку выпадает линии в таблице
	deleteBorders(); // удаляем рамочки у верхнего соседа на странице "Мои уведомления"
	// deleteBorders(); // Удаляет бордеры у ячеек
	showInbox(); // По клику на inbox__expand (на присланные сообщения) показывается inbox
	cloneBox(); // По клику на "+" клонируем родителя с классом "form__line"
	removeBox(); // Удаляем строку с телефоном (и не только с телефоном, но пока только с телефоном) по клику на крестик
	showText(); // При наведении на "избранное" показывается текст "Сделать главной"
});

$(window).resize(function() {

});



function showBox() {
	$('.form__add').on('click', function() {
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


	$(document).on('click', '.js-messenger__check_whatsUp', function(){

		$(this).parents('.form__line').nextAll('.js-contentBox').eq(0).find('.js-hiddenBox_whatsUp').slideToggle();
		
	});

	$(document).on('click', '.js-messenger__check_viber', function(){

		$(this).parents('.form__line').nextAll('.js-contentBox').eq(0).find('.js-hiddenBox_viber').slideToggle();

	});

}


function showTag() {
	$('.blog__add').on('click', function() {
		$(this).siblings('.blog__input').show();
		$(this).hide();
	});
}

function showTableLine() {
	$('.table__toggle').on('click', function() {
		// $(this).parents('.table__row').eq(0).next().slideToggle();

		var hiddenRows = $(this).parents('.table__row').eq(0).next().toggleClass('show');
		// hiddenRows.css('background-color', 'red');
		$(this).toggleClass('arr_top');
		// hiddenRows.toggleClass('show');
		// $(this).parent().css('border-left', 'none');
		


		// $('.table__cell:first-child').css('border-right', 'none !important');
		// console.log($('.table__cell:first-child').length);
		// if ( hiddenRows.css("display") == "none" ) {
		// 	hiddenRows.css('displa');
		// } else {
		// 	hiddenRows.hide();
		// }

		// var height = hiddenRows.height();

		// if ( hiddenRows.css("display") == "none" ) {

		// 	hiddenRows.css({
		// 		'height': '0px',
		// 		'display': 'inline-block',
		// 		'overflow': 'hidden'
		// 	});
		// 	hiddenRows.animate({
		// 		'height': height
		// 	}, 'linear', function(){
		// 		hiddenRows.css({
		// 			'display': 'table-row'
		// 		});
		// 	});

		// } else {

		// 	hiddenRows.css({
		// 		// 'height': '0px',
		// 		'display': 'inline-block',
		// 		'overflow': 'hidden'
		// 	});
		// 	hiddenRows.animate({
		// 		'height': '0px'
		// 	}, 'linear', function(){
		// 		hiddenRows.css({
		// 			'display': 'none',
		// 			'height': height
		// 		});
		// 	});

		// }

		

		// if ( hiddenRows.css("display") == "none" ) {
		// 	console.log(hiddenRows.innerHeight());
			

		// 	hiddenRows.css({
		// 		'height': '0px',
		// 		'display': 'inline-block',
		// 		'overflow': 'hidden'
		// 	});

			
		// 	hiddenRows.animate({
		// 		'height': height
		// 	});

		// } else {
		// 	hiddenRows.css({
		// 		'display': 'inline-block',
		// 		'overflow': 'hidden'
		// 	});

		// 	hiddenRows.animate({
		// 		'height': '0px',
		// 	}, function(){
		// 		hiddenRows.css({
		// 			'display': 'none',
		// 		});
		// 	});

		// }
		// deleteBorders();

	});

	// function deleteBorders(){
	// 	// function (){
	// 	$('.table__cell').css({
	// 		'border-left': 'none !important',
	// 		'border-right': 'none !important'
	// 	});
	// // }
	// }

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
	$('.inbox__expand').on('click', function(){
		$('.inbox__wrapper').slideToggle();
	});
}

function cloneBox() {

	$(document).on('click', '.messenger__plus', function(){

		if ( $(this).parents('.form__line').eq(0).siblings('.js-contentBox').length == 3 ) {
			return; // если телефонов 3, то удаляем их
		}

		var numberForNewPhone = $(this).parents('.form__line').eq(0).siblings('.js-contentBox').length;

		var box = $(this).parents('.form__line').eq(0); // находим блок с телефоном
		var cloneBox = box.clone(); // клонируем его
		// alert($(cloneBox).find('[ProfileCookForm[phonenumber][0][phonenumber]]').length);
		// console.log($(cloneBox).find('#input_phonenumber_0').length);
		$(cloneBox).find('#input_phonenumber_0').attr('name', 'ProfileCookForm[phonenumber]['+numberForNewPhone+'][phonenumber]');
		$(cloneBox).find('#input_whatsapp_0').attr('name', 'ProfileCookForm[phonenumber]['+numberForNewPhone+'][whatsapp]');
		$(cloneBox).find('#input_viber_0').attr('name', 'ProfileCookForm[phonenumber]['+numberForNewPhone+'][viber]');
		var wrapMessenger = $(this).parents('.form__line').nextAll('.js-contentBox').eq(0); // находим блок, содержащий what's up и viber
		var cloneWrapMessenger = wrapMessenger.clone(); // Клонируем его
		$(cloneWrapMessenger).find('#input_whatsappnumber_0').attr('name', 'ProfileCookForm[phonenumber]['+numberForNewPhone+'][whatsappnumber]');
		$(cloneWrapMessenger).find('#input_vibernumber_0').attr('name', 'ProfileCookForm[phonenumber]['+numberForNewPhone+'][vibernumber]');


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

	$(document).on('click', '.messenger__remove', function(){

		$(this).parents('.form__line').eq(0).next('.js-contentBox').remove();
		$(this).parents('.form__line').eq(0).remove(); // удаляем блок с what's up и viber

	});

}

function showText() {

	$('.form__favorite').hover(function() {
		$(this).siblings('.js-form__hoveredText').fadeToggle();
	});
}