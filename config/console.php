<?php
$config = [
    'id' => 'question_ui',
    'timeZone'=>'Asia/Shanghai',
    'basePath' => dirname(dirname(__DIR__)),
    'bootstrap' => ['log'],
    'components' => include(__DIR__ . '/console_components.php'),
    'params' => include (__DIR__ . '/params.php'),
    'modules' => [
        'question_ui' => ['class' => 'app\modules\Module'],
    ],
    'aliases' => [
    ],
];
return $config;
