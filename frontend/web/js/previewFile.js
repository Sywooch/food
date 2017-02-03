$(document).ready(function(){

    function showCoords(c) { 
        // console.log(c);
        $('#x1').val(c.x);
        $('#y1').val(c.y);
        $('#x2').val(c.x2);
        $('#y2').val(c.y2);
        $('#aw').val(c.w);
        $('#ah').val(c.h);
        // variables can be accessed here as
        // c.x, c.y, c.x2, c.y2, c.w, c.h
    };
    function clearInfo() {
        $('#x1').val('');
        $('#y1').val('');
        $('#x2').val('');
        $('#y2').val('');
        $('#aw').val('');
        $('#ah').val('');
    };


    function bytesToSize(bytes) {
        var sizes = ['Bytes', 'KB', 'MB'];
        if (bytes == 0) return 'n/a';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
    };

    var jcrop_api, boundx, boundy;

    var previewFile = function() {
        // var preview = document.querySelector('img');
        // var file = document.querySelector('input[type=file]').files[0];
        // var file    = document.getElementById('fileinput').files[0];
        var file    = $('#fileinput')[0].files[0];
        var preview = document.getElementById('fileimg');
        var div     = $('#filediv');
        var reader  = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
            $('#filesize').val(bytesToSize(file.size));
            $('#filetype').val(file.type);
        }
        preview.onload = function () {
            clearInfo();
            var minImgWidht = 250;
            var minImgHeight = 300;

            var previeHeight = 300;
            var k = previeHeight/this.naturalHeight;
            var previeWidth = Math.floor(k*this.naturalWidth);

            var minAreaWidth = Math.ceil(k*minImgWidht);
            var minAreaHeight = Math.ceil(k*minImgHeight);

            $('#fileimg').width(previeWidth);
            $('#fileimg').height(previeHeight);
            $('#pw').val(previeWidth);
            $('#ph').val(previeHeight);

            $('#iw').val(this.naturalWidth);
            $('#ih').val(this.naturalHeight);

            div.slideDown();

            if (typeof jcrop_api != 'undefined') {
                jcrop_api.destroy();
                jcrop_api = null;
            }

            $('#fileimg').Jcrop({
                // maxSize: [300,300],
                minSize: [minAreaWidth,minAreaHeight],
                onSelect: showCoords,
                onChange: showCoords,
                bgColor:     'black',
                bgOpacity:   .3,
                // setSelect:   [ 100, 100, 50, 50 ],
                aspectRatio: 250 / 300
                // onRelease: clearInfo
            }, function(){
                jcrop_api = this;
            });
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
            div.slideUp();
        }
    }

    $('#fileinput').on('change', previewFile);

});