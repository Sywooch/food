$(document).ready(function(){

    var closeAdd = function (event) {
        $('body').removeClass('oh');
        var popup = $('#js_foto_popup');
        popup.removeClass('show');
    }
    var showPopup = function(event) {
        $('body').addClass('oh');
        var popup = $('#js_foto_popup');
        popup.addClass('show');
    }
    $('#js_foto_showpopup').on('click', showPopup);
    $('#js_foto_popup').on('click', '#js_foto_closeadd', closeAdd);

});