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
        'bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
        'bower_components/animate.css/animate.min.css',
        'bower_components/select2/dist/css/select2.min.css',
        'bower_components/slick-carousel/slick/slick.css',
        'bower_components/nouislider/distribute/nouislider.min.css',
        'bower_components/lightgallery/dist/css/lightgallery.min.css',
        'css/custom.css',
    ];
    public $js = [
        'js/page-loader.min.js',
        'bower_components/Waves/dist/waves.min.js',
        'bower_components/select2/dist/js/select2.full.min.js',
        'bower_components/slick-carousel/slick/slick.min.js',
        'bower_components/nouislider/distribute/nouislider.min.js',
        'bower_components/autosize/dist/autosize.min.js',
        'bower_components/rateYo/src/jquery.rateyo.js',
        'bower_components/lightgallery/dist/js/lightgallery-all.min.js',
        'bower_components/jssocials/dist/jssocials.min.js',
        'js/app.min.js',
        'js/demo/demo.js',
        'bower_components/bootstrap/dist/js/bootstrap.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
