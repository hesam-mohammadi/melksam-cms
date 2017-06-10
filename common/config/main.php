<?php
return [
    // set target language to be Persian
    'language' => 'fa-IR',
    // set source language to be English
    'sourceLanguage' => 'en-US',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
           'translations' => [
               'app*' => [
                   'class' => 'yii\i18n\PhpMessageSource',
                   'basePath' => '@common/messages',
               ],
           ],
        ],
    ],
];
