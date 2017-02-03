<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class JcropAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'libs/Jcrop/css/jquery.Jcrop.css',
    ];
    public $js = [
        'libs/Jcrop/js/jquery.Jcrop.min.js',
    ];
    public $depends = [
        'frontend\assets\MainAsset',
    ];
}
