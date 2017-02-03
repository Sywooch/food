<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'aliases' => [
        '@webfrontend' => 'http://www.food.local',
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [

                // MainPage
                '' => 'site/index',

                // Partner
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'partner/<action:(create|update|delete|view)>',
                    'route' => 'partner/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'partner',
                    'route' => 'partner/index',
                    'suffix' => '/',
                ],

                // Kitchen
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'kitchen/<action:(create|update|delete|view)>',
                    'route' => 'kitchen/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'kitchen',
                    'route' => 'kitchen/index',
                    'suffix' => '/',
                ],

                // User
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'user/<action:(create|update|delete|view)>',
                    'route' => 'user/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'user',
                    'route' => 'user/index',
                    'suffix' => '/',
                ],

                // Foto
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'foto/<action:(create|update|delete|view|createfotos)>',
                    'route' => 'foto/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'foto',
                    'route' => 'foto/index',
                    'suffix' => '/',
                ],

                // Album
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'album/<action:(create|update|delete|view)>',
                    'route' => 'album/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'album',
                    'route' => 'album/index',
                    'suffix' => '/',
                ],

                // ProfileCook
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'profile-cook/<action:(create|update|delete|view|createwithuser)>',
                    'route' => 'profile-cook/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'profile-cook',
                    'route' => 'profile-cook/index',
                    'suffix' => '/',
                ],

                // ProfileUser
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'profile-user/<action:(create|update|delete|view|createwithuser)>',
                    'route' => 'profile-user/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'profile-user',
                    'route' => 'profile-user/index',
                    'suffix' => '/',
                ],

                // Recall
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'recall/<action:(create|update|delete|view)>',
                    'route' => 'recall/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'recall',
                    'route' => 'recall/index',
                    'suffix' => '/',
                ],

                // Dish
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'dish/<action:(create|update|delete|view)>',
                    'route' => 'dish/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'dish',
                    'route' => 'dish/index',
                    'suffix' => '/',
                ],

                // Diet
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'diet/<action:(create|update|delete|view)>',
                    'route' => 'diet/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'diet',
                    'route' => 'diet/index',
                    'suffix' => '/',
                ],

                // Dishmode
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'dishmode/<action:(create|update|delete|view)>',
                    'route' => 'dishmode/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'dishmode',
                    'route' => 'dishmode/index',
                    'suffix' => '/',
                ],

                // Message
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'message/<action:(create|update|delete|view)>',
                    'route' => 'message/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'message',
                    'route' => 'message/index',
                    'suffix' => '/',
                ],

                // Phonenumber
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'phonenumber/<action:(create|update|delete|view|createwithuser)>',
                    'route' => 'phonenumber/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'phonenumber',
                    'route' => 'phonenumber/index',
                    'suffix' => '/',
                ],

                // Address
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'address/<action:(create|update|delete|view)>',
                    'route' => 'address/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'address',
                    'route' => 'address/index',
                    'suffix' => '/',
                ],

                // Publication
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'publication/<action:(create|update|delete|view)>',
                    'route' => 'publication/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'publication',
                    'route' => 'publication/index',
                    'suffix' => '/',
                ],

                // Notice
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'notice/<action:(create|update|delete|view)>',
                    'route' => 'notice/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'notice/user/<userid:\d+>',
                    'route' => 'notice/user',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'notice',
                    'route' => 'notice/index',
                    'suffix' => '/',
                ],

                // Page
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'page/<action:(create|update|delete|view)>',
                    'route' => 'page/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'page',
                    'route' => 'page/index',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'mainpage/<action:(create|update|delete|view)>',
                    'route' => 'mainpage/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'mainpage',
                    'route' => 'mainpage/index',
                    'suffix' => '/',
                ],

                // News
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'news/<action:(create|update|delete|view|searchnewstag)>',
                    'route' => 'news/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'news',
                    'route' => 'news/index',
                    'suffix' => '/',
                ],

                // NewsTag
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'news-tag/<action:(create|update|delete|view)>',
                    'route' => 'news-tag/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'news-tag',
                    'route' => 'news-tag/index',
                    'suffix' => '/',
                ],

                // Dishtype
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'dishtype/<action:(create|update|delete|view)>',
                    'route' => 'dishtype/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'dishtype',
                    'route' => 'dishtype/index',
                    'suffix' => '/',
                ],

                // Site
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'site',
                    'route' => 'site/index',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'site/<action:(signup|logout|login|request-password-reset|reset-password)>',
                    'route' => 'site/<action>',
                    'suffix' => '/',
                ],
            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
