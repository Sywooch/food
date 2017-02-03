$(document).ready(function(){

    $('#js_publicationtag_tagplace').on('click', '.js_publicationtag_deletetag', function(event) {
        $(event.target).parents('.js_publicationtag_tag').remove();
    });

    $('#js_publicationtag_inputheader').keyup(function(event){
        if (
            event.keyCode == 37 || 
            event.keyCode == 38 || 
            event.keyCode == 39 || 
            event.keyCode == 40
        )
        {
            return false;
        }

        var val = $(event.target).val();
        if (val != '') {
            $.ajax({
                url: '/user/publication-search-tag/',
                type: "GET",
                data: 'q='+val,
                success: function (data) {
                    $('#js_publicationtag_tagdatalist').html(data);
                }
            });
        } else {
            $('#js_publicationtag_tagdatalist').html('');
            return false;
        }
    });

    $('#js_publicationtag_inputheader').keypress(function(event){
        if(event.keyCode == 13)
        {
            var header = $(this).val();
            if (header=='') { return false; }
            var template = $('#js_publicationtag_template').html();
            var tagplace = $('#js_publicationtag_tagplace');
            template = template.replace(/\?\?header\?\?/g, header);
            tagplace.append(template);
            $(this).val('');
            event.preventDefault();
            return false;
        }
    });

});
