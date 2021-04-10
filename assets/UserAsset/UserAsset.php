<?php

namespace thefx\user\assets\UserAsset;

use yii\web\AssetBundle;

class UserAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';

    public $css = [
        'floating-labels.css',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
