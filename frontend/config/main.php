<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'name' => 'App',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
          // 'web'=> '/frontend/web',
          // 'baseUrl' => '',
          'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced',
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

        'urlManager' => [
            // 'baseUrl' => '/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            // '<controller:\w+>/<id:\d+>' => '<controller>/view',
            // '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
            // '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            // '/' => 'site/index',
            // 'fav' => 'site/fav',
            ],
        ],

    ],
    'params' => $params,
];
