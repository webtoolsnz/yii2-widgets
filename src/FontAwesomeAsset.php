<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * Class FontAwesomeAsset
 * @package app\assets
 */
class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@bower/font-awesome';
    public $css = [
        'css/font-awesome.min.css',
    ];
    public $publishOptions = [
        'only' => [
            'fonts/',
            'css/',
        ]
    ];
}