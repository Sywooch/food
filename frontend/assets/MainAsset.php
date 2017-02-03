<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/reset.css',
        'css/fonts.css',
        '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css',
        'css/main.css',
        'css/media.css',
        'css/other.css',

        'css/antiReset.css',
        'css/phonenumber.css',
        'libs/jquery-ui/jquery-ui.css',

    ];
    public $js = [
        'libs/jquery/jquery-1.12.2.min.js',
        'libs/fancyBox/jquery.fancybox.js',
        'libs/jquery-ui/jquery-ui.min.js',
        'js/common.js',
        'js/other.js',
        'js/message.js',
        'js/publicationtag.js',
        'js/profilefoto.js',
        'js/saerchpage.js',
        'js/searchmain.js',
        'js/searchMetroHeader.js',
    ];
    public $depends = [
    ];
}
