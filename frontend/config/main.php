<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'name' => 'cookeryOne',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        // 'mailer' => [
        //     'class' => 'yii\swiftmailer\Mailer',
        //     'useFileTransport' => false,
        // ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@frontend/mail',
            'useFileTransport' => false,//set this property to false to send mails to real email addresses
            //comment the following array to send mail using php's mail function
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'trashzma@gmail.com',
                'password' => 'points11Yes',
                'port' => '587',
                // 'port' => '465', // с оффициальной страницы
                'encryption' => 'tls',
            ],
        ],
        'sms' => [
            'class' => 'Zelenin\yii\extensions\Sms',
            'api_id' => '4CD1054F-87D3-F308-09A5-43A9EB01C8D0',
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            // 'defaultRoles' => ['guest'],
            'itemFile' => '@frontend/components/rbac/items.php',
            'assignmentFile' => '@frontend/components/rbac/assignments.php',
            'ruleFile' => '@frontend/components/rbac/rules.php',
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
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js'=>[]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js'=>[],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [

                // MainPage
                '' => 'site/index',

                // Site
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => '<action:(signup|login|logout|request-password-reset|reset-password|reset-password-by-sms|code-in-sms|mainmapitems|get-one-content-4map)>',
                    'route' => 'site/<action>',
                    'suffix' => '/',
                ],
                // Site Ajax
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => '<action:(search-metrostation-header)>',
                    'route' => 'site/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => '<action:(search-metrostation-header|search-cook-username)>',
                    'route' => 'site/<action>',
                    'suffix' => '/',
                ],

                // Search
                //'defaults' do not work!!! (((
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'search/<producttype:(dish|diet)>/<section:[\w-]+>',
                    'route' => 'site/search',
                    'suffix' => '/',
                    // 'defaults' => ['producttype' => 'dish', 'section' => '', ],
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'search/<producttype:(dish|diet)>',
                    'route' => 'site/search',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'search',
                    'route' => 'site/search',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'search-header',
                    'route' => 'site/search-header',
                    'suffix' => '/',
                ],

                //
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => '<action:(userprofile|usermenu|userfoto|userblog|userproduct)>/<id:[\d]+>',
                    'route' => 'site/<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'basketadd/<id:[\d]+>',
                    'route' => 'site/basketadd',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'basketdel/<id:[\d]+>',
                    'route' => 'site/basketdel',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'basket',
                    'route' => 'site/basket',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'blogs',
                    'route' => 'site/blogs',
                    'suffix' => '/',
                ],

                // User
                // User topmenu
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => '<action:(notice|reviews|rating|change-password)>',
                    'route' => 'user/<action>',
                    'suffix' => '/',
                ],
                // User leftmenu
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => '<action:(profile|menu|foto|fotoadd|pay|blog|mycooks)>',
                    'route' => 'user/<action>',
                    'suffix' => '/',
                ],
                // User profile
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'profile/update',
                    'route' => 'user/profileupdate',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'profile/update/icon',
                    'route' => 'user/profile-icon-update',
                    'suffix' => '/',
                ],
                // User foto
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'foto/<album_id:[\d]+>/<foto_id:[\d]+>',
                    'route' => 'user/fotoupdate',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'foto/<id:[\d]+>',
                    'route' => 'user/fotoview',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'fotodel/<id:[\d]+>',
                    'route' => 'user/fotodel',
                    'suffix' => '/',
                ],
                // User product (Меню)
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'profile/menu/<id:[\d]+>',
                    'route' => 'user/menuview',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'profile/menu/<id:[\d]+>/delete',
                    'route' => 'user/product-delete',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'profile/menu/<action:(add)>',
                    'route' => 'user/menu<action>',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'profile/menu/add-set',
                    'route' => 'user/setadd',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'menu/<id:[\d]+>/update',
                    'route' => 'user/menuupdate',
                    'suffix' => '/',
                ],
                // User Blog
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'blog/publications/<id:[\d]+>',
                    'route' => 'user/publication-view',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'blog/publications/<id:[\d]+>/update',
                    'route' => 'user/publication-update',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'blog/publication-create',
                    'route' => 'user/publication-create',
                    'suffix' => '/',
                ],
                

                // Order
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'orders',
                    'route' => 'order/list',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'ordercreate',
                    'route' => 'order/ordercreate',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'order/<id:[\d]+>/update',
                    'route' => 'order/update',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'order/<id:[\d]+>',
                    'route' => 'order/view',
                    'suffix' => '/',
                ],

                // Message
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'messages/<id:[\d]+>',
                    'route' => 'message/list',
                    'suffix' => '/',
                    'defaults' => ['id' => null],
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'messages',
                    'route' => 'message/list',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => '<action:(new-messages|old-messages)>/<recipient_id:[\d]+>',
                    'route' => 'message/<action>',
                    'suffix' => '/',
                ],

                // Page
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => '<sid:[\w-]+>',
                    'route' => 'page/view',
                    'suffix' => '.html',
                ],

                // News
                // 'news/<sid:\w+>.html' => 'news/view',
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'news/<sid:[\w-]+>-<id:\d+>',
                    'route' => 'news/view',
                    'suffix' => '.html',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'news/<page:\d+>',
                    'route' => 'news/list',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'news/<tag:[\w-]+>',
                    'route' => 'news/list',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'news/<tag:[\w-]+>/<page:\d+>',
                    'route' => 'news/list',
                    'suffix' => '/',
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'news',
                    'route' => 'news/list',
                    'suffix' => '/',
                ],

            ]
        ],
    ],
    'params' => $params,
];
