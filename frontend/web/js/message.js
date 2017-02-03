$(document).ready(function(){

	// window.setInterval( function(){ $.pjax.reload({container:"#messages"}); } , 1000 );

    // Ajax получение новых сообщений:

    $('#js_message_newMessageForm').on('submit', function(event) {
        event.stopPropagation();
        event.preventDefault();
        var url = $(event.target).attr('action');
        var formData = new FormData( $('#js_message_newMessageForm')[0] );
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            dataType: 'html',
            beforeSend: function(){},
            success: function(data, textStatus, jqXHR){
                if(typeof data.error === 'undefined')
                {
                    if (data!='') {
                        $('#js_message_messagesUl').append(data);
                        var lastMessageDateTime = $('#js_message_messagesUl').children('li').last().data('datetime');
                        var lastMessageAuthorId = $('#js_message_messagesUl').children('li').last().data('authorid');
                        $('#js_message_lastMessageDateTime').val(lastMessageDateTime);
                        $('#js_message_lastMessageAuthorId').val(lastMessageAuthorId);
                        // промотка
                        var ul = $('#js_message_messagesUl');
                        var idLast = ul.children('li').last().attr('id');
                        $("#js_messages_scroll").animate({
                            scrollTop: $('#' + idLast).position().top
                        }, 600);
                    }
                }
                else
                {
                    console.log('ERRORS: ' + data.error);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log('ERRORS: ' + textStatus);
                console.log('ERRORS: ' + errorThrown);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    // Запуск получения новых сообщений

	window.setInterval( function(){ $("#js_message_newMessageForm").submit(); } , 2000 );

    // Pjax создание нового сообщения

	$("#messageForm").on("pjax:end", function() {
		$("#js_messageForm_textarea").focus();
	});

    // Печать и отправка нового сообщения

	$(".chatCont").on("keypress", "#js_messageForm_textarea", function(event){
		if ((event.keyCode == 10 || event.keyCode == 13) && event.ctrlKey) {
            var val = this.value;
            if (typeof this.selectionStart == "number" && typeof this.selectionEnd == "number") {
                var start = this.selectionStart;
                this.value = val.slice(0, start) + "\n" + val.slice(this.selectionEnd);
                this.selectionStart = this.selectionEnd = start + 1;
            } else if (document.selection && document.selection.createRange) {
                this.focus();
                var range = document.selection.createRange();
                range.text = "\r\n";
                range.collapse(false);
                range.select();
            }
		}
        if (event.keyCode == 13)
        {
            var text = $(event.target).val();
            if (text=="") { return false; }
            $("#js_messageForm").submit();
            event.preventDefault();
            return false;
        }
    });

    // Ajax получение старых сообщений

    $('#js_message_oldMessageForm').on('submit', function(event) {
        event.stopPropagation();
        event.preventDefault();
        var url = $(event.target).attr('action');
        var formData = new FormData( $('#js_message_oldMessageForm')[0] );
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            dataType: 'html',
            beforeSend: function(){},
            success: function(data, textStatus, jqXHR){
                if(typeof data.error === 'undefined')
                {
                    if (data != '') {
                        var ul = $('#js_message_messagesUl');
                        var idFirst = ul.children('li').first().attr('id');
                        $('#js_message_messagesUl').prepend(data);
                        $("#js_messages_scroll").animate({
                            scrollTop: $("#" + idFirst).position().top
                        }, 0);
                        var firstMessageDateTime = ul.children('li').first().data('datetime');
                        var firstMessageAuthorId = ul.children('li').first().data('authorid');
                        $('#js_message_firstMessageDateTime').val(firstMessageDateTime);
                        $('#js_message_firstMessageAuthorId').val(firstMessageAuthorId);
                    }
                }
                else
                {
                    console.log('ERRORS: ' + data.error);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log('ERRORS: ' + textStatus);
                console.log('ERRORS: ' + errorThrown);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    // Запуск получения старых сообщений

	$("#js_messages_scroll").scroll(function() {
		var top = $(this).scrollTop();
		if (top==0) {
			$("#js_message_oldMessageForm").submit();
		}
	});

});
