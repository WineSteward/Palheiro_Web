<?php
return [
    'id' => 'app-backend-tests',
    'components' => [
        'db' => [
            'dsn' => 'mysql:host=localhost;dbname=palheiro_testes',
        ],
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'test',
        ],
    ],
];
