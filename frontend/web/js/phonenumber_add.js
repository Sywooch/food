$(document).ready(function(){

    var addPhonenumber = function() {
        var newPhonenumber = $('#js_phonenumber_example'); // блок с новым адресом
        var forAddPhonenumber = $('#js_phonenumber_for_insert'); // блок для вставки адресов
        var existAllPhonenumber = forAddPhonenumber.children('.js_phonenumber_exist'); // Существующие
        var existPhonenumber = forAddPhonenumber.children('.js_phonenumber_existnew'); // Существующие новые
        var existKey = [];
        var maxKey = 0;
        var newPhonenumberHtml = newPhonenumber.html();
        var countOfExist = existPhonenumber.length; // Количество новых
        var countOfExistAll = existAllPhonenumber.length; // Количество всех
        if (countOfExistAll < 3) {
            if (countOfExist != 0) {
                existPhonenumber.each(function(indx, element){
                    existKey.push($(element).data('key'));
                });
                console.log(existKey);
                maxKey = Math.max.apply(null, existKey);
                var newKey = maxKey + 1; // Hовый ключ
            } else {
                var newKey = maxKey; // Hовый ключ
            }
            newPhonenumberHtml = newPhonenumberHtml.replace(/\?\?key\?\?/g, newKey); // Адрес с новым ключем
            forAddPhonenumber.append(newPhonenumberHtml);
        }
    }
    var delFields = function(e) {
        $(this).parents('.js_phonenumber_exist').eq(0).remove();
    }
    $('#js_phonenumber_button_add').on('click', addPhonenumber);
    $('#js_phonenumber_for_insert').on('click', '.js_phonenumber_delete', delFields);

});