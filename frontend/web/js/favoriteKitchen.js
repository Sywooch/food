$(document).ready(function () {

    function favoriteKitchen_addtolist(val) {
        var place = $('#js_favoriteKitchen_place');
        var instance = $('#js_favoriteKitchen_instance');
        var instanceHtml = instance.html();
        var none = place.find('.js_favoriteKitchen_none');
        if (none.length) {
            none.remove();
        }
        instanceHtml = instanceHtml.replace(/\?\?val\?\?/g, val);
        place.append(instanceHtml);
    }

    $('#js_favoriteKitchen_add').keypress(function(event){
        if(event.keyCode == 13)
        {
            var val = $(event.target).val();
            if (val == '') {
                return false;
            }
            favoriteKitchen_addtolist(val);
            $(event.target).val('');
            event.preventDefault();
        }
    });

    $("#js_favoriteKitchen_place").on('click' ,'.js_favoriteKitchen_remove', function(event) {
        $(event.target).parents('.js_favoriteKitchen_item').eq(0).remove();
        var place = $('#js_favoriteKitchen_place');
        var items = place.find('.js_favoriteKitchen_item');
        var none = $('#js_favoriteKitchen_instance_none');
        if (items.length==0) {
            var noneHtml = none.html();
            place.append(noneHtml);
        }
    });

    $('#js_favoriteKitchen_addtolist').on('click', function(event){
        var from = $('#js_favoriteKitchen_add');
        var val = from.val();
        if (val == '') {
            return false;
        }
        favoriteKitchen_addtolist(val);
        from.val('');
    });

});