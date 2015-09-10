<?php
namespace webtoolsnz\widgets;

use yii\web\AssetBundle;

/**
 * Class FontAwesomeAsset
 * @package app\assets
 */
class FontAwesomeAsset extends AssetBundle
{
    public $css = [
        'css/font-awesome.min.css',
    ];
    public $publishOptions = [
        'only' => [
            'fonts',
            'css',
        ]
    ];

    public function init()
    {
        $this->sourcePath = '@bower/font-awesome';
        parent::init();
    }
}
