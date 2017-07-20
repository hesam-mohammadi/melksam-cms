<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
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
        'bower_components/fullcalendar/dist/fullcalendar.min.css',
        'css/custom.css',
    ];
    public $js = [
        'js/page-loader.min.js',
        'bower_components/Waves/dist/waves.min.js',
        'bower_components/select2/dist/js/select2.full.min.js',
        'bower_components/moment/min/moment-with-locales.min.js',
        'bower_components/fullcalendar/dist/fullcalendar.min.js',
        'bower_components/Flot/jquery.flot.js',
        'bower_components/Flot/jquery.flot.pie.js',
        'bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js',
        'bower_components/Flot/jquery.flot.resize.js',
        'js/app.min.js',
        'js/demo/demo.js',
        'js/demo/charts/line-chart.js',
        'js/demo/charts/pie-chart.js',
        'js/baseinfo.js',
        'bower_components/bootstrap/dist/js/bootstrap.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
