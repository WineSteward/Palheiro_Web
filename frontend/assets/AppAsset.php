<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/site.css',
        'css/style.css',
        'css/bootstrap.min.css',
        'css/elegant-icons.css',
        'css/font-awesome.min.css',
        'css/jquery-ui.min.css',
        'css/nice-select.css',
        'css/owl.carousel.min.css',
        'css/slicknav.min.css',
    ];

    public $js = [
        'js/jquery.min.js',
        'js/jquery-ui.min.js',
        'js/jquery.nice-select.min.js',
        'js/mixitup.min.js',
        'js/owl.carousel.min.js',
        'js/jquery.slicknav.js',
        'js/bootstrap.min.js',
        'js/main.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
