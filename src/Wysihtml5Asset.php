<?php
/**
 * @link https://github.com/webtoolsnz/yii2-widgets
 * @copyright Copyright (c) 2015 Webtools Ltd
 */
namespace webtoolsnz\widgets;

use yii\web\AssetBundle;

/**
 * Class Wysihtml5Asset
 * @package webtoolsnz\widgets
 */
class Wysihtml5Asset extends AssetBundle
{
    public $js = [
        'js/bootstrap3-wysihtml5.all.min.js',
    ];

    public $css = [
        'css/bootstrap3-wysihtml5.css',
    ];

    public $depends = [
        'yii\bootstrap5\BootstrapPluginAsset',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }
}
