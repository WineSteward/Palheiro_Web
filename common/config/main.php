<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'mqtt' => [
            'class' => 'common/mqtt/MqttClient',
            'host' => '127.0.0.1',
            'port' => 1883,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // uncomment if you want to cache RBAC items hierarchy
            // 'cache' => 'cache',
        ],
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
    ],
];
