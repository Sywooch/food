;(function(){
$(document).ready(function(){

    var timeoutAjaxSearch;

    $('.js_searchMetroHeader_input').keyup(function(event){
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
            $('.js_searchMetroHeader_input').autocomplete("disable");
            return false;
        }

        var val = $(event.target).val();
        val.trim();
        if (val != '') {
            timeoutAjaxSearch = setTimeout(function() {
                $.ajax({
                    url: '/search-metrostation-header/',
                    type: "GET",
                    data: 'q='+val,
                    // dataType: 'json',
                    success: function (data) {
                        var data = eval("(" + data + ")");
                        // console.log(data);
                        // console.log($('.js_searchMetroHeader_input'));
                        $('.js_searchMetroHeader_input').autocomplete({
                            autoFocus: true,
                            delay: 700,
                            source: data
                        });
                    }
                });
            }, 500);
        }
    }).keydown(function() {
        clearTimeout(timeoutAjaxSearch);
    });


});
})();
