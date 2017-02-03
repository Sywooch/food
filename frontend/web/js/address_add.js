$(document).ready(function(){

    var addAddress = function() {
        var newAddress = $('#js_address_example'); // блок с новым адресом
        var forAddAddress = $('#js_address_add_example'); // блок для вставки адресов
        var newAddressHtml = newAddress.html(); // То что вставляем
        var existAddress = forAddAddress.children('.js_address_exist'); // Существующие адреса
        var countOfExist = existAddress.length; // Количество существующих адресов
        if (countOfExist < 3) {
            forAddAddress.append(newAddressHtml);
        }
    }
    var delAddress = function () {
        $(this).parents('.js_address_exist').eq(0).remove();
    }
    $('#js_address_button_add').on('click', addAddress);
    $('#js_address_add_example').on('click', '.js_address_button_del', delAddress);

});