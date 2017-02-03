<?php
namespace frontend\models;

class PjaxAsset extends \yii\widgets\PjaxAsset
{
    public $depends = [
        'frontend\assets\MainAsset',
    ];
}
