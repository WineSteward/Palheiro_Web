<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
            'api' => [
                'class' => 'backend\modules\api\ModuleAPI',
            ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/cupao'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET validate ' => 'validate',
                        'GET all' => 'my',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/auth'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        'POST login' => 'login',
                        'POST logout' => 'logout',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/categoria'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET all' => 'all',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/metodopagamento'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET all' => 'all',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/metodoexpedicao'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET all' => 'all',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/encomenda'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET all' => 'all',
                        'GET id/{id}' => 'one'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/fatura'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET all' => 'all',
                        'GET id/{id}' => 'one',
                        'POST new' => 'criar'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/userprofile'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET my' => 'one',
                        'PUT edit' => 'edit',
                        'POST new' => 'registar'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/carrinho'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET my' => 'my',
                        'POST id/{id}' => 'add',
                        'PUT id/{id}' => 'edit',
                        'POST linhadelete/{id}' => 'linhadelete'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/listacompra'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET all' => 'my',
                        'POST add' => 'add',
                        'PUT id/{id}' => 'edit',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/produto'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        'Get all' => 'all',
                        'GET nome/{nome}' => 'searchnome',
                        'GET id/{id}' => 'searchid',
                        'GET categoria/{id}' => 'allofcategoria',
                        'GET {id}/{nome}' => 'searchcomplete',
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{nome}' => '<nome:[\w\s]+>', //[a-zA-Z0-9_] 1 ou + vezes (char)
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];
