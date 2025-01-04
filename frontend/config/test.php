<?php
return [
    'id' => 'app-frontend-tests',
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
        'mailer' => [
            'messageClass' => \yii\symfonymailer\Message::class
        ]
    ],
];
