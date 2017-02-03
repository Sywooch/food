;(function(){
$(document).ready(function(){

    var timeoutAjaxSearch;

    var intervalSliderright = window.setInterval(function() {
        $('#js_searchmain_sliderright').click();
    }, 4000);

    var urlAutocomplete = '/search-header/';

    $('#js_searchmain_searchquery').focus();

    $('#js_searchmain_searchquery').keyup(function(event){
        clearTimeout(timeoutAjaxSearch);
        if (
            event.keyCode == 37 || 
            // event.keyCode == 38 || 
            event.keyCode == 39  
            // event.keyCode == 40
        )
        {
            return false;
        }

        if (
            event.keyCode == 13
        )
        {
            $('#js_searchmain_searchquery').autocomplete("disable");
            return false;
        }

        var val = $(event.target).val();
        val.trim();
        if (val != '') {
            timeoutAjaxSearch = setTimeout(function() {
                $.ajax({
                    url: urlAutocomplete,
                    type: "GET",
                    data: 'q='+val,
                    // dataType: 'json',
                    success: function (data) {
                        var data = eval("(" + data + ")");
                        // console.log(data);
                        // console.log($('#js_searchmain_searchquery'));
                        $('#js_searchmain_searchquery').autocomplete({
                            autoFocus: true,
                            delay: 700,
                            source: data
                        });
                        // console.log(data);
                        // $('#js_searchmain_datalistsearchquery').html(data);
                    }
                });
            }, 1000);
        }
    }).keydown(function() {
        clearTimeout(timeoutAjaxSearch);
    });

    $('#js_searchmain_labelRadioDish').on('click', function(event) {
        $('#js_searchmain_searchquery').attr('placeholder', 'Поиск по блюдам');
        urlAutocomplete = '/search-header/';
        $('#js_searchmain_searchselectbox').show();
        $('#js_searchmain_searchspacer').show();
        $('#js_searchmain_searchquery').removeClass('w100');
        $('#js_searchmain_searchbox').css({'width':'auto'});
    });
    $('#js_searchmain_labelRadioCook').on('click', function(event) {
        $('#js_searchmain_searchquery').attr('placeholder', 'Поиск по имени кулинара');
        urlAutocomplete = '/search-cook-username/';
        $('#js_searchmain_searchselectbox').hide();
        $('#js_searchmain_searchspacer').hide();
        $('#js_searchmain_searchquery').addClass('w100');
        $('#js_searchmain_searchbox').css({'width':'636px'});
    });

    $('#js_searchmain_popupvideoshow').on('click', function() {
        $('#js_searchmain_popupvideo').addClass('show');
    });
    $('#js_searchmain_popupvideo').on('click', '#js_searchmain_popupvideoclose', function() {
        $('#js_searchmain_popupvideo').removeClass('show');
    });

});
})();
