// ;(function(){
$(document).ready(function(){

	$('.js_saerchpage_inputDishTypeID').on('click', function(event) {
		// if( $(event.target).prop("checked") ) {
			$('#js_saerchpage_form_dishtype_id').submit();
		// }
	})
	$('.js_saerchpage_input_kitchen_ids').on('click', function(event) {
		// if( $(event.target).prop("checked") ) {
			$('#js_saerchpage_form_kitchen_ids').submit();
		// }
	})
	$('.js_saerchpage_inputViewType').on('click', function(event) {
		if( $(event.target).prop("checked") ) {
			$('#js_saerchpage_form_wide').submit();
		}
	})

});
// })();
