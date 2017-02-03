$(document).ready(function () {

    $('#searchnewstag').keyup(function(event){
        if (
            event.keyCode == 37 || 
            event.keyCode == 38 || 
            event.keyCode == 39 || 
            event.keyCode == 40
        )
        {
            return false;
        }

        var val = $('#searchnewstag').val();
        $.ajax({
            url: '/news/searchnewstag/',
            type: "GET",
            data: 'q='+val,
            success: function (data) {
                $('#datanewstag').html(data);
            }
        });
    });
    
    $('#searchnewstag').keypress(function(event){
        if(event.keyCode == 13)
        {
            var header = $('#searchnewstag').val();
            if (header=='') { return false; }
            $("#news-selectednewstag")
                .append("\n"+'<label><input type="checkbox" name="News[selectedNewstag][]" value="'+header+'" checked=""> '+header+'</label>');
            $('#searchnewstag').val('');
            event.preventDefault();
            return false;
        }
    });

    $("#news-selectednewstag").on('click' ,'label', function(event) {
        $(event.target).remove();
    });

});